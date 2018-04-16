<?php

namespace tina\metatag\models;

/**
 * This is the ActiveQuery class for [[Metatag]].
 *
 * @see Metatag
 */
class MetatagQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Metatag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Metatag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
