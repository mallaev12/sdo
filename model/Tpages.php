<?php


class Tpages extends TbaseModel
{
    function __construct($con)
    {
        parent:: __construct($con);
        $this->tblname="pages";
    }
}