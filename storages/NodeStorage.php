<?php

namespace app\modules\menu\storages;

use app\modules\menu\storages\interfaces\INodeStorage;
use app\modules\menu\models\Node;

class NodeStorage implements INodeStorage
{
    /**
     * @inheritdoc
     */
    public function findOne($nodeId)
    {
        return Node::findOne($nodeId);
    }

    /**
     * @inheritdoc
     */
    public function findByName($nodeName)
    {
        return Node::findOne(['name' => $nodeName]);
    }

    /**
     * @inheritdoc
     */
    public function makeRoot(Node $model)
    {
        return $model->makeRoot();
    }

    /**
     * @inheritdoc
     */
    public function findChildren(Node $model)
    {
        return $model->children(1)->all();
    }

    /**
     * @inheritdoc
     */
    public function save(Node $child, Node $parent)
    {
        return $child->appendTo($parent);
    }

    /**
     * @inheritdoc
     */
    public function delete(Node $model)
    {
        return $model->deleteWithChildren();
    }
}