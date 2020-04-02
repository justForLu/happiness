<?php
namespace App\Http\Controllers\Home;

use App\Enums\UserEnum;
use App\Repositories\Home\RememberRepository as Remember;
use Illuminate\Http\Request;

class RememberController extends BaseController
{

    protected $remember;

    public function __construct(Remember $remember)
    {
        parent::__construct();

        $this->remember = $remember;

    }

    /**
     * 纪念日列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
	public function getRemember(Request $request)
    {
        $list = $this->remember->getList();
        //处理数据
        if($list){
            foreach ($list as &$v){
                $v['username'] = UserEnum::getDesc($v['username']);
                $v['create_time'] = date('Y-m-d H:i:s', $v['create_time']);
            }
        }

        return $this->ajaxSuccess($list,'OK');
    }

    /**
     * 添加纪念日
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRemember(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写纪念日标题');
        }
        if(!isset($params['day']) || empty($params['day'])){
            return $this->ajaxError('请填写日期');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'day' => $params['day'],
            'create_time' => time()
        ];

        $result = $this->remember->create($data);

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
    public function editRemember(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写纪念日标题');
        }
        if(!isset($params['day']) || empty($params['day'])){
            return $this->ajaxError('请填写日期');
        }
        if(!isset($params['id']) || empty($params['id'])){
            return $this->ajaxError('缺少纪念日ID');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'day' => $params['day'],
            'update_time' => time()
        ];

        $result = $this->remember->update($data, $params['id']);

        if($result){
            return $this->ajaxSuccess('','编辑成功');
        }
        return $this->ajaxError('编辑失败');
    }

    /**
     * 新闻详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->remember->find($id);
        $user = UserEnum::enumArr();

        $data->user_name = isset($user[$data->username]) ? $user[$data->username] : '';

        return $this->ajaxSuccess($data,'OK');
    }
}
