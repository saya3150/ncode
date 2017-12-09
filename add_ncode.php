<?php
if(empty($_POST["ncode"])){
    exit();
}
$ncode=$_POST["ncode"];
$title=$_POST["title"];
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
    header("Location:./index.php");
    exit();
?>