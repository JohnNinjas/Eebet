<?php

use yii\db\Migration;

/**
 * Class m190912_100847_freeforecast
 */
class m190912_100847_freeforecast extends Migration
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

        $this->createTable('{{%free_forecast}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'odds' => $this->float()->notNull(),
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
        $this->dropTable('{{%free_forecast}}');
    }

}
