<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EventEnum;
use App\Enums\UserEnum;
use App\Http\Requests\Admin\EventRequest;
use App\Repositories\Admin\Criteria\EventCriteria;
use App\Repositories\Admin\EventRepository as Event;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class EventController extends BaseController
{

    /**
     * @var Event
     */
    protected $event;

    public function __construct(Event $event)
    {
        parent::__construct();

        $this->event = $event;
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

        $this->event->pushCriteria(new EventCriteria($params));

        $list = $this->event->paginate(Config::get('admin.page_size',10));

        //处理数据
        if($list){
            foreach ($list as $k => $v){
                $v->username = UserEnum::getDesc($v->username);
            }
        }

        return view('admin.event.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        $params = $request->all();

        $data = [
            'title' => $params['title'] ?? '',
            'content' => $params['content'] ?? '',
            'username' => $params['username'] ?? '',
            'status' => $params['status'] ?? EventEnum::BORN,
            'create_time' => time()
        ];

        $result = $this->event->create($data);

        return $this->ajaxAuto($result,'添加',url('admin/event'));
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
        $data = $this->event->find($id);

        return view('admin.event.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, $id)
    {
        $params = $request->filterAll();

        $data = [
            'title' => $params['title'] ?? '',
            'content' => $params['content'] ?? '',
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? EventEnum::BORN,
            'update_time' => time()
        ];

        $result = $this->event->update($data,$id);

        return $this->ajaxAuto($result,'修改',url('admin/event'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->event->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
