<?php

use yii\db\Migration;
use common\models\VipForecast;
/**
 * Class m191125_191219_add_open
 */
class m191125_191219_add_open extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(VipForecast::tableName(), 'open', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->after('expire'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(VipForecast::tableName(), 'open');
    }
}
