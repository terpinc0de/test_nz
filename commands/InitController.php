<?php

namespace app\modules\menu\commands;

use yii\console\Controller;
use app\modules\menu\models\Node;
use app\modules\menu\storages\interfaces\INodeStorage;

class InitController extends Controller
{
    private $itemStorage;

    public function __construct($id, $module,
        INodeStorage $itemStorage,
        $config = [])
    {
        $this->itemStorage = $itemStorage;
        parent::__construct($id, $module, $config);
    }

    public function actionCreateRoot()
    {
        echo 'Menu: create root node.' . PHP_EOL;
        $fixture = require __DIR__ . '/fixtures/root.php';
        $model = new Node($fixture);
        echo $this->itemStorage->makeRoot($model)?
            'root node created':
            'root node not created';
        echo PHP_EOL;
    }
}