<?php

if(!defined('INSIDE')){ die("attemp hacking");}

class debug
{
	var $log,$numqueries;

	function debug()
	{
		$this->vars = $this->log = '';
		$this->numqueries = 0;
	}

	function add($mes)
	{
		$this->log .= $mes;
		$this->numqueries++;
	}

	function echo_log()
	{
		echo  "<br><table><tr><td class=k colspan=4><a href=".ROOT_PATH."admin/settings.php>Debug Log</a>:</td></tr>".$this->log."</table>";
		die();
	}
	
	function error($message,$title)
	{
		global $link,$game_config;
		if($game_config['debug']==1){
			echo "<h2>$title</h2><br><font color=red>$message</font><br><hr>";
			echo  "<table>".$this->log."</table>";
		}

			global $user;
			include(ROOT_PATH . 'config.'.PHPEXT);
			if(!$link) die('La base de donnee n est pas disponible pour le moment, desole pour la gene occasionnee...');
			$query = "INSERT INTO {{table}} SET
				`error_sender` = '{$user['id']}' ,
				`error_time` = '".time()."' ,
				`error_type` = '{$title}' ,
				`error_text` = '".mysql_escape_string($message)."';";
			$sqlquery = mysql_query(str_replace("{{table}}", $dbsettings["prefix"].'errors',$query))
				or die('error fatal');
			$query = "explain select * from {{table}}";
			$q = mysql_fetch_array(mysql_query(str_replace("{{table}}", $dbsettings["prefix"].
				'errors', $query))) or die('error fatal: ');
				

			if (!function_exists('message'))
				echo "Erreur, merci de contacter l'admin. Erreur n°: <b>".$q['rows']."</b>";
			else
				message("Erreur, merci de contacter l'admin. Erreur n°: <b>".$q['rows']."</b>", "Erreur");
		//}
		
		die();
	}
	
	
}

?>
