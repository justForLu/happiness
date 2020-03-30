<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\NotebookEnum;
use App\Http\Requests\Admin\NotebookRequest;
use App\Repositories\Admin\Criteria\NotebookCriteria;
use App\Repositories\Admin\NotebookRepository as Notebook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class NotebookController extends BaseController
{
    /**
     * @var Notebook
     */
    protected $notebook;

    public function __construct(Notebook $notebook)
    {
        parent::__construct();

        $this->notebook = $notebook;
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

        $this->notebook->pushCriteria(new NotebookCriteria($params));

        $list = $this->notebook->paginate(Config::get('admin.page_size',10));

        return view('admin.notebook.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.notebook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotebookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NotebookRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'content' => $params['content'] ?? '',
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? NotebookEnum::BORN,
            'create_time' => time()
        ];

        $result = $this->notebook->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/notebook'));
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
        $data = $this->notebook->find($id);

        return view('admin.notebook.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotebookRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NotebookRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'content' => $params['content'] ?? '',
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? NotebookEnum::BORN,
            'update_time' => time()
        ];

        $result = $this->notebook->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/notebook'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->notebook->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
