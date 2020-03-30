<?php
namespace App\Http\Controllers\Home;

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
     * 产品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $list = $this->happy->getList($params);

        return $this->ajaxSuccess($list,'OK');
    }

    /**
     * 产品详情
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $data = $this->happy->find($id);
        $data->info = htmlspecialchars_decode($data->info ?? '');

        return $this->ajaxSuccess($data,'OK');
    }

}
