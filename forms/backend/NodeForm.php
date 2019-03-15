<?php

namespace app\modules\menu\forms\backend;

use yii\base\Model;
use app\modules\menu\models\Node;

class NodeForm extends Model
{
    public $parentId;

    public $name;

    public $link;

    private $model;

    public function __construct(Node $model)
    {
        $this->name = $model->name;
        $this->link = $model->link;
        $this->model = $model;
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'link'], 'string', 'max' => 255],
            [['link'], 'default', 'value' => '#'],
            [['parentId'], 'exist', 'targetClass' => Node::className(), 'targetAttribute' => 'id', 'skipOnError' => false],
        ];
    }

    public function getModel()
    {
        $this->model->name = $this->name;
        $this->model->link = $this->link;
        return $this->model;
    }
}