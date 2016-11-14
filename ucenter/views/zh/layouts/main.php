<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::cssFile(Yii::$app->params['asserts_url']."ucenter/css/common.css");?>
    <?= Html::jsFile(Yii::$app->params['asserts_url']."ucenter/js/jquery-1.12.4.min.js");?>
    <?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody(); ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
