<?php

use yii\db\Migration;

/**
 * Class m190917_181235_vipforecast
 */
class m190917_181235_vipforecast extends Migration
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

        $this->createTable('{{%vip_forecast}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'odds_from' => $this->float()->notNull(),
            'odds_to' => $this->float()->notNull(),
            'price' => $this->float()->notNull(),
            'image' => $this->string()->null(),
            'event_date' => $this->dateTime()->null(),
            'desc' => $this->text()->null(),
            'slug' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vip_forecast}}');
    }
}
