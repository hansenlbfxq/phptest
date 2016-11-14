<?php
use yii\helpers\Html;
use common\services\SCommonHtml;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link type="text/css" href="<?=SCommonHtml::getAssets("common/css/com.css")?>" rel="stylesheet">
    <link type="text/css" href="<?=SCommonHtml::getAssets("common/css/error.css")?>" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?= $content ?>
</body>
</html>