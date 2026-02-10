<?php

use yii\db\Migration;
use common\models\FreeForecast;


/**
 * Class m220928_132744_add_tournament
 */
class m220928_132744_add_tournament extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(FreeForecast::tableName(), 'tournament', $this->string()->null()->after('slug'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(FreeForecast::tableName(), 'tournament');

    }
}
