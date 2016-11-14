<?php
namespace app\controllers;


use Yii;
use app\exts\QrckController;

use app\models\BsMemberSenior;
use app\models\BsMemberIncubator;
use app\models\BsMemberSeniorIndustry;
use app\services\BdataServices;

class AjaxController extends QrckController
{
	public $layout=false;
	/**
	 *
	 * 获取菜单
	 *
	 * @access public
	 * @since 1.0
	 * @return null
	 */
	public function actionMenus()
	{
		echo "ab";exit;
	}

}
