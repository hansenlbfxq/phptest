<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdskill/savesup/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="sup_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($skillsup, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>技术名称 <span>*</span></td>
            <td><?= $form->field($skillsup, 'reqs')->label(false); ?></td>
        </tr>
        <tr>
            <td>技术内容</td>
            <td><?= $form->field($skillsup, 'content')->label(false); ?></td>
        </tr>
        <tr>
            <td>希望价格(元)</td>
            <td><?= $form->field($skillsup, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($skillsup, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($skillsup, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>