<?php


/**
 * Created by PhpStorm.
 * User: feifei
 * Date: 2018/2/10
 * Time: 下午8:11
 */


class FactoryClass
{
    protected static $_class = [];

    protected $_query = '';

    protected $_model = '';

    private $_result = '';


    public function __construct()
    {
    }

    public static function staticCreateClass($class_name)
    {

        $class_name = $class_name . 'Class';
        if (class_exists($class_name)) {
            if (!in_array($class_name, self::$_class)) {
                self::$_class[$class_name] = new $class_name;
            }

            return self::$_class[$class_name];
        } else {
            //return "class not defind!";
            return false;
        }

    }


    /**
     * 根据条件获取数据
     * @param $data
     * @return boolean|object
     */
    public function getList($data)
    {
        if (isset($data['with'])) {
            foreach ($data['with'] as $with_k => $with_v) {
                $this->_query->with([$with_v['field'] => function ($query) {
                    $query->where('status', 1);
                }]);
            }

        }

        if (isset($data['whereBetween'])) {
            foreach ($data['whereBetween'] as $where_k => $where_v) {
                $this->_query->whereBetween($where_v['field'], [$where_v['field_val_start'], $where_v['field_val_end']]);
            }
        }

        if (isset($data['where'])) {
            foreach ($data['where'] as $where_k => $where_v) {
                $this->_query->where($where_v['field'], $where_v['field_val']);
            }
        }

        if (isset($data['order_by'])) {
            $this->_query->orderBy($data['order_by']['field'], $data['order_by']['field_val']);
        }

        if (isset($data['offset'])) {
            $this->_query->offset($data['offset']['field_val']);
        }

        if (isset($data['limit'])) {
            $this->_query->limit($data['limit']['field_val']);
        }
        $this->_result = $this->_query->get();
        return $this->_result;

    }


    /**
     * 根据条件获取条数
     * @param $data
     * @return int
     */
    public function getCount($data)
    {
        if (isset($data['with'])) {
            foreach ($data['with'] as $with_k => $with_v) {
                $this->_query->with([$with_v['field'] => function ($query) {
                    $query->where('status', 1);
                }]);
            }

        }
        if (isset($data['whereBetween'])) {
            foreach ($data['whereBetween'] as $where_k => $where_v) {
                $this->_query->whereBetween($where_v['field'], [$where_v['field_val_start'], $where_v['field_val_end']]);
            }
        }

        if (isset($data['where'])) {
            foreach ($data['where'] as $where_k => $where_v) {
                $this->_query->where($where_v['field'], $where_v['symbol'], $where_v['field_val']);
            }
        }

        $this->_result = $this->_query->count(['id']);
        return $this->_result;

    }

    /**
     * 根据条件获取条数(一条数据)
     * @param $data
     * @return object
     */
    public function find($data)
    {
        if (isset($data['with'])) {
            foreach ($data['with'] as $with_k => $with_v) {
                $this->_query->with([$with_v['field'] => function ($query) {
                    $query->where('status', 1);
                }]);
            }

        }

        if ($data['where']) {
            foreach ($data['where'] as $where_k => $where_v) {
                $this->_query->where($where_v['field'], $where_v['symbol'], $where_v['field_val']);
            }
        }
        $this->_result = $this->_query->first();
        return $this->_result;

    }

    /**
     *  修改数据
     * @param $data
     * @return object
     */
    public function update($data)
    {

        if (isset($data['whereBetween'])) {
            foreach ($data['whereBetween'] as $where_k => $where_v) {
                $this->_query->whereBetween($where_v['field'], [$where_v['field_val_start'], $where_v['field_val_end']]);
            }
        }

        if (isset($data['where'])) {
            foreach ($data['where'] as $where_k => $where_v) {
                $this->_query->where($where_v['field'], $where_v['symbol'], $where_v['field_val']);
            }
        }


        $this->_result = $this->_query->update($data['update']);

        return $this->_result;
    }

    /**
     * 添加数据
     * @param $data
     * @return object
     */
    public function create($data)
    {
        $this->_result = $this->_model->create($data);
        return $this->_result;
    }


}