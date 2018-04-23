<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 20.04.18
 * Time: 16:20
 */

namespace tina\metatag\components;

use yii\web\View;
use yii\di\Instance;
use tina\metatag\models\Metatag;

/**
 * Class MetatagSingleton
 *
 * @package tina\metatag\components
 */
class MetatagSingleton
{
    /**
     * @var
     */
    public $separator = ' :: ';

    /**
     * @var View
     */
    protected $view;

    /** @var Instance */
    protected static $instance;

    /**
     * MetatagSingleton clone
     */
    private function __clone()
    {
    }

    /**
     * MetatagSingleton wakeup
     */
    private function __wakeup()
    {
    }

    /**
     * @param $model
     * @param bool $isIndex
     * @param string $view
     *
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function metatagComposer($model, $isIndex = false, string $view = 'view')
    {
        $this->view = Instance::ensure($view, View::class);

        $indexMeta = Metatag::find()->where([
            'model' => 'index',
            'recordId' => 0,
        ])->one();

        $title = [
            $model->title,
            $model->meta->title,
        ];
        $keywords = [
            $model->title,
            $model->meta->keywords,
        ];
        $description = [
            $model->title,
            $model->meta->description,
        ];

        if ($isIndex == true) {
            $this->view->title = $indexMeta->title;
            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $indexMeta->keywords,
            ]);
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $indexMeta->description,
            ]);
        } else {

            if ($model->meta->commonTitle == Metatag::COMMON_YES) {
                array_push($title, $indexMeta->title);
            }
            if ($model->meta->commonKeywords == Metatag::COMMON_YES) {
                array_push($keywords, $indexMeta->keywords);
            }
            if ($model->meta->commonDescription == Metatag::COMMON_YES) {
                array_push($description, $indexMeta->description);
            }
            $this->view->title = implode($this->separator, array_diff($title, ['']));
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