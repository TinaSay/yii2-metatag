<?php

use yii\db\Migration;

/**
 * Class m180412_130129_alter_column
 */
class m180412_130129_insert_row extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%metatag}}', [
            'model' => 'index',
            'recordId' => 0,
            'title' => 'Главная страница',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%metatag}}', [
            'model' => 'index',
            'recordId' => 0,
        ]);
    }
}
