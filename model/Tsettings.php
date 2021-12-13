<?php

class Tsettings extends TbaseModel
{
    function __construct($con)
    {
        parent:: __construct($con);
        $this->tblname="settings";
    }

    function load()
    {
        $setList = $this->getListBy();
        $sts =[];
        foreach ($setList as $key => $item)
        {
            $this->select($item["id"]);
            $sets[$this->resource["name"]]=$this->resource["val"];

        }
        // print_r($sets);
        return $sets;
    }
}