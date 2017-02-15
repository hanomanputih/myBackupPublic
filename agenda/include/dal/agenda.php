<?php
$dalTableagenda = array();
$dalTableagenda["id_agenda"] = array("type"=>3,"varname"=>"id_agenda");
$dalTableagenda["id_masuk"] = array("type"=>3,"varname"=>"id_masuk");
$dalTableagenda["Apa"] = array("type"=>201,"varname"=>"Apa");
$dalTableagenda["Tgl_mulai"] = array("type"=>7,"varname"=>"Tgl_mulai");
$dalTableagenda["Tgl_akhir"] = array("type"=>7,"varname"=>"Tgl_akhir");
$dalTableagenda["Jam_mulai"] = array("type"=>134,"varname"=>"Jam_mulai");
$dalTableagenda["Jam_akhir"] = array("type"=>134,"varname"=>"Jam_akhir");
$dalTableagenda["Tempat"] = array("type"=>200,"varname"=>"Tempat");
	$dalTableagenda["id_agenda"]["key"]=true;
$dal_info["agenda"]=&$dalTableagenda;

?>