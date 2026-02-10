<?php

use yii\db\Migration;
use common\models\News;

/**
 * Class m220920_084146_news_add_likes
 */
class m220920_084146_news_add_likes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(News::tableName(), 'dislike', $this->integer(11)->unsigned()->notNull()->defaultValue(0)->after('views'));
        $this->addColumn(News::tableName(), 'upvote', $this->integer(11)->unsigned()->notNull()->defaultValue(0)->after('views'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(News::tableName(), 'dislike');
        $this->dropColumn(News::tableName(), 'upvote');
    }
}
