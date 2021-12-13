<?php


class Tusers extends TbaseModel
{
    function __construct($con)
    {
        parent:: __construct($con);
        $this->tblname="users";
    }
}