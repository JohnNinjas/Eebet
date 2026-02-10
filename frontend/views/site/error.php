<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $exception->statusCode.' - '.$exception->getMessage();
?>
<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1><?=$exception->statusCode?></h1>
        </div>
        <h2><?=$exception->getMessage()?></h2>
        <a href="/" class="home-btn">На главную</a>
    </div>
</div>
