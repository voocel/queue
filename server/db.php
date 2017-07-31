<?php

class DB{
    private static $dbcon = false;
    private $host;
    private $port;
    private $username;
    private $password;
    private $db;
    private $charset;
    private $link;

    //私有构造方法
    private function __construct(){
        $this->host = '192.168.10.10';
        $this->port = '33060';
        $this->username = 'homestead';
        $this->password = 'secret';
        $this->db = 'queue';
        $this->charset = 'utf8';
        
        //链接数据库
        $this->db_connect();

        //选择数据库
        $this->db_usedb();

        //设置字符集
        $this->db_charset();
    }

    private function db_connect(){
        $this->link = mysqli_connect($this->host.':'.$this->port,$this->username,$this->password);
        if(!$this->link){
            echo '数据库连接失败!</br>';
            echo '错误编码：'.mysqli_errno($this->link).'</br>';
            echo '错误信息：'.mysqli_error($this->link).'</br>';
            exit();
        }
    }

    //设置字符集
    private function db_charset(){
        mysqli_query($this->link,"set names {$this->charset}");
    }

    //选择数据库
    private function db_usedb(){
        mysqli_query($this->link,"use {$this->db}");
    }

    //私有克隆，禁止克隆实现单例
    private function __clone(){
        die('clone is not allowed');
    }

    //公共的静态方法
    public static function getIntance(){
        if(self::$dbcon==false){
            self::$dbcon = new self;
        }
        return self::$dbcon;
    }

    //执行sql语句的方法
    public function query($sql){
        $res = mysqli_query($this->link,$sql);
        if(!$res){
            echo 'sql语句执行失败!</br>';
            echo '错误编码：'.mysqli_errno($this->link).'</br>';
            echo '错误信息：'.mysqli_error($this->link).'</br>';
            exit();            
        }
        return $res;
    }

    //获得最后一条记录id
    public function getInsertid(){
        return mysqli_insert_id($this->link);
    }

    //查询某个字段
    public function getOne(){
        $query = $this->query($sql);
        return mysqli_free_result($query); //释放结果集内存
    }


}