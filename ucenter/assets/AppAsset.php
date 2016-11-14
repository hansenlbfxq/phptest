<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;
use yii\web\AssetBundle;
use yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $css = [
    ];
    public $js = [
    ];
    
    public static  function  addJs($view, $jsfile,$position) {  
       $view->registerJsFile(Yii::$app->params['asserts_url'].'/'.$jsfile, [self::className(), 'depends' => self::className()]);  

    }
    public static  function addCss($view, $cssfile) {
        $view->registerCssFile(Yii::$app->params['asserts_url'].'/'.$cssfile,['depends'=>[self::className()],'position'=>$view::POS_HEAD]);   
    }
}
