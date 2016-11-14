<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<script>
    $(function(){
        UE.getEditor('editor_p');
        UE.getEditor('editor_i');
        UE.getEditor('editor_d');
        UE.getEditor('editor_s');
        UE.getEditor('editor_c');
    })
</script>


<?php $form = ActiveForm::begin(array('id' => 'abc','action' => array('applysenior/post/'), 'options' => array('enctype'=>'multipart/form-data'))); ?>
    <table>
        <thead>
            <tr>
                <td colspan="10">企业基本信息</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>单位名称</td>
                <td><?= $form->field($memberSenior, 'name')->label(false) ?></td>
                <td>注册资金(万元)</td>
                <td><?= $form->field($memberSenior, 'capital')->label(false) ?></td>
                <td>办公地址</td>
                <td colspan="2"><?= $form->field($memberSenior, 'address')->label(false) ?></td>
            </tr>
            <tr>
                <td>所属孵化器</td>
                <td><?= $form->field($memberSenior,'incubator_id')->dropdownList(ArrayHelper::map($incubators,'id','name'))->label(false) ?></td>
                <td>行业领域</td>
                <td colspan="3"><?= $form->field($memberSeniorIndustry,'id')->checkboxList($industryArray)->label(false); ?></td>
            </tr>
            <tr>
                <td>法定代表人</td>
                <td><?= $form->field($memberSenior, 'co_name')->label(false) ?></td>
                <td>移动电话</td>
                <td><?= $form->field($memberSenior, 'mobile')->label(false) ?></td>
                <td>电子邮箱</td>
                <td colspan="2"><?= $form->field($memberSenior, 'email')->label(false) ?></td>
            </tr>
            <tr>
                <td rowspan="2">联系人</td>
                <td>姓名</td>
                <td><?= $form->field($memberSenior, 'link_name')->label(false) ?></td>
                <td>办公电话</td>
                <td><?= $form->field($memberSenior, 'link_tel')->label(false) ?></td>
                <td>传真</td>
                <td><?= $form->field($memberSenior, 'link_fax')->label(false) ?></td>
            </tr>
            <tr>
                <td>移动电话</td>
                <td><?= $form->field($memberSenior, 'link_mobile')->label(false) ?></td>
                <td>电子邮箱</td>
                <td><?= $form->field($memberSenior, 'link_email')->label(false) ?></td>
                <td>QQ号码</td>
                <td><?= $form->field($memberSenior, 'link_qq')->label(false) ?></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <td colspan="10">企业其他信息</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span>企业产品简介</span><span></span></td>
                <td colspan="8"><?= $form->field($memberSenior, 'product')->textArea(['rows'=>6,'id'=>'editor_p','class'=>'col-sm-1 col-md-12'])->label(false) ?></td>
            </tr>
            <tr>
                <td><span>自主创新情况</span><span></span></td>
                <td colspan="8"><?= $form->field($memberSenior, 'innovate')->textArea(['rows'=>6,'id'=>'editor_i','class'=>'col-sm-1 col-md-12'])->label(false) ?></td>
            </tr>
            <tr>
                <td><span>建立研发机构</span><span></span></td>
                <td colspan="8"><?= $form->field($memberSenior, 'development')->textArea(['rows'=>6,'id'=>'editor_d','class'=>'col-sm-1 col-md-12'])->label(false) ?></td>
            </tr>
            <tr>
                <td><span>承担上级科技计划</span><span></span></td>
                <td colspan="8"><?= $form->field($memberSenior, 'science')->textArea(['rows'=>6,'id'=>'editor_s','class'=>'col-sm-1 col-md-12'])->label(false) ?></td>
            </tr>
            <tr>
                <td><span>科研合作等信息</span><span></span></td>
                <td colspan="8"><?= $form->field($memberSenior, 'collaborate')->textArea(['rows'=>6,'id'=>'editor_c','class'=>'col-sm-1 col-md-12'])->label(false) ?></td>
            </tr>
        </tbody>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Submit') ?>
    </div>
<?php ActiveForm::end(); ?>
