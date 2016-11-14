<?php
namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use app\exts\QrckController;
use app\models\BsMemberSenior;
use app\models\BsMemberIncubator;
use app\models\BsMemberSeniorIndustry;
use app\services\BdataServices;

class ApplyseniorController extends QrckController
{
	/**
	 *
	 * 切换语言
	 *
	 * @access public
	 * @since 1.0
	 * @return null
	 */
	public function actionLanguage()
	{
		$locale = Yii::$app->request->get('language');
		if ($locale){
			setCookie("language",$locale,time()+3600*24*30);
		}
		$this->goBack(Yii::$app->request->headers['Referer']);
	}

	/**
	 * get member id
	 * @return int
	 */
	public function getMemberId()
	{
		$memberId = 4;
		return $memberId;
	}

	/**
	 * this member has been applied
	 * @param $memberId
	 * @return bool
	 */
	public function memberExist($memberId)
	{
		$memberSenior = BsMemberSenior::find()->where(array('member_id' => $memberId))->one();
		if (!$memberSenior) {
			$memberSenior = new BsMemberSenior;
		}
		return $memberSenior;
	}

	/**
	 * validator
	 * render index.php
	 * @return string
	 */
    public function actionIndex()
	{
		// get member senior model
		$memberId = $this->getMemberId();
		$memberSenior = $this->memberExist($memberId);

		$bdata = new BdataServices();
		$industrys = $bdata->getDataByType($bdata::INDUSTRY_BTYPE_ID);

		// get industry array(id =>name)
		$industryArray = array();
		foreach ($industrys as $industry) {
			$industryArray[$industry->id] = $industry->name;
		}
		// get incubator
		$incubators = BsMemberIncubator::find()->select(array('id', 'name'))->all();

		$memberSeniorIndustry = new BsMemberSeniorIndustry();
		// checked industry id
		$industryIdArr = $this->getSeniorIndustryId($memberSenior);
		$memberSeniorIndustry->id = $industryIdArr;

		// 无论是初始化显示还是数据验证错误
		return $this->render('applysenior', array(
			'memberSenior'	=>	$memberSenior,
			'memberSeniorIndustry'	=>	$memberSeniorIndustry,
			'industry'	=>	$industrys,
			'industryArray' =>	$industryArray,
			'incubators'	=>	$incubators,
		));

    }

	/**
	 * save senior post
	 */
	public function actionPost()
	{
		// get member senior model
		$memberId = $this->getMemberId();
		$memberSenior = $this->memberExist($memberId);

		$memberSeniorIndustry = new BsMemberSeniorIndustry();
		// get post array
		$post = Yii::$app->request->post();

		$postMemberSenior = $post['BsMemberSenior'];
		$postMemberSeniorIndustry = $post['BsMemberSeniorIndustry'];
		// save member senior and save industry
		$seniorId = $this->saveMemberSenior($memberSenior, $memberId, $postMemberSenior);
		if (!empty($seniorId)) {
			$this->saveIndustry($memberSeniorIndustry, $seniorId, $postMemberSeniorIndustry);
		}

		$this->redirect('index');
	}


	/**
	 * get incubator member id
	 * @param $incubatorId
	 * @return mixed
	 */
	public function getIncubatorMemberId($incubatorId)
	{
		$incubatorMeber = BsMemberIncubator::findOne($incubatorId);
		return $incubatorMeber->member_id;
	}

	/**
	 * save member senior and get senior id
	 * @param $memberSenior
	 * @param $memberId
	 * @param $postMemberSenior
	 * @return mixed
	 */
	public function saveMemberSenior($_memberSenior,$memberId,$postMemberSenior)
	{
		$memberSenior = clone $_memberSenior;
		$id = $memberSenior->id;
		// save post
		// save member_id and incubator_member_id
		if (empty($id)) {
			$postMemberSenior['created'] = date('Y-m-d h:i:s',time());
		}
		$postMemberSenior['member_id'] = $memberId;
		$postMemberSenior['status'] = BsMemberSenior::SENIOR_STATUE_AUDIT;
		$postMemberSenior['incubator_member_id'] = $this->getIncubatorMemberId($postMemberSenior['incubator_id']);

		try {
			$memberSenior->setAttributes($postMemberSenior,false);
			$memberSenior->save();
		} catch(Exception $e) {
			$e->getMessage();
			return '';
		}
		return $memberSenior->id;
	}

	/**
	 * save industry
	 * @param $_memberSeniorIndustry
	 * @param $seniorId
	 * @param $postMemberSeniorIndustry
	 */
	public function saveIndustry($_memberSeniorIndustry,$seniorId,$postMemberSeniorIndustry)
	{
		$seniorIndustry = BsMemberSenior::find()->where(array('senior_id' => $seniorId));
		// delete this member all item
		if ($seniorIndustry) {
			$_memberSeniorIndustry->deleteAll('senior_id = :senior_id',array(':senior_id' => $seniorId));
		}
		// save this member check id
		$industryIds = $postMemberSeniorIndustry['id'];
		if (is_array($industryIds)) {
			foreach ($industryIds as $id) {
				$memberSeniorIndustry = clone $_memberSeniorIndustry;
				$memberSeniorIndustry->senior_id = $seniorId;
				$memberSeniorIndustry->industry_id = $id;
				$memberSeniorIndustry->insert();
			}
		}
	}

	/**
	 * get senior member check industry ids
	 * @param $memberSenior
	 * @return array
	 */
	public function getSeniorIndustryId($memberSenior)
	{
		$seniorId = $memberSenior->id;
		if (isset($seniorId)) {
			$memberIndustryArr = BsMemberSeniorIndustry::find()->select(array('industry_id'))->where(array('senior_id' => $seniorId))->all();
			// get industry id array
			$idArr = array();
			foreach ($memberIndustryArr as $memberIndustry) {
				$idArr[] = $memberIndustry->industry_id;
			}
			return $idArr;
		}
	}
}
