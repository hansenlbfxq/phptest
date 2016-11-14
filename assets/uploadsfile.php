<?php


/**
 * 开发工具: PhpStorm.
 * 作   者: mybook-lhp
 * 日   期: 16/11/2
 * 功能说明: 远程文件接收类,只支持单文件上传.
 */
class uploadsfile
{

    private $File = null;
    public $filepath = null;
    public $size = 10000;
    public $type = 'jpg,gif,png';
    private $Post = null;

    public $return;

    /**
     * 初始化
     * uploadsfile constructor.
     */
    public function __construct()
    {
        if (!empty($_FILES) && count($_FILES) !== 0) {

            $this->File = $_FILES[array_keys($_FILES)[0]];;
            $this->Post = json_decode($_POST['data']);
            $this->filepath = str_replace('\\', '/', substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']))) . "/" . $this->Post->path;


            $this->return = $this->Upload(); //返回保存的文件路径及名称
        } else {
            $this->return = 'nothing';
        }


        if (isset($_POST['delete'])) {

            if (file_exists("." . $_POST['delete'])) {
                unlink("." . $_POST['delete']);
                $this->return = "ok";

            } else {
                $this->return = 'delete file is nothing';

            }
        }


    }

    /**
     * 上传方法
     * @return bool|string
     */
    public function Upload()
    {

        $File = $_FILES[array_keys($_FILES)[0]];

        if (!empty($_FILES) && count($_FILES) !== 0) {
            $postdata = fopen($File['tmp_name'], "r");
            $ext = explode('/', $File['type']);
            $extension = end($ext);
            $filename = $this->filepath . uniqid() . "." . $extension;
            $fp = fopen($_SERVER['DOCUMENT_ROOT'] . $filename, "w");
            while ($data = fread($postdata, 1024))
                fwrite($fp, $data);
            fclose($fp);
            fclose($postdata);
            return $filename;
        } else {
            return false;
        }

    }

    public function Delete()
    {

    }


}

$upfile = new uploadsfile();
echo $upfile->return;

