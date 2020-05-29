<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\sendCode;
use Illuminate\Support\Facades\Mail;
use App\Users;
class LoginController extends Controller
{
    public function login(){
    	return view('index.login');
    }
    public function logindo(){
    	$data=request()->except('_token');
        if(!$data['username']){
            return redirect('/login')->with('msg','请输入用户名');
        }
    	$res=Users::where('username',$data['username'])->first();
        if(!$res['username']){
            return redirect('/login')->with('msg','用户名不存在');
        }
    	if(decrypt($res->pwd)!=$data['pwd']){
    		return redirect('/login')->with('msg','用户名或密码错误');
    	}

    	session(['res'=>$res]);
        if($data['refer']){
            return redirect($data['refer']);
        }

    	return redirect('/');
    }
     //退出
    public function quit(){
        request()->session()->flush();
        return redirect('/');
    }


    public function register(){
    	return view('index.register');
    }
    public function registerdo(Request $request){
    	$data=request()->except('_token');
    	//dd($data);
     	$code=$request->session()->get('code');
     	if($data['username']!=$code['name']||$data['code']!=$code['code']){
     		return redirect('/register')->with('msg','验证码错误');
		}
		if($data['pwd']!==$data['repwd']){
			return redirect('/register')->with('msg','两次密码不一致');
		}
		$reg= '/^1[3|4|5|6|7|8|9]\d{9}$/';
		if(preg_match($reg, $data['username'])){
			$data['mobile']=$data['username'];
		}
		$reg= '/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
		if(preg_match($reg,$data['username'])){
			$data['email']=$data['username'];
		}
		//unset($data['username']);
		unset($data['repwd']);
		unset($data['code']);
		$data['pwd']=encrypt($data['pwd']);
		$info=Users::create($data);
		if($info){
			return redirect('/login');
		}else{
			return redirect('/register')->with('msg','注册失败');
		}
    }

    public function sendSms(){
    	$mobile=request()->username;
    	$reg= '/^1[3|4|5|6|7|8|9]\d{9}$/';
    	if(!preg_match($reg,$mobile)){
    		echo json_encode(['code'=>'00001','msg'=>'请输入正确的手机号']);die;
    	}
    	$code=rand(100000,999999);
    	//发送短信验证码
    	$result=$this->send($mobile,$code);
    	if($result['Message']=='OK'){
    		session(['code'=>['name'=>$mobile,'code'=>$code]]);
    		request()->session()->save();
    		echo json_encode(['code'=>'00000','msg'=>'发送成功']);die;
    	}
    }

    public function send($mobile,$code){
    	AlibabaCloud::accessKeyClient('LTAI4FzueAUt95Z2L1NUPiZH', 'xEOkN5NzcAkmxQoZaTQU4CUxc0AjCo')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $mobile,
		                                          'SignName' => "便利100",
		                                          'TemplateCode' => "SMS_172880045",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}
    }

    public function sendEmail(){
    	$email=request()->username;
    	$reg= '/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
    	if(!preg_match($reg,$email)){
    		echo json_encode(['code'=>'00001','msg'=>'请输入正确的邮箱']);die;
    	}
    	$code=rand(100000,999999);
    	//dd($code);
    	//使用邮箱发送验证码
    	Mail::to($email)->send(new sendCode($code));
    	session(['code'=>['name'=>$email,'code'=>$code]]);
    	request()->session()->save();
    	echo json_encode(['code'=>'00000','msg'=>'发送成功']);die;
    }



}


// AccessKeyID：
// LTAI4FzueAUt95Z2L1NUPiZH
// AccessKeySecret：
// xEOkN5NzcAkmxQoZaTQU4CUxc0AjCo