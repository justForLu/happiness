<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Admin\FileController;
use App\Repositories\Home\EventRepository as Event;
use Illuminate\Http\Request;

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
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->event->getList($params);
        $list = $result['list'] ?? [];
        $count = $result['count'] ?? 0;
        //处理图片
        if($list){
            foreach ($list as &$v){
                $v['image_path'] = array_values(FileController::getFilePath($v['image']))[0] ?? '';
            }
        }

        return $this->ajaxSuccess($list,'OK');
    }

}
