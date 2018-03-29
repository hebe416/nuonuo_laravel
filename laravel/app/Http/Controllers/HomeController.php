<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_obj = \UserClass::createUser();
        $users = $user_obj->getListPage();
        return view('auth.index', compact(['users']));
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user_obj = \UserClass::createUser();
        $user_obj->_id = intval($request->route('id'));
        if ($user_obj->_id <= 0)
            return response()->view('error.404', [], 404);

        $user_obj->_map = [
            'where' => [
                ['field' => 'id', 'symbol' => '=', 'field_val' => $user_obj->_id],
            ],
        ];
        $user = $user_obj->find($user_obj->_map);
        if (!$user)
            return response()->view('error.404', [], 404);
        return view('auth.edit', compact(['user']));
    }

    public function update(Request $request)
    {
        $user_obj = \UserClass::createUser();
        $user_obj->_id = $request->input('id');


    }


    public function check(Request $request)
    {
        $user_obj = \UserClass::createUser();
        $user_obj->_id = intval($request->input('id'));
        $user_obj->_mobile = $request->input('mobile');
        $user_obj->_email = $request->input('email');
        $msg_name = '';
        if (!$user_obj->_id)
            return response()->json(['msg' => '缺少主序列号信息', 'code_describe' => 'error'], 300);
        elseif (!$user_obj->_mobile && !$user_obj->_email)
            return response()->json(['msg' => '缺少需要检查的参数', 'code_describe' => 'error'], 300);
        else {
            if ($user_obj->_mobile) {
                $user_obj->_map['where'][] = ['field' => 'mobile', 'symbol' => '=', 'field_val' => $user_obj->_mobile];
                $msg_name = '手机号';
            } else {
                $user_obj->_map['where'][] = ['field' => 'email', 'symbol' => '=', 'field_val' => $user_obj->_email];
                $msg_name = '邮箱';
            }
            array_push($user_obj->_map['where'], ['field' => 'id', 'symbol' => '!=', 'field_val' => $user_obj->_id]);
            $user = $user_obj->find($user_obj->_map);
            if (!$user)
                return response()->json(['msg' => '该' . $msg_name . '可以使用', 'code_describe' => 'success'], 200);
            else {
                return response()->json(['msg' => '该' . $msg_name . '已使用请重新填写', 'code_describe' => 'error'], 300);
            }

        }

    }

    public function test()
    {

        echo 123;
    }

}
