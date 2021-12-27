<?php

include_once ("MBaseModule.php");

    class Mcourse extends MBaseModule
    {

        function execute()
        {
            if(isset($_GET["id"])){
                $this->out_cours();
            } 
            else {
                $this->output_course();
            }
        }
        function out_cours(){
            $usercourse = new Tcourse($this->dbcon);
            $id = $_GET["id"];
            $usercourse->select($id);
            $name = $usercourse->getinfo("name");
            $this->content = "<h3>Курс:".$name."</h3>";
        }
                            

        function output_course() {
            $usercourse = new Tcourse($this->dbcon);
            $userobj = new Tlk($this->dbcon);
            $id = new Cauth($this->dbcon);
            $groups = new Tlk2($this->dbcon);
            $userobj->select($id->userid);
            
            $data["name"] = $userobj->getinfo("name");
            $data["position"] = $userobj->getinfo("position");
            $data["ugroup_id"] = $userobj->getinfo("group_id");

            $groups->select($data["ugroup_id"]);
            $data["spec_id_group"] = $groups->getinfo("spec_id");

            
        
            $this->content.= "<p>".$data['name']."</p>";
            $this->content.= "<p>".$data['position']."</p>";

            //$this->content.= "<p>".$data['spec_id']."</p>";
            $this->content.= "<p>".$data['group']."</p>";

            $coursesList = $usercourse->getListBy();
            
            foreach($coursesList as $key => $item){
                $usercourse->select($item["id"]);
                $data_c["spec_id"] = $usercourse->getinfo("spec_id");
                if ($data_c["spec_id"] == $data["spec_id_group"]){
                        $usercourse->select($item["id"]);
                        $data["course"] = $usercourse->getinfo("name");
                        $this->content.= "<a href = \?module=courses&id=".$item["id"].">".$data['course']."</a><br>";
                }
            }
            
            
            
            //$this->content.= "<a href = \?module=lk&edit_lk=".$userobj->getinfo("id")."\">Редактировать</a>";
            }
        
    }