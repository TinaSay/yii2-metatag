<?php

namespace tina\metatag\controllers\backend;

use Yii;
use tina\metatag\models\Metatag;
use krok\system\components\backend\Controller;

/**
 * Class DefaultController
 *
 * @package tina\metatag\controllers\backend
 */
class DefaultController extends Controller
{
    /**
     * @var string
     */
    public $defaultAction = 'update';

    /**
     * @return string
     */
    public function actionUpdate()
    {
        $model = Metatag::find()->where([
            'model' => 'index',
            'recordId' => 0,
        ])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Обновлено');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
