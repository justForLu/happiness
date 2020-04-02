<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RememberRequest;
use App\Repositories\Admin\Criteria\RememberCriteria;
use App\Repositories\Admin\RememberRepository as Remember;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class RememberController extends BaseController
{
    /**
     * @var Remember
     */
    protected $remember;

    public function __construct(Remember $remember)
    {
        parent::__construct();

        $this->remember = $remember;
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

        $this->remember->pushCriteria(new RememberCriteria($params));

        $list = $this->remember->paginate(Config::get('admin.page_size',10));

        return view('admin.remember.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.remember.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RememberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RememberRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'day' => $params['url'] ?? '',
            'username' => $params['username'] ?? 0,
            'create_time' => time()
        ];

        $result = $this->remember->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/remember'));
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
        $data = $this->remember->find($id);

        return view('admin.remember.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RememberRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RememberRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'day' => $params['day'] ?? '',
            'username' => $params['username'] ?? 0,
            'update_time' => time()
        ];

        $result = $this->remember->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/remember'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->remember->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
