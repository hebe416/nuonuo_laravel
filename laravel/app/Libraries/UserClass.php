<?php

/**
 * Created by PhpStorm.
 * User: feifei
 * Date: 2018/3/27
 * Time: 上午11:16
 */
class UserClass extends FactoryClass
{


    public $_map = [];

    public $_result = [];

    static $_user_obj = '';
    /*主键*/
    public $_id = '';
    /*昵称*/
    public $_name = '';
    /*手机号*/
    public $_mobile = '';
    /*邮箱*/
    public $_email = '';
    /*密码*/
    public $_password = '';
    /*添加时间*/
    public $_created_at = '';
    /*修改时间*/
    public $_updated_at = '';

    protected $_model = '';

    protected $_query = '';

    public static function createUser()
    {
        $_class_path = '';
        if (!self::$_user_obj) {
            $_class_path = __CLASS__;
            self::$_user_obj = new $_class_path;
        }
        return new self::$_user_obj;
    }

    public function getListPage()
    {
        $this->__getModel();
        return $this->_query->paginate(3);
    }

    public function find($data){
        $this->__getModel();
        $this->_result = parent::find($data);
        return ($this->_result) ? $this->_result: false;
    }

    private function __getModel()
    {
        $this->_model = new App\User();
        $this->_query = $this->_model::query();
    }





}