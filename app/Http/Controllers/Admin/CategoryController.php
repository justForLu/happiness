<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Admin\Criteria\CategoryCriteria;
use App\Repositories\Admin\CategoryRepository as Category;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->category = $category;
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

        $this->category->pushCriteria(new CategoryCriteria($params));

        $list = $this->category->paginate(Config::get('admin.page_size',10));

        //父级分类
//        if($list){
//            foreach ($list as &$v){
//
//            }
//        }
        return view('admin.category.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->all();

        $data = [
            'type' => $params['type'] ?? 0,
            'pid' => $params['pid'] ?? 0,
            'name' => $params['name'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'create_time' => time()
        ];

        $result = $this->category->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/category'));
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
        $data = $this->category->find($id);

        return view('admin.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'type' => $params['type'] ?? 0,
            'pid' => $params['pid'] ?? 0,
            'name' => $params['name'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'update_time' => time()
        ];

        $result = $this->category->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->category->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

    /**
     * 获取分类list
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategory($type)
    {
        $data = $this->category->getCategoryList($type);

        return $this->ajaxSuccess($data,'OK');
    }
}
