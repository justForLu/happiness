<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\ExampleRequest;
use App\Repositories\Admin\Criteria\ExampleCriteria;
use App\Repositories\Admin\ExampleRepository as Example;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class ExampleController extends BaseController
{

    /**
     * @var Example
     */
    protected $example;

    public function __construct(Example $example)
    {
        parent::__construct();

        $this->example = $example;
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

        $this->example->pushCriteria(new ExampleCriteria($params));

        $list = $this->example->paginate(Config::get('admin.page_size',10));

        return view('admin.example.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.example.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExampleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ExampleRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'desc' => $params['desc'] ?? '',
            'image' => $params['image'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'create_time' => time()
        ];

        $result = $this->example->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/example'));
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
        $data = $this->example->find($id);
        $data->info = htmlspecialchars_decode($data->info);
        //处理图片
        $data->image_path = array_values(FileController::getFilePath($data->image));

        return view('admin.example.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExampleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ExampleRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'desc' => $params['desc'] ?? '',
            'image' => $params['image'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'update_time' => time()
        ];

        $result = $this->example->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/example'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->example->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
