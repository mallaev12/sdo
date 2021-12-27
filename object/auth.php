<?php

    class Cauth
    {
        private $dbcon;
        public $userid=0;


        function __construct($con)
        {
            $this->dbcon = $con;
            // print_r($_POST);
            $userobj = new Tusers($this->dbcon);
            if (isset($_POST['login']) && isset($_POST['passw']) && isset($_POST['makelogin'])) {
                // print ("попытка авторизации");
                if ($userobj->selectBy(array("login"=>$_POST['login'], "passw"=>$_POST['passw']))){
                    $_SESSION['userid'] = $userobj->getInfo("id");
                    header("Location: ?");
                }
                
                else{
                header("Location: /?loginerror");
                }
            }

            if (isset($_GET['logout'])){
                unset($_SESSION['userid']);
                header("Location: ?");
            }

            if (isset($_SESSION['userid'])){
                $this->userid=$_SESSION['userid'];
            }
        }

        
        function check(){
            return $this->userid!=0;
        }
    }
