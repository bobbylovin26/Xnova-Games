<?php  //r54-energy_used_dbfix.php :: Cambia el nombre de la tabla energy_free

define('INSIDE', true);
$ugamela_root_path = '../';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.'.$phpEx);
includeLang('admin');
$no=0;



//Nos fijamos si existe la row 'energy_free'
$query = doquery("SHOW COLUMNS FROM {{table}} LIKE 'ally_points_tech'",'alliance',true);
if($query){$no++;}
else{doquery('ALTER TABLE {{table}} ADD ally_points_tech BIGINT(20) DEFAULT "0" NOT NULL','alliance');$no=0;}

//Nos fijamos si existe la row 'energy_free'
$query = doquery("SHOW COLUMNS FROM {{table}} LIKE 'ally_points_fleet'",'alliance',true);
if($query){$no++;}
else{doquery('ALTER TABLE {{table}} ADD ally_points_fleet BIGINT(20) DEFAULT "0" NOT NULL','alliance');$no=0;}

if($no>0) message($lang['Fix_welldone'],$lang['Fix'],'./');
else message($lang['Fix_welldone'],$lang['Fix'],'./');
// Created by Perberos. All rights reversed (C) 2006 
?>



