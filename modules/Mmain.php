<?php

include_once ("MBaseModule.php");

    class Mmain extends MBaseModule
    {
        function execute()
        {
            $this->content = "Текст модуля главная";
        }
    }