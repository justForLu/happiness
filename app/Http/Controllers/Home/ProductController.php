<?php
namespace App\Http\Controllers\Home;

use App\Repositories\Home\ProductRepository as Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct();

        $this->product = $product;
        view()->share('module','product');
    }

    /**
     * 产品列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index(Request $request)
    {
        $params = $request->all();

        $list = $this->product->getList($params);

        return view('home.product.index',compact('list'));
    }

    /**
     * 产品详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $data = $this->product->find($id);
        $data->info = htmlspecialchars_decode($data->info ?? '');

        return view('home.product.detail',compact('data'));
    }

}
