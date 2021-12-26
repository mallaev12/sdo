<?php

include_once ("MBaseModule.php");

    class Mcourse extends MBaseModule
    {

        function execute()
        {
            if(isset($_GET["edit_lk"])){
                $this->edit_lk();
            } 
            else {
                $this->output_course();
            }
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
            $data["spec_id"] = $groups->getinfo("spec_id");
            $usercourse->select($data["spec_id"]);
            $data["course"] = $usercourse->getinfo("name");

            $this->content.= "<p>".$data['name']."</p>";
            $this->content.= "<p>".$data['position']."</p>";
            $this->content.= "<p>".$data['spec_id']."</p>";
            $this->content.= "<p>".$data['group']."</p>";
            $this->content.= "<p>".$data['course']."</p>";
            $this->content.= "<a href = \?module=lk&edit_lk=".$userobj->getinfo("id")."\">Редактировать</a>";
            }
        
    }