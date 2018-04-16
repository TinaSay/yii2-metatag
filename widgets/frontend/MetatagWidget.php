<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 12.04.18
 * Time: 13:05
 */

namespace tina\metatag\widgets\frontend;

use tina\metatag\models\Metatag;
use yii\base\Widget;
use yii\di\Instance;
use yii\web\View;

/**
 * Class MetatagWidget
 *
 * @package tina\metatag\widgets\frontend
 */
class MetatagWidget extends Widget
{
    /**
     * @var Metatag
     */
    public $model;

    /**
     * @var bool
     */
    public $isIndex = false;

    /**
     * @var string
     */
    public $pageTitle;

    /**
     * @var
     */
    public $separator = ' :: ';

    /**
     * @var View
     */
    protected $view;

    /**
     * MetatagWidget constructor.
     *
     * @param string $view
     * @param array $config
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct(string $view = 'view', array $config = [])
    {
        $this->view = Instance::ensure($view, View::class);
        parent::__construct($config);
    }

    public function run()
    {
        $meta = Metatag::find()->where([
            'model' => 'index',
            'recordId' => 0,
        ])->one();

        $title = [
            $meta->title,
            $this->model->title,
        ];

        $keywords = [
            $this->pageTitle,
            $this->model->keywords,
        ];

        $description = [
            $this->pageTitle,
            $this->model->description,
        ];

        if ($this->model->commonTitle == Metatag::COMMON_YES) {
            array_push($title, $meta->title);
        }

        if ($this->model->commonKeywords == Metatag::COMMON_YES) {
            array_push($keywords, $meta->keywords);
        }

        if ($this->model->commonDescription == Metatag::COMMON_YES) {
            array_push($description, $meta->description);
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
}
