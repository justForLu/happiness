<?php
namespace App\Http\Controllers\Home;


use App\Enums\EventEnum;
use App\Enums\UserEnum;
use App\Repositories\Home\EventRepository as Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends BaseController
{

    protected $event;

    public function __construct(Event $event)
    {
        parent::__construct();

        $this->event = $event;
    }

    /**
     * 日程
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->event->getList($params);
        $list = $result['list'] ?? [];
        //处理数据
        if($list){
            foreach ($list as &$v){
                $v['username'] = UserEnum::getDesc($v['username']);
                $v['status'] = EventEnum::getDesc($v['status']);
                $v['create_time'] = date('Y-m-d H:i:s', $v['create_time']);
            }
        }

        return $this->ajaxSuccess(['list' => $list,'page' => $result['page'], 'total_page' => $result['total_page'], 'count' => $result['count']],'OK');
    }

    /**
     * 添加日程
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addEvent(Request $request)
    {
	    $params = $request->all();

	    if(!isset($params['title']) || empty($params['title'])){
	        return $this->ajaxError('请填写日程标题');
        }
	    if(!isset($params['content']) || empty($params['content'])){
	        return $this->ajaxError('请填写日程内容');
        }
	    
	    $data = [
	        'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? 0,
            'content' => $params['content'],
            'create_time' => time()
        ];
	    
	    $result = $this->event->create($data);

	    if($result){
	        return $this->ajaxSuccess('','添加成功');
        }
	    return $this->ajaxError('添加失败');
    }

    /**
     * 编辑日程
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editEvent(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写日程标题');
        }
        if(!isset($params['content']) || empty($params['content'])){
            return $this->ajaxError('请填写日程内容');
        }
        if(!isset($params['id']) || empty($params['id'])){
            return $this->ajaxError('缺少日程ID');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? 0,
            'content' => $params['content'],
            'update_time' => time()
        ];

        $result = $this->event->update($data, $params['id']);

        if($result){
            return $this->ajaxSuccess('','编辑成功');
        }
        return $this->ajaxError('编辑失败');
    }

    /**
     * 日程详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->event->find($id);
        $status = EventEnum::enumArr();
        $user = UserEnum::enumArr();

        $data->user_name = isset($user[$data->username]) ? $user[$data->username] : '';
        $data->status_name = isset($status[$data->status]) ? $status[$data->status] : '';

        return $this->ajaxSuccess($data,'ok');
    }
}
