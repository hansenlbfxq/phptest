<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdcarrier/savereq/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="req_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($carrierreq, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>面积需求(㎡)</td>
            <td><?= $form->field($carrierreq,'area_reqs')->dropdownList(ArrayHelper::map($area,'id','name'))->label(false) ?> 平方米</td>
        </tr>
        <tr>
            <td>期望价格(元)</td>
            <td><?= $form->field($carrierreq, 'price')->dropdownList(ArrayHelper::map($price,'id','name'))->label(false); ?> 元/平方米/月</td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($carrierreq, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($carrierreq, 'link_tel')->label(false); ?></td>
        </tr>
        <tr>
            <td>区域</td>
            <td><?= $form->field($carrierreq, 'country')->label(false); ?></td>
        </tr>
        <tr>
            <td>载体类型	</td>
            <td><?= $form->field($carrierreq,'carrier_type_id')->dropdownList(ArrayHelper::map($carrier,'id','name'))->label(false) ?></td>
        </tr>
        <tr>
            <td>其他</td>
            <td><?= $form->field($carrierreq, 'other')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>