<?php
namespace common\services;

use Yii;
use common\models\Channel;
use common\models\Category;
use common\models\Article;
use common\models\Tag;
use common\models\Special;
use common\models\SpecialArticle;
use common\cache\CChannel;


class SUrl
{
    /**
     * 获得渠道的url
     * @param unknown $channel_id
     * @return string
     */
    public static function getChannelUrl($channel_id){
        $chinnal=CChannel::getChannelInfo($channel_id);
        $url=isset($chinnal['domain'])?$chinnal['domain'].'/':"";
        return $url;
    }
    /**
     * 获取分类的链接地址
     * @param unknown $category_id
     * @return string
     */
    public static function getCategoryUrl($category_id){
        if($url = self::specialCategoryUrl($category_id)){
            return $url;
        }
        $cateinfo=Category::getCatePTree($category_id);
        $cate=Category::findOne($category_id);
        $prefix=self::getChannelUrl($cate['channel_id']);
        $ext="";
        if(count($cateinfo)>0){
           
            foreach ($cateinfo as $v){
                $ext.=empty($ext)?$v:"-".$v;
            }
        }
        if(!empty($ext)){
            $url=$prefix."list-".$ext."/";
        }else{
            $url=$prefix."";
        }
        return $url;
    }
    
    /**
     * 特殊的直接跳转到频道的url
     * @param unknown $category_id
     * @return string
     */
    public static function specialCategoryUrl($category_id){
        $special = [CATEGORY_JUMP_NEWS , CATEGORY_JUMP_ANLI];//分别跳转到资讯和案例频道
        if(in_array($category_id,$special)){
            switch($category_id){
                case CATEGORY_JUMP_NEWS: return self::getChannelUrl(NEWS_CHANNEL);
                case CATEGORY_JUMP_ANLI: return self::getChannelUrl(ANLI_CHANNEL);
                default : return false;
            }
        }else{
            return false;
        }
    }
    
    /**
     * 获取文章的链接地址
     * @param unknown $article_id
     * @param Boolean $is_view false 不预览的链接|true 进行预览的链接
     * @return string
     */
    public static function getArticleUrl($article_id ,$is_view = false){
        if($is_view){
            self::setArticleView($is_view);
        }
        $article=Article::findOne($article_id);
        $cate=Category::findOne($article['category_id']);
        $prefix=self::getChannelUrl($cate['channel_id']);
        $url=$prefix.$article_id.".html";
        if($is_view){
            $encode = self::articleUrlEncode();
            $url = $url."?signt={$encode['signt']}&sign={$encode['sign']}";
        }
        return $url;
    }
    //是否可以预览标识
    public static $isArticleView = false;
    public static function setArticleView($isView){
        self::$isArticleView = !(!$isView);
    }
    /**
     * 当前页面是否是预览页面
     * @return Boolean
     */ 
    public static function isArticleView(){
        return self::$isArticleView || self::articleUrlCheck(Yii::$app->request->get('sign'),Yii::$app->request->get('signt'));
    }
    /**
     * 预览文章的链接加密
     * @param unknown $time加密时间
     * @return string
     */
    public static function articleUrlEncode($time = false){
        $time = $time?$time:time();
        return ['signt'=>$time,'sign'=>md5(ARTICLEURLENCODE .$time)];
    }
    /**
     * 预览文章的链接校验
     * @param unknown $sign 校验码
     * @param unknown $signt加密时间，校验因子
     * @return string
     */
    public static function articleUrlCheck($sign ,$signt){
        return ($sign === self::articleUrlEncode($signt)['sign'])?true : false;
    }
    
    /**
     * 专题页面链接
     * @param unknown $special_id
     * @return string
     */
    public static function getSpecialUrl($special_id){
        $special = Special::findOne($special_id);
        $url = self::getChannelUrl( JINGPIN_CHANNEL ).$special['alias'].'/';
        return $url;
    }
    /**
     * 专题内容页面链接
     * @param unknown $special_id
     * @return string
     */
    public static function getSpecialContentUrl($special_id){
        $special = Special::findOne($special_id);
        $url = self::getChannelUrl( JINGPIN_CHANNEL ).'browse/'.$special['id'];
        return $url;
    }
    /** 
     * 标签链接
     * @param unknown $tag_id
     * @return string
     */
    public static function getTagUrl($tag_id=0){
        if($tag_id >0){
            $tag = Tag::findOne($tag_id);
            $url = HOME_DOMAIN.'/tag/'.$tag['alias'].'/';
        }else{
            $url = HOME_DOMAIN.'/tag/';
        }
        return $url;
    }
    

}

?>