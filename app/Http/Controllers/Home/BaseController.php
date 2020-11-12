<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{

    /**
     * 父类构造器
     * BaseController constructor.
     */
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $action = get_action_name();
            $method = $action['method'];

            $exist_method = ['login'];
            if(!in_array($method, $exist_method)){

            }

            return $next($request);
        });

    }

}
