<?php

use yii\db\Migration;

/**
 * Class m201124_112913_banners
 */
class m201124_112913_banners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%banners}}', [
            'id' => $this->primaryKey(),
            'href' => $this->text()->notNull(),
            'type' => $this->smallInteger()->unsigned()->notNull(),
            'image' => $this->string()->null(),
            'sort' => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banners}}');
    }
}
