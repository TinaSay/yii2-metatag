<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 20.04.18
 * Time: 16:20
 */

namespace tina\metatag\components;

use yii\di\Instance;
use yii\web\View;
use tina\metatag\models\Metatag as Model;

/**
 * Class Metatag
 *
 * @package tina\metatag\components
 */
class Metatag
{
    /**
     * @var
     */
    public $separator = ' :: ';

    /**
     * @var View
     */
    protected $view;

    /**
     * @param $meta
     * @param $modelTitle
     * @param bool $isIndex
     * @param string $view
     *
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function metatagComposer($meta, $modelTitle, $isIndex = false, string $view = 'view')
    {
        $this->view = Instance::ensure($view, View::class);

        $indexMeta = Model::find()->where([
            'model' => 'index',
            'recordId' => 0,
        ])->one();

        $this->view->on(View::EVENT_AFTER_RENDER,
            function ($event) use ($view, $meta, $indexMeta, $modelTitle, $isIndex) {
                $title = [
                    $modelTitle,
                    $meta->title,
                ];

                if ($isIndex == true) {
                    $this->view->title = $indexMeta->title;
                } else {
                    if ($meta->commonTitle == Model::COMMON_YES || $meta->id == null) {
                        array_push($title, $indexMeta->title);
                    }
                    $this->view->title = implode($this->separator, array_diff($title, ['']));
                }
            });

        $keywords = [
            $meta->keywords,
        ];
        $description = [
            $meta->description,
        ];

        if ($isIndex == true) {
            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $indexMeta->keywords,
            ]);
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $indexMeta->description,
            ]);
        } else {
            if ($meta->commonKeywords == Model::COMMON_YES || $meta->id == null) {
                array_push($keywords, $indexMeta->keywords);
            }
            if ($meta->commonDescription == Model::COMMON_YES || $meta->id == null) {
                array_push($description, $indexMeta->description);
            }
            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => implode($this->separator, array_diff($keywords, [''])),
            ], 'keywords');
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => implode($this->separator, array_diff($description, [''])),
            ], 'description');
        }

        return true;
    }
}