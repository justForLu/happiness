<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\FileController;
use Illuminate\Http\Request;
use App\Repositories\Home\NewsRepository as News;

class NewsController extends BaseController
{

    protected $news;

    public function __construct(News $news)
    {
        parent::__construct();

        $this->news = $news;

        view()->share('module','news');
    }

    /**
     * 新闻列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index(Request $request)
    {
        $params = $request->all();
        $result = $this->news->getList($params);
        $list = $result['list'] ?? [];
        $count = $result['count'] ?? 0;
        //处理新闻封面图片
        if ($list){
            foreach ($list as &$v){
                $v['image_path'] = array_values(FileController::getFilePath($v['image']))[0] ?? '';
                $v['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            }
        }

        return view('home.news.index',compact('list','count'));
    }

    /**
     * 新闻详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        //阅读数+1
        $modelNews = new \App\Models\Common\News();
        $modelNews->where('id',$id)->increment('read',1);

        $data = $this->news->find($id);

        return view('home.news.detail',compact('data'));
    }

}
