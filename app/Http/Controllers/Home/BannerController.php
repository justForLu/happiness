<?php
namespace App\Http\Controllers\Home;


use App\Repositories\Home\BannerRepository as Banner;
use Illuminate\Http\Request;

class BannerController extends BaseController
{

    protected $banner;

    public function __construct(Banner $banner)
    {
        parent::__construct();

        $this->banner = $banner;
    }

    /**
     * 日程
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
	public function getBanner(Request $request)
    {
        $params = $request->all();

        $result = $this->banner->getList($params);

        return $this->ajaxSuccess($result,'OK');
    }

}
