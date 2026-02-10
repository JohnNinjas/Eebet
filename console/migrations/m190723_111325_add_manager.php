<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m190723_111325_add_manager
 */
class m190723_111325_add_manager extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //аккаунт для администратора и права
        $this->batchInsert(User::tableName(), [ 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'role', 'status', 'created_at', 'updated_at'], [
            [
                'manager',
                \Yii::$app->security->generateRandomString(),
                \Yii::$app->security->generatePasswordHash('OcbZiYypkq'),
                '',
                'manager@example.com',
                User::ROLE_ADMIN,
                User::STATUS_ACTIVE,
                time(),
                time()
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $user = User::findByUsername('manager');
        if ($user)
            $user->delete();
        return true;

    }
}
