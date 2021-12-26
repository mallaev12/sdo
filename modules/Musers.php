<?php

include_once ("MBaseModule.php");

    class Musers extends MBaseModule
    {

        function execute()
        {
            $this->content = "Список пользователей";
            if(isset($_GET["edit"])){
                $this->edititem();
            } 
            else {
                $this->showlist();
            }
            
        }
        function edititem(){
            $itemid = $_GET["edit"];
            $userobj = new Tusers($this->dbcon);
            if($userobj -> select($itemid)){
                $data = [];
                $data["name"] = $userobj->getinfo("name");
                $data["date"] = $userobj->getinfo("date");
                $data["position"] = $userobj->getinfo("position");
                $data["login"] = $userobj->getinfo("login");
                $data["passw"] = $userobj->getinfo("passw");
                if(isset($_POST["saveitem"])){
                    // print_r($data);
                    // print_r($_POST);
                    $data["name"] = $_POST["name"];
                    $data["date"] = $_POST["date"];
                    $data["position"] = $_POST["position"];
                    $data["login"] = $_POST["login"];
                    $data["passw"] = $_POST["passw"];
                    // print("save");
                    if ($_POST["passw"]){
                        $p1 = $_POST["passw"];
                        $p2 = $_POST["passw2"];

                        if ($p1 == $p2){
                            $data["passw"] = $p1;
                        }
                    }


                    $userobj ->setinfo($data);
                }
            }
            $this->content="<h3>Редактировать</h3>";

            $frm = new Tform;
            $frm->addparams("method=\"post\"");
            $frm->addparams("class=\"\"");

            $frm->addtextfield("name", $data["name"], "Введите имя пользователя", "Имя пользователя");
            $frm->addtextfield("date", $data["date"], "Введите дату рождения", "Дата рождения");
            $frm->addtextfield("position", $data["position"], "Введите должность пользователя", "Должность пользователя");
            $frm->addtextfield("login", $data["login"], "Введите имя пользователя");
            $items=
                [
                    [1, "красный", 0],
                    [2, "синий", 0],
                    [3, "желтый", 1],
                    [4, "черный", 0]
                ];

            $frm->addSelectField("Список", $items, "Сделайте выбор");
            $frm->radio("Sex", 1, "", "М");
            $frm->radio("Sex", 0, "", "Ж");

            $frm->checkbox("subjects", 0, "", "Математика");
            $frm->checkbox("subjects", 1, "", "Русский язык");
            $frm->checkbox("subjects", 2, "", "Информатика");
            $frm->checkbox("subjects", 3, "", "Обществознание");
            $frm->checkbox("subjects", 4, "", "История");

            print_r($userobj->getinfo("name"));
            $frm->addpasswfield("passw", "", "Введите пароль");
            $frm->addpasswfield("passw2", "", "Введите подтверждение пароля");
            $frm->addsubmitfield("saveitem", "Сохранить");
            $this-> content.= 
            "<div class = \"container\">". 
            "<div class = \"row\">".
            $frm->out().
            "</div>". 
            "</div>";

        }

        function showlist(){
            $btn="<a href=\"?module=users&adduser\" class=\"btn btn-sm btn-primary\" title=\"Добавить пользователя\">+</a>";
            $this->content="<h3>Список пользоателей $btn</h3>";
            $userobj = new Tusers($this->dbcon);

            if (isset($_GET["del"])){
                $itemid = $_GET["del"];
                if ($userobj->select($itemid)){
                    $userobj->setInfo(["del"=>1]);
                }
                header("Location: /?module=users");
            }

            if (isset($_GET["adduser"])){
                $userobj->insert(array("name"=>"Новый пользователь", "login"=>" ", "passw"=> " "));
                header("Location: /?module=users");
            }

            $userlist = $userobj->getlistBy();
            $tbl = new Ttable;
            
            $tbl->addparams("class=\"table table-striped table-sm\"");
            foreach ($userlist as $key=>$item){
                $userobj->select($item["id"]);
                $tbl->startrow();
                $tbl->addcell($userobj->getinfo("id"));
                $tbl->addcell($userobj->getinfo("name"));
                $tbl->addcell("<a href = \?module=users&edit=".$userobj->getinfo("id")."\">Редактировать</a>");
                $tbl->addcell("<a href = \?module=users&del=".$userobj->getinfo("id")."\">Удалить</a>");
                $tbl->finishrow();

                // if (isset($_GET["del"])){
                //     $itemid = $_GET["del"];
                //     if ($userobj->select($itemid)){
                //         $userobj->setInfo(["del"=>1]);
                //     }
                //     header("Location: /?module=users");
                // }

            }
            $this->content.=$tbl->out();
        }

    }