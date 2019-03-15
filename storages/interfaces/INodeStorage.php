<?php

namespace app\modules\menu\storages\interfaces;

use app\modules\menu\models\Node;

interface INodeStorage
{
    /** 
     * saves the node as root
     * 
     * @param Node $model
     * @return bool
     */
    public function makeRoot(Node $model);

    /**
     * finds first level children by node
     * 
     * @param Node $model
     * @return array|null [[app\modules\menu\models\Node]]
     */
    public function findChildren(Node $model);

    /**
     * finds node by node name
     * 
     * @param string $nodeName
     * @return Node|null
     */
    public function findByName($nodeName);

    /**
     * finds node by node id
     * 
     * @param int $nodeId
     * @return Node|null
     */
    public function findOne($nodeId);

    /** 
     * removes node
     * 
     * @param Node $model
     * @return bool
     */
    public function delete(Node $model);

    /**
     * saves node and appends to parent
     * 
     * @param Node $child
     * @param Node $parent
     * @return bool
     */
    public function save(Node $child, Node $parent);
}