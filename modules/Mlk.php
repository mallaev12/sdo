<?php

include_once ("MBaseModule.php");

    class Mlk extends MBaseModule
    {

        function execute()
        {
            if(isset($_GET["edit_lk"])){
                $this->edit_lk();
            } 
            else {
                $this->output_lk();
            }
        }
        function edit_lk(){
            $itemid = $_GET["edit_lk"];
            $userobj = new Tlk($this->dbcon);
            if($userobj -> select($itemid)){
                $data = [];
                $data["e_mail"] = $userobj->getinfo("e_mail");
                $data["passw"] = $userobj->getinfo("passw");
                if(isset($_POST["saveitem"])){
                    $data["e_mail"] = $_POST["e_mail"];
                    $data["passw"] = $_POST["passw"];
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
                $frm->addtextfield("e_mail", $data["e_mail"], "Введите почту пользователя", "Почта пользователя");
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
                            

        function output_lk() {
            $frm = new Tform;
            $frm->addparams("method=\"post\"");
            $frm->addparams("class=\"\""); 
            $userobj = new Tlk($this->dbcon);
            $id = new Cauth($this->dbcon);
            $groups = new Tlk2($this->dbcon);
            $userobj->select($id->userid);
            
            $data["name"] = $userobj->getinfo("name");
            $data["position"] = $userobj->getinfo("position");
            $data["ugroup_id"] = $userobj->getinfo("group_id");
            print_r($data["ugroup_id"]);
            $groups->select($data["ugroup_id"]);
            $data["group"] = $groups->getinfo("name");


            $data["e_mail"] = $userobj->getinfo("e_mail");
            $data["img"]= $userobj->getinfo("user_img");
            $this->content.= "<img src = ".$data['img']." width='250px' height = '200px'>";
            $this->content.= "<p>".$data['name']."</p>";
            $this->content.= "<p>".$data['position']."</p>";
            $this->content.= "<p>".$data['e_mail']."</p>";
            $this->content.= "<p>".$data['group']."</p>";
            $this->content.= "<a href = \?module=lk&edit_lk=".$userobj->getinfo("id")."\">Редактировать</a>";
            }
        
    }