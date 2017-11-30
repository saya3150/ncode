<?php
	if(!empty($_GET["ncode"])){
		$ncode=$_GET["ncode"];
	}else{
		header("Location:./index.php");
		exit();
	}
	if(!empty($_GET["num"])){
		$num=$_GET["num"];
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
$result=$db->query("select * from data where id=".$num);
$row=$result->fetchArray();
$subtitle=$row["subtitle"];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>view</title>
</head>
<body>
    <h1><?php echo $maintitle; ?></h1>
    <h2><?php echo $subtitle; ?></h2>
</body>
</html>
