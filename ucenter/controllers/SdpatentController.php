<?php
namespace app\controllers;

use app\models\BsSdPatentReq;
use app\models\BsSdPatentSup;
use app\services\BsSdServices;
use Yii;
use Yii\filters\AccessControl;
use app\exts\QrckController;
use app\services\BdataServices;

class SdpatentController extends QrckController
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

        $patentReq = BsSdPatentReq::find()
            ->select(array('id', 'company', 'ptype', 'name', 'req_name','link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('reqindex', array(
            'patentreq'=>  $patentReq,
        ));
    }

    /**
     * render supindex
     * @return string
     */
    public function actionSup()
    {
        $memberId = $this->getMemberId();

        $patentSup = BsSdPatentSup::find()
            ->select(array('id', 'ptype', 'name', 'sup_name', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('supindex', array(
            'patentsup'    =>  $patentSup
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

        $patentReq = $this->getBsSdClass()->getModel($id,new BsSdPatentReq(),$memberId);

        $bdata = new BdataServices();


        return $this->render('reqedit', array(
            'patentreq'    =>  $patentReq,
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

        $patentSup = $this->getBsSdClass()->getModel($id,new BsSdPatentSup(),$memberId);

        $bdata = new BdataServices();


        return $this->render('supedit', array(
            'patentsup'    =>  $patentSup,
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
        $paramData = $params['BsSdPatentReq'];
        $id = $params['req_id'];

        $req = $this->getBsSdClass()->getModel($id,new BsSdPatentReq(),$memberId);
        // get id is not null
        $id = $req->id;
        $paramData['lan'] = BsSdServices::LANGUAGE_CHINESE_VALUE;
        $paramData = $this->getBsSdClass()->getData($id, $memberId, $paramData);

        try {
            $req->setAttributes($paramData,false);
            $req->save();
        } catch(Exception $e) {
            echo 123;
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
        $paramData = $params['BsSdPatentSup'];
        $id = $params['sup_id'];

        $sup = $this->getBsSdClass()->getModel($id,new BsSdPatentSup(),$memberId);

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

        $this->getBsSdClass()->deleteSd($ids, new BsSdPatentReq(), $memberId);
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

        $this->getBsSdClass()->deleteSd($ids, new BsSdPatentSup(), $memberId);
        $this->redirect('sup');
    }
}
