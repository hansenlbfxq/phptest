<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdcarrier/savesup/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="sup_id" value="<?= $id ?>">
        <tr>
            <td>载体面积(㎡)</td>
            <td><?= $form->field($carriersup, 'carrier_area')->label(false); ?></td>
        </tr>
        <tr>
            <td>可租面积(㎡)</td>
            <td><?= $form->field($carriersup, 'rent_area')->label(false); ?> 平方米</td>
        </tr>
        <tr>
            <td>地址 <span>*</span></td>
            <td><?= $form->field($carriersup, 'address')->label(false); ?></td>
        </tr>
        <tr>
            <td>房租价格(元)</td>
            <td><?= $form->field($carriersup, 'rental')->label(false); ?> 元/平方米/月</td>
        </tr>
        <tr>
            <td>物管费(元)</td>
            <td><?= $form->field($carriersup, 'property')->label(false); ?> 元/平方米/月</td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($carriersup, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($carriersup, 'link_tel')->label(false); ?></td>
        </tr>
        <tr>
            <td>载体类型</td>
            <td><?= $form->field($carriersup,'carrier_type_id')->dropdownList(ArrayHelper::map($carrier,'id','name'))->label(false) ?></td>
        </tr>
        <tr>
            <td>优惠信息</td>
            <td><?= $form->field($carriersup, 'coupon')->label(false); ?></td>
        </tr>
        <tr>
            <td>备注</td>
            <td><?= $form->field($carriersup, 'note')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>