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
	$db=new SQLite3('./sqlite3/'.$ncode.'.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}
try{
	$meta_db=new SQLite3('./sqlite3/meta.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}
$result=$meta_db->query("select * from meta where ncode='".$ncode."'");
$row=$result->fetchArray();
$maintitle=$row["maintitle"];
$result=$db->query("select * from data where id=".$num);
$prestory=$num-1;
if($prestory==0){
    $prestory=-1;
}
if(!($row=$result->fetchArray())){
    echo "<html><hea><meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">";
    echo "<meta http-equiv=\"Refresh\" content=\"5;URL=./index.php\">";
    echo "</head><body>";
    echo "<h2><font color=\"red\">該当小説が見つかりませんでした.</font></h2>";
    echo "五秒後に自動でメインページへ遷移します.";
    exit();
}
$subtitle=$row["subtitle"];
$afterstory=$num+1;
$result=$db->query("select * from data where id=".$afterstory);
if(!($row=$result->fetchArray())){
    $afterstory=-1;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>view</title>
</head>
<body>
    <h1><?php echo $maintitle; ?></h1>
    <p>
    <?php
        $filename = './ncode'.$ncode.'/'.$num.'.ncode';
        $fp = fopen($filename,'r');
        while ($line = fgets($fp)){
            echo $line;
        }
    
    
    ?>
    </p>
    <table border>
    <?php  
    
    if($prestory >0){
        echo "<tr><td><a href=\"./view.php?ncode=".$ncode."&num=".$prestory."\">前話</a></td>";
    }else{
        echo "<tr><td>　　</td>";
    }
        echo "<a href=\"./index.php?ncode=".$ncode."\">目次</a>";
    if($afterstory >0){
        echo "<tr><td><a href=\"./view.php?ncode=".$ncode."&num=".$prestory."\">次話</a></td>";
    }else{
        echo "<tr><td>　　</td>";
    }
    ?>
    </table>
</body>
</html>
