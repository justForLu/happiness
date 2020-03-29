<?php
namespace App\Http\Controllers\Home;



class IndexController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        view()->share('module','index');
    }
	public function index()
    {
        return view('home.index.index');
    }

}
