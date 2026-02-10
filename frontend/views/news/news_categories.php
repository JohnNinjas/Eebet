<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 12.09.2019
 * Time: 14:50
 */


/* @var $this yii\web\View */
/* @var $news array */
/* @var $categories array */
/* @var $pages \yii\data\Pagination */
$this->title = 'Информационный блог';
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


?>


<div class="page">

    <div class="headeredPage headeredPage_1">
        <div class="headeredPage__title">
            <img src="/img/headered2.png" alt="">
            <span>Информационный блог</span>
        </div>
    </div>


    <div class="pageContent pageContent__grey pageContent__freeBg">
        <div class="contentWrap">


            <div class="categoriesList">
                <?php foreach ($categories as $category) { ?>
                    <div class="categoryBlock"><a href="<?=\yii\helpers\Url::to(['news/news-category', 'slug' => $category->slug])?>">
                            <img src="<?=$category->getThumb()?>" alt="<?=$category->title?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="listArticles">
                <?php if (count($news) > 0) { ?>
                <?php foreach ($news as $f) : ?>
                    <div class="itemArticles">
                        <a href="<?=\yii\helpers\Url::to(['news/news', 'cat_slug' => $categories[$f->cat_id]->slug, 'slug' => $f->slug])?>">
                            <div class="itemArticles__image" style="background-image: url(<?=$f->getThumb()?>)"></div>
                            <div class="itemArticles__info">
                                <div class="itemArticles__title"><?=$f->title?></div>
                                <div class="itemArticles__infoWrap">
                                     <div class="news-short-desc">
                                         <?=$f->GetShortDesc()?>
                                     </div>
                                </div>
                                <div class="newsInfo">
                                    <div class="news-time"><?=$f->GetDate()?></div>
                                    <div class="news-views"><?=$f->GetViewsString()?></div>
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
