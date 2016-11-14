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
 * Date: 16-11-7
 * Time: 11:14
 */

namespace app\services;

use app\models\BsBdata;

class BdataServices
{
    /**
     * get industry type id
     */
    const INDUSTRY_BTYPE_ID = 1;

    /**
     * get incubator type id
     */
    const CARRIER_BTYPE_ID = 2;

    /**
     * get area type id
     */
    const AREA_BTYPE_ID = 3;

    /**
     * get capital type id
     */
    const CAPITAL_BTYPE_ID = 4;

    /**
     * get price type id
     */
    const PRICE_BTYPE_ID = 5;

    /**
     * get bdata status value
     */
    const BDATA_STATUS_ID = 1;

    /**
     * get all data by type
     * @return \yii\db\ActiveQuery
     */
    public function getDataByType($type)
    {
        $data = BsBdata::find()
            ->where(array('btype' => $type, 'status' => self::BDATA_STATUS_ID))
            ->orderBy('rank DESC')
            ->all();
        return $data;
    }

}