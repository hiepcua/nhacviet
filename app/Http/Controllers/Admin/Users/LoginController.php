<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\User;

class LoginController extends Controller
{
    public function __construct(){
        $this->user = new User();
    }

    public function loginForm(){
        return '111';
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function handleLogin(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6'
        ];

        $messages = [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật Khẩu không được dưới 6 ký tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect(route('admin.login'))->withErrors($validator)->withInput();
        }else{
            $email = $request->input('email');
            $password = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' =>$password])) { 
                return redirect()->route('admin.dashboard');
            } else {
                $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không tồn tại.');
                return redirect()->route('admin.login');
            }
        }
    }

    public function logOut(Request $request){
        Auth::logout();
        session()->flash('success-logout', 'Logout Success!');
        return redirect(route('admin.users.login'));
    }

    function register(){ 
        return view('admin.users.register', [
            'title' => 'Đăng ký tài khoản'
        ]);
    }

    function handleRegister(Request $request){ 
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không được ít hơn 6 ký tự',
            'password.confirmed' => 'Retype password không khớp với mật khẩu',
            'password_confirmation.required' => 'Retype password không được để trống',
            'password_confirmation.min' => 'Retype password không được ít hơn 6 ký tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];

            $this->user->addUser($dataInsert);
            return redirect()->route('admin.register')->with('msg', 'Đăng ký thành công');
        }
    }

    function forgotPassword(){ 
        return view('admin.users.forgotpassword', [
            'title' => 'Quên mật khẩu'
        ]);
    }

    function handleForgotPassword(Request $request){ 
        return redirect()->route('admin.forgot-password')->with('error', 'Something went wrong');
        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $email = $request->input('email');
            $user = $this->user->getUserByEmail($email);

            if(!empty($user)){
                $dataUpdate = [
                    'email' => $request->email,
                    'password' => bcrypt('123456'),
                ];

                $this->user->updateUser($dataUpdate, $request->email);
                return redirect()->route('admin.forgot-password')->with('msg', 'Reset mật khẩu thành công');
            }else{
                return redirect()->route('admin.forgot-password')->with('error', 'Something went wrong');
            }
        }
    }
}
