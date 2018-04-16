<?php

namespace tina\metatag;

use krok\system\components\backend\NameInterface;
use Yii;

/**
 * Class Module
 *
 * @package tina\metatag
 */
class Module extends \yii\base\Module implements NameInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = null;

    /**
     * @return string
     */
    public static function getName()
    {
        return Yii::t('system', 'Metatag');
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
