<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdproduct/savereq/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>

        <input type="hidden" name="req_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($productreq, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>产品名称 <span>*</span></td>
            <td><?= $form->field($productreq,'product')->label(false) ?></td>
        </tr>
        <tr>
            <td>产品简介 <span>*</span></td>
            <td><?= $form->field($productreq, 'content')->textArea(['rows'=>6,])->label(false); ?></td>
        </tr>
        <tr>
            <td>希望价格</td>
            <td><?= $form->field($productreq, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($productreq, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系方式</td>
            <td><?= $form->field($productreq, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>