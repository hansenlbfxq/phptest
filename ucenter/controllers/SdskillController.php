<?php
namespace app\controllers;

use app\models\BsSdSkillReq;
use app\models\BsSdSkillSup;
use app\services\BsSdServices;
use Yii;
use Yii\filters\AccessControl;
use app\exts\QrckController;
use app\services\BdataServices;

class SdskillController extends QrckController
{
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
     * get BsSdServices
     * @return BsSdServices
     */
    public function getBsSdClass()
    {
        return new BsSdServices;
    }

    /**
     * render reqindex
     * @return string
     */
    public function actionReq()
    {
        $memberId = $this->getMemberId();

        $skillReq = BsSdSkillReq::find()
            ->select(array('id', 'company', 'reqs', 'price', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('reqindex', array(
            'skillreq'=>  $skillReq,
        ));
    }

    /**
     * render supindex
     * @return string
     */
    public function actionSup()
    {
        $memberId = $this->getMemberId();

        $skillSup = BsSdSkillSup::find()
            ->select(array('id', 'company', 'reqs', 'price', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('supindex', array(
            'skillsup'    =>  $skillSup
        ));
    }

    /**
     * render req edit
     * @return string
     */
    public function actionEditreq()
    {
        // get member id
        $memberId = $this->getMemberId();
        $id = Yii::$app->request->get('id');

        $skillReq = $this->getBsSdClass()->getModel($id,new BsSdSkillReq(),$memberId);

        $bdata = new BdataServices();

        return $this->render('reqedit', array(
            'skillreq'    =>  $skillReq,
            'id'    =>  $id,
        ));
    }

    /**
     * render sup edit
     * @return string
     */
    public function actionEditsup()
    {
        // get member id
        $memberId = $this->getMemberId();
        $id = $id = Yii::$app->request->get('id');

        $skillSup = $this->getBsSdClass()->getModel($id,new BsSdSkillSup(),$memberId);

        $bdata = new BdataServices();

        return $this->render('supedit', array(
            'skillsup'    =>  $skillSup,
            'id'    =>  $id,
        ));
    }

    /**
     * save req post
     */
    public function actionSavereq()
    {
        // get member id
        $memberId = $this->getMemberId();

        $params=Yii::$app->getRequest()->getBodyParams();
        $paramData = $params['BsSdSkillReq'];
        $id = $params['req_id'];

        $req = $this->getBsSdClass()->getModel($id,new BsSdSkillReq(),$memberId);
        // get id is not null
        $id = $req->id;
        $paramData['lan'] = BsSdServices::LANGUAGE_CHINESE_VALUE;
        $paramData = $this->getBsSdClass()->getData($id, $memberId, $paramData);

        try {
            $req->setAttributes($paramData,false);
            $req->save();
        } catch(Exception $e) {
            $e->getMessage();
            $this->redirect('editreq');
        }
        $this->redirect('req');
    }

    /**
     * save sup post
     */
    public function actionSavesup()
    {
        // get member id
        $memberId = $this->getMemberId();

        $params=Yii::$app->getRequest()->getBodyParams();
        $paramData = $params['BsSdSkillSup'];
        $id = $params['sup_id'];

        $sup = $this->getBsSdClass()->getModel($id,new BsSdSkillSup(),$memberId);

        // get id is not null
        $id = $sup->id;
        $paramData['lan'] = BsSdServices::LANGUAGE_CHINESE_VALUE;
        $paramData = $this->getBsSdClass()->getData($id, $memberId, $paramData);

        try {
            $sup->setAttributes($paramData,false);
            $sup->save();
        } catch(Exception $e) {
            echo 123;
            $e->getMessage();
            $this->redirect('editsup');
        }
        $this->redirect('sup');
    }

    /**
     * delete member check req id
     */
    public function actionDeletereq()
    {
        // get member id
        $memberId = $this->getMemberId();
        // get id array
        $idStr = substr(Yii::$app->request->get('id'), 0, -1);
        $ids = explode(',', $idStr);

        $this->getBsSdClass()->deleteSd($ids, new BsSdSkillReq(), $memberId);
        $this->redirect('req');
    }

    /**
     * delete member check sup id
     */
    public function actionDeletesup()
    {
        // get member id
        $memberId = $this->getMemberId();
        // get id array
        $idStr = substr(Yii::$app->request->get('id'), 0, -1);
        $ids = explode(',', $idStr);

        $this->getBsSdClass()->deleteSd($ids, new BsSdSkillSup(), $memberId);
        $this->redirect('sup');
    }
}
