<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\LinkRequest;
use App\Repositories\Admin\Criteria\LinkCriteria;
use App\Repositories\Admin\LinkRepository as Link;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @var Link
     */
    protected $link;

    public function __construct(Link $link)
    {
        parent::__construct();

        $this->link = $link;
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

        $this->link->pushCriteria(new LinkCriteria($params));

        $list = $this->link->paginate(Config::get('admin.page_size',10));

        return view('admin.link.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LinkRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'url' => $params['url'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'create_time' => time()
        ];

        $result = $this->link->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/link'));
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
        $data = $this->link->find($id);

        return view('admin.link.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinkRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(LinkRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'url' => $params['url'] ?? '',
            'sort' => $params['sort'] ?? 0,
            'status' => $params['status'] ?? BasicEnum::ACTIVE,
            'update_time' => time()
        ];

        $result = $this->link->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/link'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->link->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
