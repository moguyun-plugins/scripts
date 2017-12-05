<?php

use moguyun\plugins\scripts\models\Script;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model Script */

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'position')->dropDownList(Script::getPositionList()) ?>
<?= $form->field($model, 'content')->textarea(['rows' => 15, 'placeholder' => '在此输入相关脚本']) ?>
<div class="form-group">
    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
