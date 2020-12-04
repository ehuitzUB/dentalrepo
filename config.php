<?php

/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package  MyPackage
 * @author   Elmer Huitz <2014110553@ub.edu.bz>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 *
 */


define('DB_SERVER', '198.57.151.234');
define('DB_USERNAME', 'elmerhui_elmer');
define('DB_PASSWORD', 'belize123');
define('DB_NAME', 'elmerhui_dentaldatabase');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>