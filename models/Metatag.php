<?php

namespace tina\metatag\models;

use krok\extend\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%metatag}}".
 *
 * @property integer $id
 * @property string $model
 * @property integer $recordId
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property integer $commonTitle
 * @property integer $commonDescription
 * @property integer $commonKeywords
 * @property string $createdAt
 * @property string $updatedAt
 */
class Metatag extends \yii\db\ActiveRecord
{
    const COMMON_YES = 1;
    const COMMON_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%metatag}}';
    }

    /**
     * @param int $common
     *
     * @return mixed
     */
    public static function getCommon(int $common)
    {
        return ArrayHelper::getValue(self::getCommonList(), $common);
    }

    /**
     * @return array
     */
    public static function getCommonList()
    {
        return [
            self::COMMON_YES => 'Да',
            self::COMMON_NO => 'Нет',
        ];
    }

    /**
     * @inheritdoc
     * @return MetatagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MetatagQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'recordId'], 'required'],
            [['recordId', 'commonTitle', 'commonDescription', 'commonKeywords'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['model', 'title'], 'string', 'max' => 128],
            [['description', 'keywords'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'commonTitle' => 'Использовать общий заголовок',
            'commonDescription' => 'Использовать общее описание',
            'commonKeywords' => 'Использовать общие ключевые слова',
        ];
    }
}
