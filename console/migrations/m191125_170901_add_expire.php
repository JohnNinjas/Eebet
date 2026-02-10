<?php

use yii\db\Migration;
use common\models\VipForecast;
use common\models\FreeForecast;
/**
 * Class m191125_170901_add_expire
 */
class m191125_170901_add_expire extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(VipForecast::tableName(), 'expire', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->after('slug'));
        $this->addColumn(FreeForecast::tableName(), 'expire', $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->after('slug'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(VipForecast::tableName(), 'expire');
        $this->dropColumn(FreeForecast::tableName(), 'expire');
    }
}
