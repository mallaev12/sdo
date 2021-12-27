<?php

include_once ("MBaseModule.php");

    class Mpage extends MBaseModule
    {
        function execute()
        {
            $this->content = "Текст модуля стриницы";
        }
    }