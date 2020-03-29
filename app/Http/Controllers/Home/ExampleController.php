<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Admin\FileController;
use App\Repositories\Home\ExampleRepository as Example;
use Illuminate\Http\Request;

class ExampleController extends BaseController
{

    protected $example;

    public function __construct(Example $example)
    {
        parent::__construct();

        $this->example = $example;

        view()->share('module','example');
    }

    /**
     * 案例首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $result = $this->example->getList($params);
        $list = $result['list'] ?? [];
        $count = $result['count'] ?? 0;
        //处理图片
        if($list){
            foreach ($list as &$v){
                $v['image_path'] = array_values(FileController::getFilePath($v['image']))[0] ?? '';
            }
        }

        return view('home.example.index',compact('list','count'));
    }

}
