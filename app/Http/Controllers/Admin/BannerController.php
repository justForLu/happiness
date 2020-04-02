<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BannerEnum;
use App\Enums\BasicEnum;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\Admin\Criteria\BannerCriteria;
use App\Repositories\Admin\BannerRepository as Banner;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class BannerController extends BaseController
{

    /**
     * @var Banner
     */
    protected $banner;

    public function __construct(Banner $banner)
    {
        parent::__construct();

        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $this->banner->pushCriteria(new BannerCriteria($params));

        $list = $this->banner->paginate(Config::get('admin.page_size',10));

        return view('admin.banner.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BannerRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'image' => $params['image'] ?? '',
            'category' => $params['category'] ?? BannerEnum::BANNER,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'sort' => $params['sort'] ?? 0,
            'create_time' => time()
        ];

        $result = $this->banner->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/banner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $data = $this->banner->find($id);
        //处理图片
        $data->image_path = array_values(FileController::getFilePath($data->image));

        return view('admin.banner.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BannerRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'image' => $params['image'] ?? '',
            'category' => $params['category'] ?? BannerEnum::BANNER,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'sort' => $params['sort'] ?? 0,
            'update_time' => time()
        ];

        $result = $this->banner->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/banner'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->banner->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
