<?php
namespace app\controllers;

use app\models\BsSdCapitalReq;
use app\models\BsSdCapitalSup;
use app\services\BsSdServices;
use Yii;
use Yii\filters\AccessControl;
use app\exts\QrckController;
use app\services\BdataServices;



class SdcapitalController extends QrckController
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

        $capitalReq = BsSdCapitalReq::find()
            ->select(array('id', 'company', 'capital_req', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('reqindex', array(
            'capitalreq'=>  $capitalReq,
        ));
    }

    /**
     * render supindex
     * @return string
     */
    public function actionSup()
    {
        $memberId = $this->getMemberId();

        $capitalSup = BsSdCapitalSup::find()
            ->select(array('id', 'supply', 'product', 'loan_total', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('supindex', array(
            'capitalsup'    =>  $capitalSup
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

        $capitalReq = $this->getBsSdClass()->getModel($id,new BsSdCapitalReq(),$memberId);

        $bdata = new BdataServices();
        $capital = $bdata->getDataByType($bdata::CAPITAL_BTYPE_ID);

        return $this->render('reqedit', array(
            'capitalreq'    =>  $capitalReq,
            'capital'   =>  $capital,
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

        $capitalSup = $this->getBsSdClass()->getModel($id,new BsSdCapitalSup(),$memberId);

        return $this->render('supedit', array(
            'capitalsup'    =>  $capitalSup,
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
        $paramData = $params['BsSdCapitalReq'];
        $id = $params['req_id'];
        $req = $this->getBsSdClass()->getModel($id,new BsSdCapitalReq(),$memberId);
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
        $paramData = $params['BsSdCapitalSup'];
        $id = $params['sup_id'];

        $sup = $this->getBsSdClass()->getModel($id,new BsSdCapitalSup(),$memberId);

        // get id is not null
        $id = $sup->id;
        $paramData['lan'] = BsSdServices::LANGUAGE_CHINESE_VALUE;
        $paramData = $this->getBsSdClass()->getData($id, $memberId, $paramData);

        try {
            $sup->setAttributes($paramData,false);
            $sup->save();
        } catch(Exception $e) {
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

        $this->getBsSdClass()->deleteSd($ids, new BsSdCapitalReq(), $memberId);
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

        $this->getBsSdClass()->deleteSd($ids, new BsSdCapitalSup(), $memberId);
        $this->redirect('sup');
    }

}
