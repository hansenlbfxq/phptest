<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\services\BsSdServices;

$bsSd = new BsSdServices();
?>

<table>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['/sdskill/editsup']);?>">添加</a>
    <button onclick="getDeleteId('deletesup')">删除</button>
    <tr>
        <td><input type="checkbox"></td>
        <td>企业名称</td>
        <td>技术名称</td>
        <td>希望价格(元)</td>
        <td>联系人</td>
        <td>联系方式</td>
        <td>状态</td>
        <td>发布时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($skillsup as $sup): ?>
        <tr>
            <td><input type="checkbox" class="check_delete_id" value="<?= $sup->id; ?>"></td>
            <td><?= $sup->company; ?></td>
            <td><?= $sup->reqs; ?></td>
            <td><?= $sup->price; ?></td>
            <td><?= $sup->link_name; ?></td>
            <td><?= $sup->link_tel; ?></td>
            <td data-status="<?= $sup->status; ?>"><?= $bsSd->getSdStatus($sup->status); ?></td>
            <td><?= $sup->created ?></td>
            <td><a href="<?= $bsSd->getEditUrl($this->context->id, 'sup', $sup->id) ?>">[编辑]</a></td>
        </tr>
    <?php endforeach; ?>
</table>