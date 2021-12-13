<?php

class Ccontroller {

    private $dbcon;
    private $content;
    private $settings;

    function __construct()
    {
        $this->connect();
        // $this->test();


        $settingobj = new Tsettings($this->dbcon);
        $this->settings = $settingobj->load();
        
        $authobj = new Cauth ($this->dbcon);
        if ($authobj->check())
        {
            $this->content = "текст страницы";
            $this->router();
            $viewobj = new Cview ($this->settings["templateDir"].$this->settings["mainTemplate"]);
            $menuobj = new Tmenu ($this->dbcon);
            $viewobj->make(array("content"=>$this->content,
                "title"=>$this->settings["systemName"],
                "menu"=>$menuobj->make()
            ));
            
        }
        else{
            $viewobj = new Cview ($this->settings["templateDir"].$this->settings["loginTemplate"]);

            $mes = "";
            if (isset($_GET['loginerror'])){
                $mes = "Ошибка авторизации";
            }
            $viewobj->make(array('message' => $mes));
        }


    }


    function test()
    {
        print_r($_SESSION);
        $_SESSION["name"] = "user";
        print_r($_SESSION);
    }


    function connect()
    {
        $type = "mysql";
        $host = "localhost";
        $base = "tstbase";
        $user = "root";
        $pasw = "";

        $dsn = $type.":host=".$host.";dbname=".$base;
        $opt = array (
            PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->dbcon = new PDO ($dsn, $user, $pasw, $opt);
    }

    function router()
    {   
        $mod = "main";

        if (isset($_GET['module']))
        {
            $mod = $_GET['module'];
        }
            $moduleobj = new Tmodules($this->dbcon);
            if ($moduleobj->selectBy(array("alias"=>$mod))){
                $this->content = $moduleobj->execute();
                // $this->content = "Найден модуль".$_GET['module'];
            }
        else {
            header("locaton: ?");
        }
    }
}