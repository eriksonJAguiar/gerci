<?php

include_once("ConexaoBd.php");

class GenericDAO extends database{
    private $tableName;
    private $className;
    
    public function __construct($tableName, $className){
        $this->className = $className;
        $this->tableName = $tableName;
    }
    
    private function __clone(){}

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach(array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }
    
    public function getClassName(){
        return $this->className;
    }
    
    public function setClassName($className){
        $this->className = $className;
    }
    
    public function getTableName(){
        return $this->tableName;
    }
    
    public function setTableName($tableName){
        $this->tableName = $tableName;
    }
    
    public function getAll(){
        $sql = "SELECT * FROM " . $this->tableName;
        return $this->selectDB($sql,null,$this->className);
    }
    
    public function getAllOrderedBy($column){
        $sql = "SELECT * FROM " . $this->tableName . " ORDER BY " . $column;
        return $this->selectDB($sql,null,$this->className);
    }
    
    public function get($id){
        $sql = "SELECT * FROM " . $this->tableName . " WHERE id=" . $id;
        return $this->selectDB($sql,null,$this->className)[0];
    }
    
    public function getSpecific($columns='*', $where=null){
        $sql = "SELECT " . $columns . " FROM " . $this->tableName . " WHERE " . $where;
        return $this->selectDB($sql, null, $this->className)[0];
    }
    
    public function getAllSpecific($columns='*', $where=null){
        $sql = "SELECT " . $columns . " FROM " . $this->tableName . " WHERE " . $where;
        return $this->selectDB($sql, null, $this->className);
    }
    
    public function getAllSpecificOrderedBy($where=null, $column=null){
        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $where . " ORDER BY " . $column;
        return $this->selectDB($sql, null, $this->className);
    }
    
    public function count($where){
        $sql = "SELECT count(*) FROM " . $this->tableName . " WHERE " . $where;
        return $this->selectCount($sql);
    }

    public function insert($params=null){
        $numparams="";
        for($i=0; $i<count($params); $i++) $numparams.=",?";
        $numparams = substr($numparams,1);
        $sql = "INSERT INTO " . $this->tableName . " VALUES ($numparams)";
        $t=$this->insertDB($sql,$params);
        return $t;
    }
    
    public function updateSpecific($column, $value, $id){
        $sql = "UPDATE " . $this->tableName . " SET " . $column . "=?" . " WHERE id=" . $id;
        $t = $this->updateDB($sql,$value);
        return $t;
    }

    public function update($params=null,$id){
        $api = new ReflectionClass($this->className);
        $fields = array();
        foreach($api->getProperties() as $property){
            $atributo = substr(substr($property,30),0,strlen(substr($property,30))-3);
            if($atributo != "id"){
                array_push($fields, $atributo);
            }
        }
        $fields_T="";
        for($i=0; $i<count($fields); $i++) $fields_T.=", $fields[$i] = ?";
        $fields_T = substr($fields_T,2);
        $sql = "UPDATE " . $this->tableName . " SET $fields_T WHERE id=" . $id;
        $t=$this->updateDB($sql,$params);
        return $t;
    }

    public function delete($id,$params=null){
        $sql = "DELETE FROM " . $this->tableName;
        $sql .= " WHERE id=" . $id;
        $t=$this->deleteDB($sql,$params);
        return $t;
    }
}
?>