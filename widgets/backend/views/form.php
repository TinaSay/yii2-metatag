<?php
/** @var $form \yii\widgets\ActiveForm * */
/** @var $model \tina\metatag\models\Metatag */
?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'commonTitle')->dropDownList($model::getCommonList()) ?>

<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'commonDescription')->dropDownList($model::getCommonList()) ?>

<?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'commonKeywords')->dropDownList($model::getCommonList()) ?>
