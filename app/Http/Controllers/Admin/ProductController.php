<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\CategoryEnum;
use App\Http\Requests\Admin\ProductRequest;
use App\Repositories\Admin\Criteria\ProductCriteria;
use App\Repositories\Admin\ProductRepository as Product;
use App\Repositories\Admin\CategoryRepository as Category;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    /**
     * @var Product
     */
    protected $product;
    protected $category;

    public function __construct(Product $product,Category $category)
    {
        parent::__construct();

        $this->product = $product;
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

        $this->product->pushCriteria(new ProductCriteria($params));

        $list = $this->product->paginate(Config::get('admin.page_size',10));
        if ($list){
        $category_ids = [];
        foreach ($list as $v){
            $category_ids[] = $v['category_id'];
        }
        $category = $this->category->getCategoryById($category_ids);
        $category_list = set_index_array($category,'id');
        foreach ($list as &$v){
            $v->category_name = $category_list[$v['category_id']]['name'] ?? '';
        }
    }

        return view('admin.product.index',compact('params','list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = $this->category->getCategoryList(CategoryEnum::PRODUCT);

        return view('admin.product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'category_id' => $params['category_id'] ?? 0,
            'image' => $params['image'] ?? 0,
            'display' => $params['display'] ?? 0,
            'desc' => $params['desc'] ?? '',
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'create_time' => time()
        ];

        $result = $this->product->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/product'));
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
        $data = $this->product->find($id);
        $category = $this->category->getCategoryList(CategoryEnum::PRODUCT);
        $data->info = htmlspecialchars_decode($data->info);
        //处理图片
        $data->image_path = array_values(FileController::getFilePath($data->image));
        $data->display = FileController::getFilePath($data->display);

        return view('admin.product.edit',compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'category_id' => $params['category_id'] ?? 0,
            'image' => $params['image'] ?? 0,
            'display' => $params['display'] ?? 0,
            'desc' => $params['desc'] ?? '',
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'update_time' => time()
        ];

        $result = $this->product->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->product->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
