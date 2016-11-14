<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdcapital/savesup/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="sup_id" value="<?= $id ?>">
        <tr>
            <td>产品名称 <span>*</span></td>
            <td><?= $form->field($capitalsup, 'product')->label(false); ?></td>
        </tr>
        <tr>
            <td>担保方式 <span>*</span></td>
            <td><?= $form->field($capitalsup, 'bonding_type')->label(false); ?></td>
        </tr>
        <tr>
            <td>资金供应方</td>
            <td><?= $form->field($capitalsup, 'supply')->label(false); ?></td>
        </tr>
        <tr>
            <td>贷款期限(月)</td>
            <td><?= $form->field($capitalsup, 'loan_months')->label(false); ?></td>
        </tr>
        <tr>
            <td>贷款金额(万元)</td>
            <td><?= $form->field($capitalsup, 'loan_total')->label(false); ?></td>
        </tr>
        <tr>
            <td>还款方式</td>
            <td><?= $form->field($capitalsup, 'return_type')->label(false); ?></td>
        </tr>
        <tr>
            <td>贷款利率</td>
            <td><?= $form->field($capitalsup, 'loan_rate')->label(false); ?></td>
        </tr>
        <tr>
            <td>适用地区</td>
            <td><?= $form->field($capitalsup, 'areas')->label(false); ?></td>
        </tr>
        <tr>
            <td>最大贷款期限(月)</td>
            <td><?= $form->field($capitalsup, 'max_loan_months')->label(false); ?></td>
        </tr>
        <tr>
            <td>最大贷款金额(万元)</td>
            <td><?= $form->field($capitalsup, 'max_loan_total')->label(false); ?></td>
        </tr>
        <tr>
            <td>资金方联系人</td>
            <td><?= $form->field($capitalsup, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>资金联系电话</td>
            <td><?= $form->field($capitalsup, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>