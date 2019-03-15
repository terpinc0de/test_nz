<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\menu\MenuModule as M;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\forms\backend\NodeForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $parentName string */
/* @var $isNewRecord bool */

?>
<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-12">

                <?= $form->field($model, 'parentId')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?php $btnName = $isNewRecord ? M::t('BUTTON_CREATE') : M::t('BUTTON_SAVE'); ?>
                    <?= Html::submitButton($btnName, ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>