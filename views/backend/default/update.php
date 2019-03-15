<?php

use yii\helpers\Html;
use app\modules\menu\MenuModule as M;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\forms\backend\NodeForm */

$this->title = M::t('UPDATE_NODE "{name}"', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => M::t('NODES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-update">
    <h1><?= $title ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'isNewRecord' => false,
    ]) ?>
</div>
