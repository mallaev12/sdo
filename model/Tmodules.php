<?php

class Tmodules extends TbaseModel
{
    function __construct($con)
    {
        parent:: __construct($con);
        $this->tblname="modules";
    }

    function execute() 
    {
        include ("modules/".$this->resource["file_name"]);
        $module = new $this->resource["class_name"]($this->dbcon);
        $module->execute();
        return $module->getContent();
    }

}