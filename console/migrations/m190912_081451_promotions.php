<?php

use yii\db\Migration;

/**
 * Class m190912_081451_promotions
 */
class m190912_081451_promotions extends Migration
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

        $this->createTable('{{%promotions}}', [
            'id' => $this->primaryKey(),
            'bookie_name' => $this->string()->notNull(),
            'bookie_link' => $this->string()->notNull(),
            'login' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'balance' => $this->integer()->notNull()->defaultValue(0),
            'phone' => $this->string()->notNull(),
            'full_name' => $this->string()->notNull(),
            'social_link' => $this->string()->notNull(),
            'comment' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promotions}}');
    }

}
