<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\memberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'member_type') ?>

    <?= $form->field($model, 'member_photo') ?>

    <?php // echo $form->field($model, 'member_name') ?>

    <?php // echo $form->field($model, 'member_phone') ?>

    <?php // echo $form->field($model, 'qq_openid') ?>

    <?php // echo $form->field($model, 'weibo_openid') ?>

    <?php // echo $form->field($model, 'verify') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
