<?php
/**
 * Copyright (c) 2016, SILK Software
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the SILK Software.
 * 4. Neither the name of the SILK Software nor the
 *   names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY SILK Software ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL SILK Software BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * Created by PhpStorm.
 * User: Bob song <bob.song@silksoftware.com>
 * Date: 16-11-9
 * Time: 15:57
 */

namespace app\services;

use app\models\BsBdata;
use app\models\BsMemberIncubator;
use Yii;


class BsSdServices
{
    /**
     * 待审 status value
     */
    const SD_STATUS_PENDING = 1;

    /**
     * 已审 status value
     */
    const SD_STATUS_CONSENT = 1;

    /**
     * 删除 status value
     */
    const SD_STATUS_DELETE = 1;

    /**
     * Chinese language value
     */
    const LANGUAGE_CHINESE_VALUE = 1;

    /**
     * English language value
     */
    const LANGUAGE_ENGLISH_VALUE = 2;

    /**
     * Korean language value
     */
    const LANGUAGE_KOREAN_VALUE = 3;

    /**
     * owner type admin
     */
    const OWNER_TYPE_ADMIN = 1;

    /**
     * owner type member
     */
    const OWNER_TYPE_MEMBER = 2;

    /**
     * get Sd status to Chinese
     * @param $status
     * @return string
     */
    public function getSdStatus($status)
    {
        switch ($status) {
            case self::SD_STATUS_PENDING:
                return '待审';
            break;
            case self::SD_STATUS_CONSENT:
                return '已审';
            break;
            case self::SD_STATUS_DELETE:
                return '删除';
            break;
            default:
                return '待审';
        }
    }

    /**
     * get incubator name by id
     * @param $id
     * @return mixed
     */
    public function getIncubatorById($id)
    {
        $incubator = BsMemberIncubator::find()->select('name')->where(array('id' => $id))->one();
        return $incubator->name;
    }

    /**
     * get incubator type name by id
     * @param $id
     * @return mixed
     */
    public function getIncubatorTypeById($id)
    {
        $incubatorType = BsBdata::find()->select('name')->where(array('id' => $id, 'btype' => BdataServices::CARRIER_BTYPE_ID,'status' => BdataServices::BDATA_STATUS_ID))->one();
        return $incubatorType->name;
    }

    /**
     * get Sd edit url
     * @param $context
     * @param $id
     * @return mixed
     */
    public function getEditUrl($context, $method, $id)
    {
        return Yii::$app->urlManager->createUrl(array($context . '/edit'.$method,'id'=> $id));
    }

    /**
     * public function delete sd item
     * @param $ids
     * @param $model
     * @param $memberId
     */
    public function deleteSd($ids, $model, $memberId)
    {
        foreach ($ids as $id) {
            $req = $model::find()->where(array('id' => $id, 'owner' => $memberId))->one();
            if ($req) {
                $req->delete();
            }
        }
    }

    /**
     * public function get model by id and member
     * @param $id
     * @param $model
     * @param $memberId
     * @return mixed
     */
    public function getModel($id, $model, $memberId)
    {
        if (!empty($id)) {
            return $model::find()->where(array('id' => $id, 'owner' => $memberId))->one();
        } else {
            return $model;
        }
    }

    /**
     * public function add owner, owner_type, status, created for data param
     * @param $id
     * @param $memberId
     * @param array $paramData
     * @return array
     */
    public function getData($id, $memberId, array $paramData)
    {
        if (empty($id)) {
            $paramData['created'] = date('Y-m-d h:i:s',time());
        }
        $paramData['owner'] = $memberId;
        $paramData['owner_type'] = self::OWNER_TYPE_MEMBER;
        $paramData['status'] = self::SD_STATUS_PENDING;
        return $paramData;
    }
}