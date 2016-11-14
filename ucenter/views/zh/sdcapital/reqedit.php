<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdcapital/savereq/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="req_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($capitalreq, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>申请金额(万元)</td>
            <td><?= $form->field($capitalreq,'capital_req')->dropdownList(ArrayHelper::map($capital,'id','name'))->label(false) ?></td>
        </tr>
        <tr>
            <td>贷款用途</td>
            <td><?= $form->field($capitalreq, 'useing')->label(false); ?></td>
        </tr>
        <tr>
            <td>法人代表</td>
            <td><?= $form->field($capitalreq, 'legal')->label(false); ?></td>
        </tr>
        <tr>
            <td>成立日期</td>
            <td><?= $form->field($capitalreq, 'reg_date')->label(false); ?></td>
        </tr>
        <tr>
            <td>注册资本(万元)</td>
            <td><?= $form->field($capitalreq, 'captial')->label(false); ?></td>
        </tr>
        <tr>
            <td>工商注册地</td>
            <td><?= $form->field($capitalreq, 'reg_address')->label(false); ?></td>
        </tr>
        <tr>
            <td>所属行业</td>
            <td><?= $form->field($capitalreq, 'industry')->label(false); ?></td>
        </tr>
        <tr>
            <td>专利情况</td>
            <td><?= $form->field($capitalreq, 'patent')->label(false); ?></td>
        </tr>
        <tr>
            <td>上年度销售收入(万元)</td>
            <td><?= $form->field($capitalreq, 'pre_income')->label(false); ?></td>
        </tr>
        <tr>
            <td>上年度净利润(万元)</td>
            <td><?= $form->field($capitalreq, 'pre_profit')->label(false); ?></td>
        </tr>
        <tr>
            <td>截止上年度银行贷款(万元)</td>
            <td><?= $form->field($capitalreq, 'pre_loan')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($capitalreq, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($capitalreq, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>