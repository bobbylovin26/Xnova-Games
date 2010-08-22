<?php
/**
 * XNova Legacies
 *
 * @license GNU General Public Licence version 3
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

class Database
{
    static $dbHandle = NULL;
    static $config = NULL;
}

function doquery($query, $table, $fetch = false)
{
    if (!isset(Database::$config)) {
        $config = require dirname(dirname(__FILE__)) . '/config.php';
    }

    if(!isset(Database::$dbHandle))
    {
        Database::$dbHandle = mysql_connect(
            $config['global']['database']['options']['hostname'],
            $config['global']['database']['options']['username'],
            $config['global']['database']['options']['password'])
                or trigger_error(mysql_error() . "$query<br />" . PHP_EOL, E_USER_WARNING);

        mysql_select_db($config['global']['database']['options']['database'], Database::$dbHandle)
            or trigger_error(mysql_error()."$query<br />" . PHP_EOL, E_USER_WARNING);
    }
    $sql = str_replace("{{table}}", "{$config['global']['database']['table_prefix']}{$table}", $query);

    $sqlQuery = mysql_query($sql, Database::$dbHandle) or
        trigger_error(mysql_error()."$sql<br />" . PHP_EOL, E_USER_WARNING);

    if($fetch) {
        return mysql_fetch_array($sqlQuery);
    }else{
        return $sqlquery;
    }
}
