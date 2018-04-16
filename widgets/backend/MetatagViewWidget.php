<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 12.04.18
 * Time: 10:46
 */

namespace tina\metatag\widgets\backend;

use tina\metatag\models\Metatag;
use yii\base\Widget;

/**
 * Class MetatagViewWidget
 *
 * @package tina\metatag\widgets\backend
 */
class MetatagViewWidget extends Widget
{
    /**
     * @var Metatag
     */
    public $model;

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('view', [
            'model' => $this->model,
        ]);
    }
}
