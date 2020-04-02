<?php

namespace App\Repositories\Home;


use App\Enums\BannerEnum;
use App\Enums\BasicEnum;
use App\Http\Controllers\Admin\FileController;
use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Banner';
    }

    /**
     * 获取案例列表
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $url = env('APP_HTTP').env('APP_URL');
        //幻灯片的图片
        $banner = $this->model->select('image')->where('status',BasicEnum::ACTIVE)
            ->where('category',BannerEnum::BANNER)
            ->orderBy('sort','ASC')
            ->get()->toArray();

        if($banner){
            $image = array_unique(array_column($banner,'image'));
            $image = implode(',',$image);
            $img_arr = FileController::getFilePath($image);
            foreach ($banner as $k => $v){
                if($k == 0){
                    $banner[$k]['selected'] = true;
                }else{
                    $banner[$k]['selected'] = false;
                }
                $banner[$k]['image_path'] = $img_arr[(int)$v['image']] ? $url.$img_arr[(int)$v['image']] : '';
            }
        }

        //前缀图标的图片
        $icon = $this->model->select('image')->where('status',BasicEnum::ACTIVE)
            ->where('category',BannerEnum::ROSE)
            ->orderBy('id','DESC')
            ->limit(1)
            ->get()->toArray();
        $icon = isset($icon[0]) ? $icon[0] : [];

        $icon['image_path'] = array_values(FileController::getFilePath($icon['image']))[0] ?? '';
        $icon['image_path'] = $icon['image_path'] ? $url.$icon['image_path'] : '';

        return ['banner' => $banner, 'icon' => $icon];
    }

}
