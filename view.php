<?php
	if(!empty($_POST["ncode"])){
		$ncode=$_POST["ncode"];
	}else{
		header("Location:./index.php");
		exit();
	}
	if(!empty($_POST["num"])){
		$num=$_POST["num"];
	}else{
		header("Location:./index.php");
		exit();	
	}
try{
	$db=new SQLite3('./'.$ncode.'.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}
try{
	$meta_db=new SQLite3('./meta.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}
$result=$meta_db->query("select * from meta where ncodeid='".$ncode."'");
$row=$result->fetchArray();
$maintitle=$row["maintitle"];
$result=$db->query("select * from data");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>view</title>
</head>
<body>
</body>
</html>
