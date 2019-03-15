<?php

namespace app\modules\menu\helpers;

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\menu\MenuModule as M;

class TreeHelper
{
    public static function createAddUrl($parentId, $parentName)
    {
        return Url::toRoute([
            '/menu/default/create',
            'parent_id' => $parentId,
            'parent_name' => $parentName,
        ]);
    }

    public static function createEditUrl($id, $parentId)
    {
        return Url::toRoute([
            '/menu/default/update',
            'id' => $id,
            'parent_id' => $parentId,
        ]);
    }

    public static function createDeleteUrl($id)
    {
        return Url::toRoute([
            '/menu/default/delete',
            'id' => $id,
        ]);
    }

    public static function renderItem($item, $parentId)
    {
        $content = '';
        $content .= Html::tag('h4', $item['name'], ['class' => 'pull-left node__name']);

        $controls = Html::a(M::t('LINK_ADD'), self::createAddUrl($item['id'], $item['name']), ['class' => 'btn btn-success']);
        $controls .= Html::a(M::t('LINK_EDIT'), self::createEditUrl($item['id'], $parentId), ['class' => 'btn btn-primary']);
        $controls .= Html::a(M::t('LINK_DELETE'), self::createDeleteUrl($item['id']), [
            'class' => 'btn btn-danger',
            'data' => [
                'method' => 'post',
                'pjax' => '0',
                'confirm' => M::t('DELETE_CONFIRM_QUESTION'),
            ],
        ]);

        $content .= Html::tag('div', $controls, ['class' => 'pull-right']);
        $content = Html::tag('div', $content, ['class' => 'alert alert-warning row']);

        if($item['children']) {
            $subitems = '';
            foreach($item['children'] as $child) {
                $subitems .= self::renderItem($child, $item['id']);
            }
            $content .= Html::tag('ul', $subitems);
        }
        

        return Html::tag('li', $content);
    }
}