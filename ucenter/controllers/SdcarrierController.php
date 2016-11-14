<?php
namespace app\controllers;

use app\models\BsMemberIncubator;
use app\models\BsSdCarrierReq;
use app\models\BsSdCarrierSup;
use app\services\BsSdServices;
use Yii;
use Yii\filters\AccessControl;
use app\exts\QrckController;
use app\services\BdataServices;

class SdcarrierController extends QrckController
{
    /**
     * get member id
     * @return int
     */
    public function getMemberId()
    {
        $memberId = 124;
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

        $carrierReq = BsSdCarrierReq::find()
            ->select(array('id', 'company', 'area_reqs', 'price', 'link_name', 'link_tel', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('reqindex', array(
            'carrierreq'=>  $carrierReq,
        ));
    }

    /**
     * render supindex
     * @return string
     */
    public function actionSup()
    {
        $memberId = $this->getMemberId();

        $carrierSup = BsSdCarrierSup::find()
            ->select(array('id', 'incubator_id', 'carrier_area', 'rent_area', 'rental', 'property', 'link_name', 'link_tel', 'carrier_type_id', 'status', 'created'))
            ->where(array('owner' => $memberId, 'status' => array(BsSdServices::SD_STATUS_PENDING, BsSdServices::SD_STATUS_CONSENT)))
            ->all();

        return $this->render('supindex', array(
            'carriersup'    =>  $carrierSup
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

        $carrierReq = $this->getBsSdClass()->getModel($id,new BsSdCarrierReq(),$memberId);

        $bdata = new BdataServices();
        $area = $bdata->getDataByType($bdata::AREA_BTYPE_ID);
        $price = $bdata->getDataByType($bdata::PRICE_BTYPE_ID);
        $carrier = $bdata->getDataByType($bdata::CARRIER_BTYPE_ID);

        return $this->render('reqedit', array(
            'carrierreq'    =>  $carrierReq,
            'area'   =>  $area,
            'price'   =>  $price,
            'carrier'   =>  $carrier,
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

        $carrierSup = $this->getBsSdClass()->getModel($id,new BsSdCarrierSup(),$memberId);

        $bdata = new BdataServices();
        $carrier = $bdata->getDataByType($bdata::CARRIER_BTYPE_ID);

        return $this->render('supedit', array(
            'carriersup'    =>  $carrierSup,
            'carrier'   =>  $carrier,
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
        $paramData = $params['BsSdCarrierReq'];
        $id = $params['req_id'];

        $req = $this->getBsSdClass()->getModel($id,new BsSdCarrierReq(),$memberId);
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
        $paramData = $params['BsSdCarrierSup'];
        $id = $params['sup_id'];

        $sup = $this->getBsSdClass()->getModel($id,new BsSdCarrierSup(),$memberId);

        // get id is not null
        $id = $sup->id;
        $paramData['lan'] = BsSdServices::LANGUAGE_CHINESE_VALUE;
        // get incubator_id by member id
        $paramData['incubator_id'] = BsMemberIncubator::find()
            ->select('id')
            ->where(array('member_id' => $memberId))
            ->one()->id;

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

        $this->getBsSdClass()->deleteSd($ids, new BsSdCarrierReq(), $memberId);
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

        $this->getBsSdClass()->deleteSd($ids, new BsSdCarrierSup(), $memberId);
        $this->redirect('sup');
    }
}
