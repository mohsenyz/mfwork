<?php
use App\Config;
use Medoo\Medoo;
class DB{
    private static $medoo = null;
    public static function init(){
        $def = Config::get('db.default');
        $info = Config::get('db.drivers.' . $def);
        self::$medoo = new Medoo([
            'database_type' => $info['type'],
            'database_name' => $info['db'],
            'server' => $info['host'],
            'username' => $info['username'],
            'password' => $info['password'],
            'charset' => Config::get('db.charset', 'utf8'),
        ]);
    }


    private $tableName = null;
    private $select = '*';
    private $where = null;
    private function __construct($tableName){
        $this->tableName = $tableName;
    }

    public static function table($name){
        return new DB($name);
    }

    public function select($columns){
        if (is_array($columns)){
            $this->select = $columns;
        }else if (is_string($columns)){
            $this->select = [$columns];
        }else{
            throw new Exception("parameter passed to :select is not acceptable");
        }
        return $this;
    }

    public function where($where){
        if (is_array($where)){
            $this->where = $where;
        }else{
            throw new Exception("parameter passed to :where is not acceptable");
        }
        return this;
    }


    public function get(){
        return self::$medoo->select(
            $this->tableName,
            $this->select,
            $this->where
        );
    }


    public function first(){
        return self::$medoo->get(
            $this->tableName,
            $this->select,
            $this->where
        );
    }
}