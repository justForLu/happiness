<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
     * 父类构造器
     * BaseController constructor.
     */
    public function __construct(){
        $this->middleware(function ($request, $next) {

            return $next($request);
        });

    }

}
