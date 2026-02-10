<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 17.09.2019
 * Time: 22:58
 */

/* @var $model \common\models\News*/
/* @var $category \common\models\NewsCategories*/
/* @var $banners array */
/* @var $relatedNews array */

use common\models\News;


$this->title = $model->title;
$desc = 'Информационный блог';
$this->registerMetaTag(['name' => 'description', 'content' => $desc]);

$url = yii\helpers\Url::canonical();

\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => $url,
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => $desc,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:image',
    'content' => '/photo.png',
]);


$this->params['breadcrumbs'][] = ['label' => 'Информационный блог', 'url'=> \yii\helpers\Url::to(['news-all-cats'])];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url'=> \yii\helpers\Url::to(['news/news-category', 'slug' => $category->slug])];
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;


$votes = $model->upvote-$model->dislike;
$voteClass = '';
if ($votes > 0) {
    $voteClass = ' positive';
}
elseif ($votes < 0) {
    $voteClass = ' negative';
}


$dislikeClass = '';
$upvoteClass = '';
$cookie = Yii::$app->request->cookies['vote'.$model->id];
if ($cookie) {
    $type = $cookie->value;
    if ($type == 1) {
        $upvoteClass = ' like-active';
    }
    if ($type == 2) {
        $dislikeClass = ' dislike-active';
    }
}




/*Yii::app()->createUrl(
    Yii::app()->controller->getId().'/'.Yii::app()->controller->getAction()->getId() ,
    $_GET
)*/

?>

