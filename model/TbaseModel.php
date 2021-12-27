<?php

class TbaseModel
{
    protected $dbcon;
    protected $tblname;
    protected $resource;

    function __construct($con)
    {
        $this->dbcon = $con;
    }

    function select($itemid)
    {
        $requst = $this->dbcon->prepare("select * from `".$this->tblname."` where `del` = 0 and `id` = :id");
        $requst->execute(array("id"=>$itemid));
        
        if ($this->resource = $requst->fetch() ) 
        {
            return 1;
        }
    
        return 0;
    }

    function insert($values){
        // print_r($values);
    foreach ($values as $key => $value){
        // print("$key => $value\n");
        $ssql1.=$sep. "`$key`";
        $ssql2.=$sep. ":$key";
        $sep=", ";
        }

        $sql = "insert into `".$this->tblname."` (".$ssql1.")
            values (".$ssql2.")";
        // print ("\n$ssql1\n");
        // print ("\n$ssql2\n");
        // print ("\n$sql\n");
        $requst = $this->dbcon->prepare($sql);
        $rs = $requst->execute($values);
        // print (">>>>$rs\n");
        return $rs;
               
    }

    function selectBy($values){
    
        $ssql="";
        $sep="";
        foreach ($values as $key => $value ){
            // print("$key => $value\n");
            $ssql.=" and `$key`=:$key";
           
        }

        $requst = $this->dbcon->prepare("select * from `".$this->tblname."` where `del` = 0  $ssql");
        $requst->execute($values);
        
        if ($this->resource = $requst->fetch()) 
        {
            return 1;
        }
    
        return 0;
    }

    function setInfo($values){
        $ssql1.="";
        $sep="";
        foreach ($values as $key => $value ){
            // print("$key => $value\n");
            $this->resourse[$key]=$value;
            $ssql.=$sep."`$key`=:$key";
            $sep=", ";
        }
        $values["id"]=$this->resource["id"];

        // print_r($values);
        $sql = "update `".$this->tblname."` set $ssql where `id` =:id";

        $request = $this->dbcon->prepare($sql);
        $rs = $request->execute($values);
        return $rs;
    }

    function getInfo($filedName)
    {
        return $this->resource[$filedName];
    }

    function getListBy($values=[])
    {
        $ssql="";
        foreach ($values as $key => $value ){
            $ssql.=" and `$key`=:$key";
           
        }

        $request = $this->dbcon->prepare("select `id` from `".$this->tblname."` where `del` = 0  $ssql");
        $request->execute($values);
        return $request->fetchAll();
    }

    function getListspec($values=[])
    {
        $ssql="";
        foreach ($values as $key => $value ){
            $ssql.=" and `$key`=:$key";
           
        }

        $request = $this->dbcon->prepare("select `spec_id` from `".$this->tblname."` where `del` = 0  $ssql");
        $request->execute($values);
        return $request->fetchAll();
    }
}