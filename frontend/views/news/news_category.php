<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 12.09.2019
 * Time: 14:50
 */


/* @var $this yii\web\View */
/* @var $news array */
/* @var $model \common\models\NewsCategories */
/* @var $pages \yii\data\Pagination */


$this->title = 'Информационный блог - '.$model->title;
$this->registerMetaTag(['name' => 'description', 'content' => 'Информационный блог']);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => \yii\helpers\Url::canonical(),
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => 'Информационный блог',
]);


$this->params['breadcrumbs'][] = ['label' => 'Информационный блог', 'url'=> \yii\helpers\Url::to(['news-all-cats'])];
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page">

    <div class="headeredPage headeredPage_1">
        <div class="headeredPage__title">
            <img src="/img/headered2.png" alt="">
            <span><?=$this->title?></span>
        </div>
    </div>

    <div class="pageContent pageContent__grey pageContent__freeBg">
        <div class="contentWrap breadcrumbs">
            <div class="listArticles">
                <div class="news-bread">
                    <?=\yii\widgets\Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],'homeLink' => false,]);?>
                </div>
            </div>
            <div class="listArticles">
                <?php if (count($news) > 0) { ?>
                    <?php foreach ($news as $f) : ?>
                        <div class="itemArticles">
                            <a href="<?=\yii\helpers\Url::to(['news/news', 'cat_slug' => $model->slug, 'slug' => $f->slug])?>">
                                <div class="itemArticles__image" style="background-image: url(<?=$f->getThumb()?>)"></div>
                                <div class="itemArticles__info">
                                    <div class="itemArticles__title"><?=$f->title?></div>
                                    <div class="itemArticles__infoWrap">

                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php } else  { ?>
                    <p>Новости не найдены</p>
                <?php }  ?>
            </div>
        </div>
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]); ?>

    </div>

</div>
