<?php

use yii\helpers\Html;
use app\modules\menu\MenuModule as M;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\forms\backend\NodeForm */

$this->title = M::t('NODE_CREATION');
$this->params['breadcrumbs'][] = ['label' => M::t('NODES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
    <h1><?= M::t('CREATE_NODE_WITH_PARENT "{name}"', [
        'name' => $parentName,
    ]) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isNewRecord' => true,
    ]) ?>
</div>
