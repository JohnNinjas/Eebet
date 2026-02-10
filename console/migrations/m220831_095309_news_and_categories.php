<?php

use yii\db\Migration;

/**
 * Class m220831_095309_news_and_categories
 */
class m220831_095309_news_and_categories extends Migration
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

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'cat_id' => $this->integer()->unsigned()->notNull(),
            //'odds' => $this->float()->notNull(),
            'image' => $this->string()->null(),
         //   'event_date' => $this->dateTime()->null(),
            'desc' => $this->text()->null(),
            'slug' => $this->string()->notNull(),
            'views' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('news_cat_id_index', '{{%news}}', 'cat_id');

        $this->createTable('{{%news_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'image' => $this->string()->null(),
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
        $this->dropTable('{{%news}}');
        $this->dropTable('{{%news_categories}}');
    }
}
