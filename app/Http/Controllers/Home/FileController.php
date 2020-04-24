<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileController extends BaseController
{

    /**
     * 上传图片
     * @param Request $request
     * @return bool|string
     */
    public function uploadImg(Request $request)
    {
        $filename = $_FILES['image']['name'];
        if ($filename) {
            //文件类型的点最后一次出现的位置
            $file_index = mb_strrpos($filename, '.');
            //验证是不是图片
            $is_img = getimagesize($_FILES["image"]["tmp_name"]);
            if(!$is_img){
                exit('不是图片');    //根据自己需要返回
            }

            //验证类型
            $image_type = ['image/png','image/jpg','image/jpeg'];

            if(!in_array($_FILES['image']['type'], $image_type)){
                exit('文件类型只能为png、JPG格式图片');    //根据自己需要返回数据
            }
            //验证后缀
            $postfix = ['.png','.jpg','.jpeg'];
            $file_postfix = strtolower(mb_substr($filename, $file_index));

            if(!in_array($file_postfix, $postfix)){
                exit('文件后缀只能是png，jpg，jpeg');    //根据自己需要返回数据
            }

            //文件大小限制200KB
            if($_FILES['image']['size'] > 10485760){
                exit('图片过大');    //根据自己需要返回数据
            }
            //重命名文件。
            $filename = date('YmdHis',time()) . mt_rand(100000, 999999). $file_postfix;
            //新建文件夹（如果文件夹不存在）
            $folder = base_path()."/public/upload/image/" . date('Y-m-d',time());
            if (!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            //移动文件
            $result = move_uploaded_file($_FILES["image"]["tmp_name"],
                base_path()."/public/upload/image/" . date('Y-m-d',time()) . "/" . $filename);
            if($result){
                $path = env('APP_HTTP').env('APP_URL')."/upload/image/" . date('Y-m-d',time()) . "/"  . $filename;    //路径

                return $this->ajaxSuccess(['path' => $path],'OK');
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    /**
     * 上传文件
     * @param Request $request
     */
    public function uploadFile(Request $request)
    {

    }


}