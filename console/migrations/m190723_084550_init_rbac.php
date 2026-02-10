<?php

use yii\db\Migration;
use yii\db\Schema;
use yii\rbac\Item;

/**
 * Class m190723_084550_init_rbac
 */
class m190723_084550_init_rbac extends Migration
{
    public function safeUp()
    {


        if (!isset(Yii::$app->i18n->translations['users']) && !isset(Yii::$app->i18n->translations['users/*'])) {
            Yii::$app->i18n->translations['users'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'users' => 'users.php'
                ]
            ];
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //таблица auth_rule
        $this->createTable('{{%auth_rule}}', [
            'name' => Schema::TYPE_STRING.'(64) NOT NULL',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER

        ], $tableOptions);
        $this->addPrimaryKey('auth_rule_pk', '{{%auth_rule}}', 'name');

        //таблица auth_item
        $this->createTable('{{%auth_item}}', [
            'name' => Schema::TYPE_STRING.'(64) NOT NULL',
            'type' => Schema::TYPE_INTEGER.' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'rule_name' => Schema::TYPE_STRING.'(64)',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER
        ], $tableOptions);
        $this->addPrimaryKey('auth_item_name_pk', '{{%auth_item}}', 'name');
        $this->addForeignKey('auth_item_rule_name_fk', '{{%auth_item}}', 'rule_name', '{{%auth_rule}}',  'name', 'SET NULL', 'CASCADE');
        $this->createIndex('auth_item_type_index', '{{%auth_item}}', 'type');

        //таблица auth_item_child
        $this->createTable('{{%auth_item_child}}', [
            'parent' => Schema::TYPE_STRING.'(64) NOT NULL',
            'child' => Schema::TYPE_STRING.'(64) NOT NULL'
        ], $tableOptions);
        $this->addPrimaryKey('auth_item_child_pk', '{{%auth_item_child}}', array('parent', 'child'));
        $this->addForeignKey('auth_item_child_parent_fk', '{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('auth_item_child_child_fk', '{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');

        //таблица auth_assignment
        $this->createTable('{{%auth_assignment}}', [
            'item_name' => Schema::TYPE_STRING.'(64) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER.'(11) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER
        ], $tableOptions);
        $this->addPrimaryKey('auth_assignment_pk', '{{%auth_assignment}}', array('item_name', 'user_id'));
        $this->addForeignKey('auth_assignment_item_name_fk', '{{%auth_assignment}}', 'item_name', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('auth_assignment_user_id_fk', '{{%auth_assignment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->insert('{{%auth_rule}}', [
            'name' => 'noElderRank',
            'data' => 'O:28:"backend\rbac\NoElderRankRule":3:{s:4:"name";s:11:"noElderRank";s:9:"createdAt";N;s:9:"updatedAt";i:1431880756;}',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->batchInsert('{{%auth_item}}', ['name', 'type', 'description', 'rule_name', 'created_at', 'updated_at'], [
            ['administrator', Item::TYPE_ROLE, \Yii::t('users', 'MIGRATION_ADMINISTRATOR'), NULL, time(), time()],
            ['moderator', Item::TYPE_ROLE, \Yii::t('users', 'MIGRATION_MODERATOR'), NULL, time(), time()],
            ['rbacManage', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_RBAC_MANAGE'), NULL, time(), time()],
            ['userCreate', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_CREATE'), NULL, time(), time()],
            ['userDelete', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_DELETE'), NULL, time(), time()],
            ['userManage', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_MANAGE'), NULL, time(), time()],
            ['userPermissions', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_PERMISSIONS'), NULL, time(), time()],
            ['userUpdate', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_UPDATE'), NULL, time(), time()],
            ['userUpdateNoElderRank', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_UPDATE_NO_ELDER_RANK'), 'noElderRank', time(), time()],
            ['userView', Item::TYPE_PERMISSION, \Yii::t('users', 'MIGRATION_USER_VIEW'), NULL, time(), time()],
        ]);
        $this->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['administrator', 'rbacManage'],
            ['administrator', 'userCreate'],
            ['administrator', 'userDelete'],
            ['administrator', 'userPermissions'],
            ['administrator', 'userUpdate'],
            ['administrator', 'moderator'],
            ['moderator', 'userManage'],
            ['moderator', 'userView'],
            ['moderator', 'userUpdateNoElderRank'],
            ['userUpdateNoElderRank', 'userUpdate'],
        ]);
        $this->batchInsert('{{%auth_assignment}}', ['item_name', 'user_id', 'created_at', 'updated_at'], [
            ['administrator', 1, time(), time()],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth_assignment}}');
        $this->dropTable('{{%auth_item_child}}');
        $this->dropTable('{{%auth_item}}');
        $this->dropTable('{{%auth_rule}}');
    }
}
