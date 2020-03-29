<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\CategoryEnum;
use App\Http\Requests\Admin\NewsRequest;
use App\Repositories\Admin\Criteria\NewsCriteria;
use App\Repositories\Admin\NewsRepository as News;
use App\Repositories\Admin\CategoryRepository as Category;
use App\Repositories\Admin\ManagerRepository as Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class NewsController extends BaseController
{
    /**
     * @var News
     */
    protected $news;
    protected $category;
    protected $manager;

    public function __construct(News $news, Category $category,Manager $manager)
    {
        parent::__construct();

        $this->news = $news;
        $this->category = $category;
        $this->manager = $manager;
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

        $this->news->pushCriteria(new NewsCriteria($params));

        $list = $this->news->paginate(Config::get('admin.page_size',10));
        if ($list){
            $admin_ids = [];
            $category_ids = [];
            foreach ($list as $v){
                $admin_ids[] = $v['admin_id'];
                $category_ids[] = $v['category_id'];
            }
            $admin_list = $this->manager->getManagerById($admin_ids);
            $admin_list = set_index_array($admin_list,'id');
            $category = $this->category->getCategoryById($category_ids);
            $category_list = set_index_array($category,'id');
            foreach ($list as &$v){
                $v->admin_name = $admin_list[$v['admin_id']]['username'] ?? '';
                $v->category_name = $category_list[$v['category_id']]['name'] ?? '';
            }
        }

        return view('admin.news.index',compact('params','list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = $this->category->getCategoryList(CategoryEnum::NEWS);

        return view('admin.news.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'category_id' => $params['category_id'] ?? 0,
            'desc' => $params['desc'] ?? '',
            'image' => $params['image'] ?? 0,
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'read' => $params['read'] ?? 0,
            'admin_id' => Auth::id(),
            'create_time' => time()
        ];

        $result = $this->news->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/news'));
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
        $data = $this->news->find($id);
        $category = $this->category->getCategoryList(CategoryEnum::NEWS);
        $data->info = htmlspecialchars_decode($data->info);
        //处理图片
        $data->image_path = array_values(FileController::getFilePath($data->image));

        return view('admin.news.edit',compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'category_id' => $params['category_id'] ?? 0,
            'desc' => $params['desc'] ?? '',
            'image' => $params['image'] ?? 0,
            'info' => $params['info'] ? htmlspecialchars_decode($params['info']) : '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'read' => $params['read'] ?? 0,
            'update_time' => time()
        ];

        $result = $this->news->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->news->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
