<?php
namespace App\Http\Controllers\Home;

use App\Enums\HappyEnum;
use App\Enums\UserEnum;
use App\Models\Common\User;
use App\Repositories\Home\HappyRepository as Happy;
use Illuminate\Http\Request;

class HappyController extends BaseController
{
    protected $happy;

    public function __construct(Happy $happy)
    {
        parent::__construct();

        $this->happy = $happy;
    }

    /**
     * 生活点滴列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->happy->getList($params);
        $list = $result['list'] ?? [];
        //处理数据
        if($list){
            //处理添加人
            $user_ids = array_unique(array_column($list,'user_id'));
            $user_arr = User::whereIn('id',$user_ids)->pluck('nickname','id');

            foreach ($list as &$v){
                $v['username'] = $v['user_id'] > 0 && isset($user_arr[$v['user_id']]) ? $user_arr[$v['user_id']] : '未知';
                $v['category'] = HappyEnum::getDesc($v['category']);
                $v['create_time'] = date('Y-m-d H:i:s', $v['create_time']);
            }
        }

        return $this->ajaxSuccess(['list' => $list,'page' => $result['page'], 'total_page' => $result['total_page'], 'count' => $result['count']],'OK');
    }

    /**
     * 添加生活点滴
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addHappy(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写生活点滴标题');
        }
        if(!isset($params['content']) || empty($params['content'])){
            return $this->ajaxError('请填写生活点滴内容');
        }

        $data = [
            'user_id' => $params['user_id'] ?? 0,
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'category' => $params['category'] ?? 0,
            'content' => $params['content'],
            'create_time' => time()
        ];

        $result = $this->happy->create($data);

        if($result){
            return $this->ajaxSuccess('','添加成功');
        }
        return $this->ajaxError('添加失败');
    }

    /**
     * 编辑生活点滴
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editHappy(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写生活点滴标题');
        }
        if(!isset($params['content']) || empty($params['content'])){
            return $this->ajaxError('请填写生活点滴内容');
        }
        if(!isset($params['id']) || empty($params['id'])){
            return $this->ajaxError('缺少日程ID');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'category' => $params['category'] ?? 0,
            'content' => $params['content'],
            'update_time' => time()
        ];

        $result = $this->happy->update($data, $params['id']);

        if($result){
            return $this->ajaxSuccess('','编辑成功');
        }
        return $this->ajaxError('编辑失败');
    }


    /**
     * 生活点滴详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->happy->with(array('user'))->find($id);

        $data->user_name = $data->user->nickName;
        $data = $this->happy->with(array('user'))->find($id);
        $status = HappyEnum::enumArr();

        $data->user_name = $data->user->nickName;
        $data->category_name = isset($status[$data->category]) ? $status[$data->category] : '';
        $data->content = htmlspecialchars_decode($data->content ?? '');

        return $this->ajaxSuccess($data,'OK');
    }

    /**
     * 删除生活点滴
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delHappy(Request $request)
    {
        $params = $request->all();

        $result = $this->happy->delHappy($params);

        if($result){
            return $this->ajaxSuccess('','删除成功');
        }

        return $this->ajaxError('删除失败');
    }

}
