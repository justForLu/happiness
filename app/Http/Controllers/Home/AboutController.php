<?php
namespace App\Http\Controllers\Home;

use App\Enums\FeedbackEnum;
use App\Models\Admin\Feedback;
use App\Repositories\Home\AboutRepository as About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutController extends BaseController
{

    protected $about;

    public function __construct(About $about)
    {
        parent::__construct();

        $this->about = $about;

        view()->share('module','about');
    }

	public function index()
    {
        return view('home.about.index');
    }

    public function feedback(Request $request)
    {
        $params = $request->all();
        //验证手机号和邮箱
        if($params['mobile']){
            if(!check_mobile($params['mobile'])){
               return $this->ajaxSuccess('','手机号格式不正确');
            }
        }
        if($params['email']){
            if(!check_email($params['email'])){
               return $this->ajaxSuccess('','邮箱格式不正确');
            }
        }
        if(strlen($params['content']) < 10 || strlen($params['content']) > 200){
            return $this->ajaxSuccess('','意见内容字数请控制在10~200字之间');
        }
        $ip = get_client_ip();
        //根据IP验证今天意见提交次数，限制5次
        $modelFeedback = new Feedback();
        $zero_time = strtotime(date('Y-m-d'));
        $count = $modelFeedback->where('ip',$ip)
            ->where('create_time','>=',$zero_time)
            ->where('create_time','<',$zero_time + 86400)
            ->count();
        if($count > 5){
            return $this->ajaxSuccess('','您今天已经多次提交，我们会及时处理您的反馈信息');
        }

        $data = [
            'name' => $params['name'] ?? '',
            'mobile' => $params['mobile'] ?? '',
            'email' => $params['email'] ?? '',
            'content' => $params['content'] ?? '',
            'status' => FeedbackEnum::UNTREATED,
            'ip' => $ip,
            'create_time' => time()
        ];

        $result = $modelFeedback->insert($data);

        if($result){
            return $this->ajaxSuccess('','提交成功');
        }
        return $this->ajaxError('提交失败');
    }
}
