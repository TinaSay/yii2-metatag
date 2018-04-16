<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 10.04.18
 * Time: 15:48
 */

namespace tina\metatag\widgets\backend;

use tina\metatag\models\Metatag;
use yii\base\Widget;
use yii\widgets\ActiveForm;

/**
 * Class MetatagWidget
 *
 * @package tina\metatag\widgets\backend
 */
class MetatagWidget extends Widget
{
    /**
     * @var Metatag
     */
    public $model;

    /**
     * @var ActiveForm
     */
    public $form;

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('form', [
            'model' => $this->model,
            'form' => $this->form,
        ]);
    }
}
