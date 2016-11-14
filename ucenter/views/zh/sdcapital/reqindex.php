<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\services\BsSdServices;

$bsSd = new BsSdServices();
?>

<table>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['/sdcapital/editreq']);?>">添加</a>
    <button onclick="getDeleteId('deletereq')">删除</button>
    <tr>
        <td><input type="checkbox"></td>
        <td>企业名称</td>
        <td>申请金额(万元)</td>
        <td>联系人</td>
        <td>联系方式</td>
        <td>状态</td>
        <td>发布时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($capitalreq as $req): ?>
        <tr>
            <td><input type="checkbox" class="check_delete_id" value="<?= $req->id; ?>"></td>
            <td><?= $req->company; ?></td>
            <td><?= $req->capital_req; ?></td>
            <td><?= $req->link_name; ?></td>
            <td><?= $req->link_tel; ?></td>
            <td data-status="<?= $req->status; ?>"><?= $bsSd->getSdStatus($req->status); ?></td>
            <td><?= $req->created ?></td>
            <td><a href="<?= $bsSd->getEditUrl($this->context->id, 'req', $req->id) ?>">[编辑]</a></td>
        </tr>
    <?php endforeach; ?>
</table>