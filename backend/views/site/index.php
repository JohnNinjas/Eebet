<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Статистика';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="text-center">Статистика</h1>
    </div>

    <div class="body-content">

		<!--<h3>Main Banner settings</h3>

		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	    <?= $form->field($upload_form, 'files')->fileInput(['multiple' => false]) ?>
	
	    <?=Html::submitButton('Upload Main Banner', ['class' => 'btn btn-info']) ?>
	
	    <?php ActiveForm::end(); ?>
		
		<?=Html::a('Delete Main Banner', ['site/delete-banner'], ['class' => 'btn btn-warning']) ?>
	
	
	    <?=Html::img(\backend\models\SiteSettings::getMainBannerUrl()) ?>

	    -->
		
    </div>
</div>
