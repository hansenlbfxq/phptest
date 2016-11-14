<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdskill/savereq/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>

        <input type="hidden" name="req_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($skillreq, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>技术需求 <span>*</span></td>
            <td><?= $form->field($skillreq,'reqs')->label(false) ?></td>
        </tr>
        <tr>
            <td>技术内容 <span>*</span></td>
            <td><?= $form->field($skillreq, 'content')->label(false); ?></td>
        </tr>
        <tr>
            <td>希望价格(元)</td>
            <td><?= $form->field($skillreq, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($skillreq, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系方式</td>
            <td><?= $form->field($skillreq, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>