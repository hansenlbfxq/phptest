<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array('id' => 'abc', 'action' => array('sdpatent/savesup/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <input type="hidden" name="sup_id" value="<?= $id ?>">
        <tr>
            <td>专利类型 <span>*</span></td>
            <td><?= $form->field($patentsup, 'ptype')->label(false); ?></td>
        </tr>
        <tr>
            <td>专利名称 <span>*</span></td>
            <td><?= $form->field($patentsup, 'name')->label(false); ?></td>
        </tr>
        <tr>
            <td>专利方 <span>*</span></td>
            <td><?= $form->field($patentsup, 'sup_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>国家及地区</td>
            <td><?= $form->field($patentsup, 'areas')->label(false); ?></td>
        </tr>
        <tr>
            <td>拟交易价格</td>
            <td><?= $form->field($patentsup, 'price')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><?= $form->field($patentsup, 'link_name')->label(false); ?></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><?= $form->field($patentsup, 'link_tel')->label(false); ?></td>
        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>

<?php ActiveForm::end(); ?>