<?php

namespace app\modules\menu\queries;

use creocoder\nestedsets\NestedSetsQueryBehavior;

class NodeQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}