<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\ModuleEnum;
use App\Models\Admin\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class FileController extends BaseController
{


    /*图片上传*/
    public function uploadPic(Request $request){
        $file = $request->file('photo');
        $rootPath = Config::get('admin.uploadImg','');
        $savePath = date('Y-m-d');
        $saveName = date('YmdHis').rand(1000,9999);

        $data = array(
            'path' => $rootPath.'/'.$savePath.'/'.$saveName.'.'.$file->getClientOriginalExtension(),
            'original_name' => $file->getClientOriginalName(),
            'type' => ModuleEnum::ADMIN
        );

        $a = $file->move(public_path().$rootPath.'/'.$savePath,$saveName.'.'.$file->getClientOriginalExtension());
        $b = File::create($data);

        $result['id'] = $b->id;
        $result['path'] = $data['path'];
        return $this->ajaxSuccess($result,'上传成功');

    }

    /*获得图片路径*/
    static function getFilePath($pics){
        $pics = explode(',',$pics);
        $data = array();
        foreach($pics as $picId){
            if(!empty($picId))
                $data[$picId] = File::where('id',$picId)->value('path');
        }
        return $data;
    }


    /**
     * 获取图片
     * @param Request $request
     * @return string
     */
    public function getImg(Request $request){
        $result = make_thumb_images($request->id,$request->w,$request->h);

        return redirect('http://'.$_SERVER['HTTP_HOST'].$result);
    }

    /*  上传文件  */
    public function uploadFile(Request $request){
        $filename = $_FILES['file']['name'];
        if ($filename) {
            //重命名文件
            $file = explode('.',$filename);
            $filename = date('YmdHis',time()) . mt_rand(100000, 999999) . '.' . $file[count($file) - 1];
            //新建文件夹（如果文件夹不存在）
            $folder = "upload/admin/videos/" . date('Y-m-d',time());
            if (!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/admin/videos/" . date('Y-m-d',time()) . "/" . $filename);

            $path = "/upload/admin/videos/" . date('Y-m-d',time()) . "/"  . $filename;
            return response()->json($path);
        }

    }
}
