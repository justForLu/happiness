<?php
namespace App\Http\Controllers\Home;

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
     * 新闻列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function index(Request $request)
    {
        $params = $request->all();
        $result = $this->notebook->getList($params);
        $list = $result['list'] ?? [];
        $count = $result['count'] ?? 0;
        //处理新闻封面图片
        if ($list){
            foreach ($list as &$v){
                $v['image_path'] = array_values(FileController::getFilePath($v['image']))[0] ?? '';
                $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            }
        }

        return $this->ajaxSuccess($list,'OK');
    }

    /**
     * 新闻详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->notebook->find($id);

        return $this->ajaxSuccess($data,'OK');
    }

}
