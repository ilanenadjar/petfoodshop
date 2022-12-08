<?php
class Model {

    public $db;
    public $table;
    public $id = "id";
    public function __construct() {
    $dbserver = "localhost";
    $dbName = "dogshop";
    $dbUser = "root";
    $dbPass = "root";
    $connectString = "mysql:host=$dbserver;dbname=$dbName";

    try {
        $iConnect = new PDO($connectString, $dbUser, $dbPass);
        $iConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $iConnect->exec("SET CHARACTER SET utf8");
        }
        catch (PDOException $e) {
        echo "Connexion (PDO) a la DB $dbName du serveur $dbserver impossible.</br>";
        die();
    }

    $this->db = $iConnect;

    }

    public function findfromreq($sql){
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_CLASS);
    }

    public function findfirstfromreq($req){
        return current($this->findfromreq($req));
    }

    public function findCountfromreq($sql){
        $res = $this->findfirstfromreq($sql);
        return $res->count;
    }

    public function save($data,$currenttable,$key){
        $table = $currenttable;
        $fields = array();
        $d = array();
        foreach($data as $k=>$v){
            if($k != $key){
            $fields[] = "$k=:$k";
        }

        if($k != $key || !empty($data->$key)){
        $d[":".$k]=$v;
            }
        }

        if(isset($data->$key) && !empty($data->$key)){
            $sql ='UPDATE '.$table.' SET '.implode(',',$fields).' where '.$key.'=:'.$key;
        }

        else{
            $sql ='INSERT INTO '.$table.' SET '.implode(',',$fields);
        }
        echo $sql;

        $pre = $this->db->prepare($sql);
        $pre->execute($d);
        return true;
    }
}
?>