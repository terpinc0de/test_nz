<?php

use yii\helpers\Html;
use app\modules\menu\MenuModule as M;
use app\modules\menu\helpers\TreeHelper;
use app\modules\menu\assets\MenuAsset;

MenuAsset::register($this);

?>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <?= Html::a(
                M::t('CREATE_NODE'),
                TreeHelper::createAddUrl($rootId, M::t('MAIN_NODE')),
                [
                    'class' => 'btn btn-success'
                ]
            ) ?>
        </div>
    </div>
</div>
<br>

<?php if(!$tree): ?>
    <h3><?= M::t('NAV_ITEMS_NOT_FOUND') ?></h3>
    <?php return; ?>
<?php endif; ?>

<ul>
    <?php foreach($tree as $item): ?>
        <?= TreeHelper::renderItem($item, $rootId) ?>
    <?php endforeach; ?>
</ul> 