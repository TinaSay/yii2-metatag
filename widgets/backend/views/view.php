<?php
/** @var $model \tina\metatag\models\Metatag */

use yii\widgets\DetailView;

?>
<div class="panel panel-default">
    <h3 class="panel-heading">Метатеги страницы</h3>
    <div class="panel-body">
        <?= DetailView::widget([
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                'title',
                'description',
                'keywords',
            ],
        ]) ?>
    </div>
</div>
