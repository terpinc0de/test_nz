<?php

namespace app\modules\menu\services;

use app\modules\menu\storages\interfaces\INodeStorage;
use app\modules\menu\models\Node;
use app\modules\menu\exceptions\NodeNotFoundException;

class TreeService
{
    private $nodeStorage;

    public function __construct(INodeStorage $nodeStorage)
    {
        $this->nodeStorage = $nodeStorage;
    }

    /**
     * returns tree in format:
     * [
     *      [
     *          'id' => ,
     *          'name' => ,
     *          'children' => [],
     *      ]
     * ]
     * Creates recursively.
     * 
     * @return array
     */
    public function getMenuForEdit()
    {
        $root = $this->findRoot();
        $result = $this->findChildren($root);
        return $result;
    }

    /**
     * returns root node id
     * 
     * @return int
     */
    public function getRootId()
    {
        return $this
            ->findRoot()
            ->id;
    }

    /**
     * finds node by node id
     * 
     * @param int $nodeId
     * @return Node
     * @throws NodeNotFoundException
     */
    public function findNodeById($nodeId)
    {
        if(!($node = $this->nodeStorage->findOne($nodeId))) {
            throw new NodeNotFoundException('node with id = ' . $nodeId . ' not found.');
        }

        return $node;
    }

    /**
     * saves node
     * 
     * @param Node $child
     * @param int $parentId
     * @return bool
     */
    public function save(Node $child, $parentId)
    {
        $parent = $this->findNodeById($parentId);
        return $this->nodeStorage->save($child, $parent);
    }

    /**
     * deletes node
     * 
     * @param int $id node id
     * @return bool
     */
    public function delete($id)
    {
        $node = $this->findNodeById($id);
        return $this->nodeStorage->delete($node);
    }

    private function findRoot()
    {
        $root = $this->nodeStorage->findByName(Node::NODE_MAIN);
        if(!$root) {
            throw new NodeNotFoundException('root node not found');
        }

        return $root;
    }

    private function findChildren(Node $parent)
    {
        $result = [];
        $children = $this->nodeStorage->findChildren($parent);
        if($children) {
            foreach ($children as $child) {
                $result[] = [
                    'id' => $child->id,
                    'name' => $child->name,
                    'children' => $this->findChildren($child),
                ];
            }
        }

        return $result;
    }
}