<div class="page news">



    <div class="articleContent breadcrumbs">

        <div class="articleContainer">

            <div class="news-bread">
                <?=\yii\widgets\Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],'homeLink' => false,]);?>
            </div>

            <div class="articleImage">
                <img src="<?=$model->getPhoto()?>" alt="">
            </div>

            <div class="articleTitle">
                <?=$model->title?>
            </div>
            <div class="articleText">
                <?=$model->GetDesc($banners)?>
            </div>

            <div class="share-container">
                <div class="sociallinks__item"><div>Поделится</div></div>
                <div class="sociallinks__item">
                    <a href="https://vk.com/share.php?act=<?=$url?>" target="_blank">
                        <svg class="sociallinks__svg" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
                                    <desc>VK</desc>
                            <path style="fill:#002c5e;" d="M41.2 22.2c.6-.8 1.1-1.5 1.5-2 2.7-3.5 3.8-5.8 3.5-6.8l-.2-.2c-.1-.1-.3-.3-.7-.4-.4-.1-.9-.1-1.5-.1h-7.2c-.2 0-.3 0-.3.1 0 0-.1 0-.1.1v.1c-.1 0-.2.1-.3.2-.1.1-.2.2-.2.4-.7 1.9-1.5 3.6-2.5 5.2-.6 1-1.1 1.8-1.6 2.5s-.9 1.2-1.2 1.5c-.3.3-.6.6-.9.8-.2.3-.4.4-.5.4-.1 0-.3-.1-.4-.1-.2-.1-.4-.3-.5-.6-.1-.2-.2-.5-.3-.9 0-.4-.1-.7-.1-.9v-1.1-1-1.9c0-.7 0-1.2.1-1.6v-1.3c0-.4 0-.8-.1-1.1-.1-.3-.1-.5-.2-.7-.1-.2-.3-.4-.5-.6-.2-.1-.5-.2-.8-.3-.8-.2-1.9-.3-3.1-.3-2.9 0-4.7.2-5.5.6-.3.2-.6.4-.9.7-.3.3-.3.5-.1.6.9.1 1.6.5 2 1l.1.3c.1.2.2.6.3 1.1.1.5.2 1.1.2 1.7.1 1.1.1 2.1 0 2.9-.1.8-.1 1.4-.2 1.9-.1.4-.2.8-.3 1.1-.1.3-.2.4-.3.5 0 .1-.1.1-.1.1-.1-.1-.4-.1-.6-.1-.2 0-.5-.1-.8-.3-.3-.2-.6-.5-1-.9-.3-.4-.7-.9-1.1-1.6-.4-.7-.8-1.5-1.3-2.4l-.4-.7c-.2-.4-.5-1.1-.9-1.9-.4-.8-.8-1.6-1.1-2.4-.1-.3-.3-.6-.6-.7l-.1-.1c-.1-.1-.2-.1-.4-.2s-.3-.1-.5-.2H3.2c-.6 0-1.1.1-1.3.4l-.1.1c0 .1-.1.2-.1.4s0 .4.1.6c.9 2.2 1.9 4.3 3 6.3s2 3.6 2.8 4.9c.8 1.2 1.6 2.4 2.4 3.5.8 1.1 1.4 1.8 1.7 2.1.3.3.5.5.6.7l.6.6c.4.4.9.8 1.6 1.3.7.5 1.5 1 2.4 1.5.9.5 1.9.9 3 1.2 1.2.3 2.3.4 3.4.4H26c.5 0 .9-.2 1.2-.5l.1-.1c.1-.1.1-.2.2-.4s.1-.4.1-.6c0-.7 0-1.3.1-1.8s.2-.9.4-1.2c.1-.3.3-.5.5-.7.2-.2.3-.3.4-.3.1 0 .1-.1.2-.1.4-.1.8 0 1.3.4s1 .8 1.4 1.3c.4.5 1 1.1 1.6 1.8.6.7 1.2 1.2 1.6 1.5l.5.3c.3.2.7.4 1.2.5.5.2.9.2 1.3.1l5.9-.1c.6 0 1-.1 1.4-.3.3-.2.5-.4.6-.6.1-.2.1-.5 0-.8-.1-.3-.1-.5-.2-.6-.1-.1-.1-.2-.2-.3-.8-1.4-2.2-3.1-4.4-5.1-1-.9-1.6-1.6-1.9-1.9-.5-.6-.6-1.2-.3-1.9.3-.5 1-1.5 2.2-3z">
                            </path>
                                </svg>
                    </a>
                </div>
                <div class="sociallinks__item">
                    <a href="https://telegram.me/share/url?url=<?=$url?>>&text=<TEXT>" target="_blank">
                        <svg class="sociallinks__svg" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 60 60" xml:space="preserve">
                                <desc>Telegram</desc>
                            <path style="fill:#002c5e;" d="M52.5,9L6.1,26.9c-0.9,0.4-0.9,1.8,0,2.3l11.9,4.9l4.4,14.1c0.3,0.8,1.2,1,1.8,0.5l6.8-6.4l12.9,8.7c0.7,0.4,1.6,0,1.7-0.7L54,10.3C54.2,9.5,53.3,8.7,52.5,9z M24.5,36.7L23.8,44l-3.6-11.2l25.3-16.8L24.5,36.7z">
                            </path>
                            </svg>
                    </a>
                </div>
            </div>

            <div class="vote-container">
               <div class="vote-background">
                   <div class="vote-inside">
                       <div class="vote-text">Понравилась новость?</div>
                       <div class="vote-buttons" data-id="<?=$model->id?>">
                           <div class="vote-btn like js-vote<?=$upvoteClass?>" data-type="<?=News::VOTE_POSITIVE?>">
                               <svg viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg" class="CommentsReactions__icon CommentsReactions__icon-like"><path d="M14.54 9.95A1.406 1.406 0 0016 8.594c.033-.784-.509-1.49-1.28-1.523L9.6 6.428S10.666 4.644 10.666 2c0-1.763-1.259-2-2-2-.582 0-.739 1.129-.739 1.129h-.001c-.132.723-.304 1.355-.9 2.52-.669 1.304-1.579 1.181-2.641 2.343-.188.205-.44.542-.685.958a.33.33 0 00-.057.096c-.022.051-.048.087-.071.135-.041.075-.081.15-.12.228-.658.657-1.682.59-2.118.59C.459 7.999 0 8.507 0 9.332v6.095c0 .925.379 1.237 1.334 1.237h1.333c.671 0 1.197.385 2 .667 1.1.381 2.743.667 5.573.667l2.03.002c.47 0 .847-.215 1.12-.474.103-.098.211-.242.257-.52.008-.044.016-.226.015-.25.035-.8-.448-1.089-.721-1.18.007-.002.002-.009.017-.008l.869.038c.771.036 1.532-.52 1.532-1.465 0-.783-.635-1.335-1.403-1.373l.46.021a1.41 1.41 0 001.459-1.357A1.413 1.413 0 0014.54 9.95z"></path></svg>
                           </div>
                           <div class="vote-counter js-counter<?=$voteClass?>"><?=$votes?></div>
                           <div class="vote-btn dislike js-vote<?=$dislikeClass?>" data-type="<?=News::VOTE_NEGATIVE?>">
                               <svg viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg" class="CommentsReactions__icon CommentsReactions__icon-dislike"><path d="M14.54 9.95A1.406 1.406 0 0016 8.594c.033-.784-.509-1.49-1.28-1.523L9.6 6.428S10.666 4.644 10.666 2c0-1.763-1.259-2-2-2-.582 0-.739 1.129-.739 1.129h-.001c-.132.723-.304 1.355-.9 2.52-.669 1.304-1.579 1.181-2.641 2.343-.188.205-.44.542-.685.958a.33.33 0 00-.057.096c-.022.051-.048.087-.071.135-.041.075-.081.15-.12.228-.658.657-1.682.59-2.118.59C.459 7.999 0 8.507 0 9.332v6.095c0 .925.379 1.237 1.334 1.237h1.333c.671 0 1.197.385 2 .667 1.1.381 2.743.667 5.573.667l2.03.002c.47 0 .847-.215 1.12-.474.103-.098.211-.242.257-.52.008-.044.016-.226.015-.25.035-.8-.448-1.089-.721-1.18.007-.002.002-.009.017-.008l.869.038c.771.036 1.532-.52 1.532-1.465 0-.783-.635-1.335-1.403-1.373l.46.021a1.41 1.41 0 001.459-1.357A1.413 1.413 0 0014.54 9.95z"></path></svg>
                           </div>
                       </div>
                   </div>
               </div>
            </div>

        </div>
        <?php if(count($relatedNews) > 0) { ?>
            <div class="contentWrap related-news">
                <h2 class="text-center">Похожие записи</h2>
                <div class="listNews">
                    <?php foreach ($relatedNews as $f) : ?>
                        <div class="itemNews">
                            <a href="<?=\yii\helpers\Url::to(['news/news', 'cat_slug' => $category->slug, 'slug' => $f->slug])?>">
                                <div class="itemNews__image" style="background-image: url(<?=$f->getThumb()?>)"></div>
                                <div class="itemNews__info">
                                    <div class="itemNews__title"><?=$f->title?></div>
                                    <div class="itemNews__infoWrap">
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
                </div>
            </div>
        <?php } ?>

    </div>

</div>
