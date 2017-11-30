<?php
if(empty($_POST["ncode"])){
    exit();
}
$ncode=$_POST["ncode"];
$title=$_POST["title"];
$ex=$_POST["ex"];
require './create.php';
$fp = fopen("./ncode/".$ncode."/ex",'w');
fwrite($fp,$ex);
fclose($fp);
try{
	$db=new SQLite3('./sqlite3/meta.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}
$db->exec('insert into meta values("'.$ncode.'",0,"'.$title.'")');
try{
	$db=new SQLite3('./sqlite3/'.$ncode.'.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();
}
$db->exec('create table data(id,subtitle)');
?>