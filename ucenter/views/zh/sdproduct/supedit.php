<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('sdproduct/savesup/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="sup_id" value="<?= $id ?>">
        <tr>
            <td>企业名称 <span>*</span></td>
            <td><?= $form->field($productsup, 'company')->label(false); ?></td>
        </tr>
        <tr>
            <td>产品名称 <span>*</span></td>
            <td><?= $form->field($productsup, 'product')->label(false); ?></td>
        </tr>
        <tr>
            <td>产品简介</td>
            <td><?= $form->field($productsup, 'content')->label(false); ?></td>
        </tr>
        <tr>
            <td>希望价格(元)</td>
            <td><?= $form->field($productsup, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($productsup, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系方式</td>
            <td><?= $form->field($productsup, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>