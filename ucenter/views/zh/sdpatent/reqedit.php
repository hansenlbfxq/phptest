<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdpatent/savereq/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>

        <input type="hidden" name="req_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($patentreq, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>专利类型 <span>*</span></td>
            <td><?= $form->field($patentreq,'ptype')->label(false) ?></td>
        </tr>
        <tr>
            <td>专利名称 <span>*</span>	</td>
            <td><?= $form->field($patentreq, 'name')->label(false); ?></td>
        </tr>
        <tr>
            <td>申请方 <span>*</span></td>
            <td><?= $form->field($patentreq, 'req_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>国家及地区</td>
            <td><?= $form->field($patentreq, 'areas')->label(false); ?></td>
        </tr>
        <tr>
            <td>拟交易价格</td>
            <td><?= $form->field($patentreq, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($patentreq, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($patentreq, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>