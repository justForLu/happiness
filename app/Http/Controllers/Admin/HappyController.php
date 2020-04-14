<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\CategoryEnum;
use App\Enums\HappyEnum;
use App\Http\Requests\Admin\HappyRequest;
use App\Repositories\Admin\Criteria\HappyCriteria;
use App\Repositories\Admin\HappyRepository as Happy;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class HappyController extends BaseController
{

    /**
     * @var Happy
     */
    protected $happy;

    public function __construct(Happy $happy)
    {
        parent::__construct();

        $this->happy = $happy;
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

        $this->happy->pushCriteria(new HappyCriteria($params));

        $list = $this->happy->paginate(Config::get('admin.page_size',10));

        return view('admin.happy.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.happy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HappyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HappyRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'username' => $params['username'] ?? 0,
            'category' => $params['category'] ?? HappyEnum::TRAVEL,
            'content' => $params['content'] ? htmlspecialchars_decode($params['content']) : '',
            'create_time' => time()
        ];

        $result = $this->happy->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/happy'));
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
        $data = $this->happy->find($id);
        $data->content = htmlspecialchars_decode($data->content);

        return view('admin.happy.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HappyRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HappyRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'username' => $params['username'] ?? 0,
            'category' => $params['category'] ?? HappyEnum::TRAVEL,
            'content' => $params['content'] ? htmlspecialchars_decode($params['content']) : '',
            'update_time' => time()
        ];

        $result = $this->happy->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/happy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->happy->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
