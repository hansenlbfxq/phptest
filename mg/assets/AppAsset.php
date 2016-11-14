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
    public $baseUrl = '@web';
    public $css = [
//        'assets/mg/bower_components/bootstrap/dist/css/bootstrap.min.css',
//        'assets/mg/bower_components/metisMenu/dist/metisMenu.min.css',
//        'assets/mg/dist/css/timeline.css',
//        'assets/mg/dist/css/sb-admin-2.css',
//        'assets/mg/bower_components/font-awesome/css/font-awesome.min.css',

    ];
    public $js = [
//        'assets/mg/bower_components/bootstrap/dist/js/bootstrap.min.js',
//        'assets/mg/bower_components/metisMenu/dist/metisMenu.min.js',
        'assets/cms/jquery.js',
        'assets/cms/jquery.form.js',
        'assets/cms/jquery.cookie.js',
    ];
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [self::className(), 'depends' => self::className()]);
    }
    public static function addCss($view, $jsfile) {
        $view->registerCssFile($jsfile,['depends'=>[self::className()],'position'=>$view::POS_HEAD]);

    }
}
