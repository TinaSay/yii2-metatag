<?php
/** @var $form \yii\widgets\ActiveForm * */
/** @var $model \tina\metatag\models\Metatag */

use tina\metatag\assets\MetatagAsset;

MetatagAsset::register($this);
?>
<div class="row" style="margin-bottom:30px;">
    <div class="col-md-6">
        <input type="checkbox" id="metatagSwitcher" class="switch">
        <label for="metatagSwitcher">Настройка метатегов</label>
    </div>
</div>
<div class="metatags">

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commonTitle')->dropDownList($model::getCommonList()) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commonDescription')->dropDownList($model::getCommonList()) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commonKeywords')->dropDownList($model::getCommonList()) ?>

</div>

