<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = ASSETS_DOMAIN;
    public $css = [
        $this->baseUrl."ucenter/css/common.css"
    ];
    public $js = [
    ];
    public function addScript($view, $jsfile) {  
        $view->registerJsFile($this->baseUrl.'/'.$jsfile, [self::className(), 'depends' => self::className()]);  
    }
    public function addCss($view, $jsfile) {
        $view->registerCssFile($this->baseUrl.'/'.$jsfile,['depends'=>[self::className()],'position'=>$view::POS_HEAD]);   
    }
}
