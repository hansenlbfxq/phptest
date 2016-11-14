<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\services\BsSdServices;


$bsSd = new BsSdServices();
?>

<table>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['/sdcarrier/editsup']);?>">添加</a>
    <button onclick="getDeleteId('deletesup')">删除</button>
    <tr>
        <td><input type="checkbox"></td>
        <td>载体名称</td>
        <td>载体面积(㎡)</td>
        <td>可租面积(㎡)</td>
        <td>房租价格(元)</td>
        <td>物管费(元)</td>
        <td>联系人</td>
        <td>联系电话</td>
        <td>载体类型</td>
        <td>状态</td>
        <td>发布时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($carriersup as $sup): ?>
        <tr>
            <td><input type="checkbox" class="check_delete_id" value="<?= $sup->id; ?>"></td>
            <td><?= $bsSd->getIncubatorById($sup->incubator_id); ?></td>
            <td><?= $sup->carrier_area; ?></td>
            <td><?= $sup->rent_area; ?></td>
            <td><?= $sup->rental; ?></td>
            <td><?= $sup->property; ?></td>
            <td><?= $sup->link_name; ?></td>
            <td><?= $sup->link_tel; ?></td>
            <td><?= $bsSd->getIncubatorTypeById($sup->carrier_type_id); ?></td>
            <td data-status="<?= $sup->status; ?>"><?= $bsSd->getSdStatus($sup->status); ?></td>
            <td><?= $sup->created ?></td>
            <td><a href="<?= $bsSd->getEditUrl($this->context->id, 'sup', $sup->id) ?>">[编辑]</a></td>
        </tr>
    <?php endforeach; ?>
</table>