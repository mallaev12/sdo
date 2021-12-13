<?php
session_start();

include("model/TbaseModel.php");
include("model/Tusers.php");
include("model/Tpages.php");
include("model/Tmodules.php");
include("model/Tsettings.php");
include("model/Tmenu.php");

include("object/view.php");
include("object/controller.php");
include("object/auth.php");
include("object/Ttable.php");
include("object/Tform.php");


new Ccontroller;

// $userobj = new Tusers ($dbcon);
// print ("run...");
// if ($userobj->select(1)) {
//     print ($userobj->getInfo("Name"));
//     $userobj->setInfo(array("name"=>"Tim", "Date 1999-11-04", "Position" => "Tashkent"));
// }
// else{
//     print ("не найден"); }

// $userobj->insert(array("name"=>"Alex", "Date 2001-05-11", "Position"=> "Novokuznetck"));

// $pageobj = new Tpages ($dbcon);
// $pageobj->insert(["name"=>"Новая страница",  "text"=>"Текст новой страницы", "url"=>"newpage"]);

// print ('page added -->$res');
// print ('run...');