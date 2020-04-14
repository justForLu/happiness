<?php
namespace App\Http\Controllers\Home;

use App\Enums\NotebookEnum;
use App\Enums\UserEnum;
use App\Http\Controllers\Admin\FileController;
use Illuminate\Http\Request;
use App\Repositories\Home\NotebookRepository as Notebook;

class NotebookController extends BaseController
{

    protected $notebook;

    public function __construct(Notebook $notebook)
    {
        parent::__construct();

        $this->notebook = $notebook;
    }

    /**
     * 小本本
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->notebook->getList($params);
        $list = $result['list'] ?? [];
        //处理数据
        if($list){
            foreach ($list as &$v){
                $v['username'] = UserEnum::getDesc($v['username']);
                $v['status'] = NotebookEnum::getDesc($v['status']);
                $v['create_time'] = date('Y-m-d H:i:s', $v['create_time']);
            }
        }

        return $this->ajaxSuccess(['list' => $list,'page' => $result['page'], 'total_page' => $result['total_page'], 'count' => $result['count']],'OK');
    }

    /**
     * 添加小本本
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNotebook(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写小本本标题');
        }
        if(!isset($params['content']) || empty($params['content'])){
            return $this->ajaxError('请填写小本本内容');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? 0,
            'content' => $params['content'],
            'create_time' => time()
        ];

        $result = $this->notebook->create($data);

        if($result){
            return $this->ajaxSuccess('','添加成功');
        }
        return $this->ajaxError('添加失败');
    }

    /**
     * 编辑小本本
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editNotebook(Request $request)
    {
        $params = $request->all();

        if(!isset($params['title']) || empty($params['title'])){
            return $this->ajaxError('请填写小本本标题');
        }
        if(!isset($params['content']) || empty($params['content'])){
            return $this->ajaxError('请填写小本本内容');
        }
        if(!isset($params['id']) || empty($params['id'])){
            return $this->ajaxError('缺少小本本ID');
        }

        $data = [
            'title' => $params['title'],
            'username' => $params['username'] ?? 0,
            'status' => $params['status'] ?? 0,
            'content' => $params['content'],
            'update_time' => time()
        ];

        $result = $this->notebook->update($data, $params['id']);

        if($result){
            return $this->ajaxSuccess('','编辑成功');
        }
        return $this->ajaxError('编辑失败');
    }

    /**
     * 小本本详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->notebook->find($id);
        $status = NotebookEnum::enumArr();
        $user = UserEnum::enumArr();

        $data->user_name = isset($user[$data->username]) ? $user[$data->username] : '';
        $data->status_name = isset($status[$data->status]) ? $status[$data->status] : '';

        return $this->ajaxSuccess($data,'OK');
    }

}
