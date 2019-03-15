<?php

namespace app\modules\menu\models;

use creocoder\nestedsets\NestedSetsBehavior;
use app\modules\menu\queries\NodeQuery;

/**
 * @property int $id
 * @property string $name
 * @property string $link
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 */
class Node extends \yii\db\ActiveRecord
{
    // name of root node
    const NODE_MAIN = 'NODE_MAIN';

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function tableName()
    {
        return '{{%menu_node}}';
    }

    public static function find()
    {
        return new NodeQuery(get_called_class());
    }
}