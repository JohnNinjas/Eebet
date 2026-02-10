<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 08.10.2019
 * Time: 21:51
 */

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $model \common\models\VipForecast */
/* @var $img string; */

$wait = $model->GetWaitTime();
?>



<div class="page" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" >
    <div class="bg_image" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;background-image:url(<?=Yii::$app->request->hostInfo?>/img/bg_content.png);background-repeat:no-repeat;background-size:cover;background-position:center;" >
        <div class="container-new" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:100%;max-width:990px;margin-left:auto;margin-right:auto;" >

            <div class="success-buy text-center" style="text-align:center; box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;vertical-align:middle;font-size:45px;line-height:1.2;font-family:'CirceBold';letter-spacing:1.5px;color:#1a2e5c;margin-bottom:25px;" >Вы купили VIP прогноз</div>
            <div class="forecast-info" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;text-align: center;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;" >
                <div class="itemArticles__image" style="height:300px; background-image: url(<?=$message->embed($img);?>); box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:100%;background-repeat:no-repeat;background-position:center;background-size:contain;" ></div>
                <div class="itemArticles__info vip" style="background-color: #fff;padding-top: 20px;padding-bottom: 25px;padding-right: 25px;padding-left: 25px;box-sizing: content-box; width: 70%; display: inline-block;" >
                    <div class="itemArticles__title text-center" style="color:#1a2e5c;text-align:center;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;height:63px;margin-bottom:12px;font-size:26px;line-height:1.23;overflow:hidden;font-family:'CirceBold';" ><?=$model->title?></div>
                    <div class="itemArticles__infoWrap" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" >
                        <div class="articleInfo__date" style="color:#1a2e5c;box-sizing:border-box;display:inline-block;vertical-align:middle;margin-top:10px;font-size:15px;white-space:nowrap;width: 30%;padding-left:0%;" >
                            <div class="articleInfo__date__icon" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:30px;height:30px;display:inline-block;vertical-align:middle;margin-right:5px;background-size:100%;background-image:url(<?=Yii::$app->request->hostInfo?>/img/1.png);" ></div>
                            <?=$model->GetDate()?>
                        </div>
                        <div class="articleInfo__time" style="color:#1a2e5c;box-sizing:border-box;display:inline-block;vertical-align:middle;margin-top:10px;font-size:15px;white-space:nowrap;width: 30%;padding-left:0%;" >
                            <div class="articleInfo__time__icon" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:30px;height:30px;display:inline-block;vertical-align:middle;margin-right:5px;background-size:100%;background-image:url(<?=Yii::$app->request->hostInfo?>/img/2.png);" ></div>
                            <?=$model->GetTime()?>
                        </div>
                        <div class="articleInfo__koef" style="color:#1a2e5c;box-sizing:border-box;display:inline-block;vertical-align:middle;margin-top:10px;font-size:15px;white-space:nowrap;width: 30%;padding-left:0%;" >
                            <div class="articleInfo__koef__icon" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:30px;height:30px;display:inline-block;vertical-align:middle;margin-right:5px;background-size:100%;background-image:url(<?=Yii::$app->request->hostInfo?>/img/3.png);" ></div>
                            Коэф: <?=$model->odds_from?> - <?=$model->odds_to?>
                        </div>
                        <?php if ($wait) : ?>
                        <div class="articleInfo__wait" style="color:#1a2e5c;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" >
                            <div class="articleInfo__wait__icon" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" ></div>
                            <?=$wait?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="buy-text articleText" style="text-align:center; color:#1a2e5c;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;font-size:16px;line-height:1.55;" >
                <div style="display: inline-block;width: 70%;"><?=$model->desc?></div>
            </div>
            <div class="buyer-info" style="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding-top:5px;padding-bottom:30px;padding-right:5px;padding-left:5px;text-align:center;color:#1a2e5c;text-decoration:none;font-size:30px;margin-top:20px;" >
            </div>

        </div>
    </div>

</div>

