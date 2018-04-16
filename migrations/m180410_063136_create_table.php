<?php

use yii\db\Migration;

/**
 * Class m180410_063136_create_table
 */
class m180410_063136_create_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%metatag}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string(128)->notNull(),
            'recordId' => $this->integer(11)->notNull(),
            'title' => $this->string(128)->defaultValue(null),
            'description' => $this->string(256)->defaultValue(null),
            'keywords' => $this->string(256)->defaultValue(null),
            'commonTitle' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'commonDescription' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'commonKeywords' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('model-recordId', '{{%metatag}}', ['model', 'recordId'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metatag}}');
    }
}
