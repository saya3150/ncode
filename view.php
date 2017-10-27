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

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>view</title>
</head>
<body>
</body>
</html>
