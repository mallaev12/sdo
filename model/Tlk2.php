<?php


class Tlk2 extends TbaseModel
{
    function __construct($con)
    {
        parent:: __construct($con);
        $this->tblname="groups";
    }
}