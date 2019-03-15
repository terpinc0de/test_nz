<?php

namespace app\modules\menu\controllers\backend;

use Yii;
use yii\web\Controller;
use app\modules\menu\services\TreeService;
use app\modules\menu\models\Node;
use app\modules\menu\MenuModule as M;
use app\modules\menu\forms\backend\NodeForm;

class DefaultController extends Controller
{
    private $treeService;

    public function __construct($id, $module, TreeService $treeService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->treeService = $treeService;
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'tree' => $this->treeService->getMenuForEdit(),
            'rootId' => $this->treeService->getRootId(),
        ]);
    }

    public function actionCreate($parent_id, $parent_name)
    {
        $form = new NodeForm(new Node());
        $form->parentId = $parent_id;
        $post = Yii::$app->request->post();

        if($form->load($post) && $form->validate() && $this->treeService->save($form->getModel(), $parent_id)) {
            Yii::$app->session->setFlash('success', M::t('NODE_CREATED'));
            return $this->redirect("index");
        }

        return $this->render('create', [
            'model' => $form,
            'parentName' => $parent_name,
        ]);
    }

    public function actionUpdate($id, $parent_id)
    {
        $model = $this->treeService->findNodeById($id);
        $form = new NodeForm($model);
        $form->parentId = $parent_id;
        $post = Yii::$app->request->post();

        if($form->load($post) && $form->validate() && $this->treeService->save($form->getModel(), $parent_id)) {
            Yii::$app->session->setFlash('success', M::t('NODE_UPDATED'));
            return $this->redirect("index");
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        if($this->treeService->delete($id)) {
            Yii::$app->session->setFlash('success', M::t('NODE_DELETED'));
        } else {
            Yii::$app->session->setFlash('danger', M::t('NODE_IS_NOT_DELETED'));
        }

        return $this->redirect("index");
    }
}