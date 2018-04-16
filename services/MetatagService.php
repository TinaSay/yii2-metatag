<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 10.04.18
 * Time: 17:30
 */

namespace tina\metatag\services;

use tina\metatag\models\Metatag;
use Yii;

/**
 * Class MetatagService
 *
 * @package tina\metatag\services
 */
class MetatagService
{
    /**
     * @param string $model
     * @param int $recordId
     *
     * @return bool
     */
    public function execute(string $model, int $recordId)
    {
        $currentModel = Metatag::find()->where([
            'model' => $model,
            'recordId' => $recordId,
        ])->one();

        if ($currentModel == null) {
            $currentModel = new Metatag([
                'model' => $model,
                'recordId' => $recordId,
            ]);
        }
        if ($currentModel->load(Yii::$app->request->post()) && $currentModel->save()) {
            return true;
        } else {
            return false;
        }
    }
}
