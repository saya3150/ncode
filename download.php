<?php
/*
* metaデータベースのカラムはncode,latest,maintitleである.
* 各ncodeごとに新たにデータベースを所持する.
* そのデータベースはid,subtitleとする.
*
*
*
*
*/

try{
	$db=new SQLite3('./meta.sqlite3');
} catch (Exception $ex) {
	print $e->getTraceAsString();
	exit();

}

$result=$db->query("select * from meta");


$ncodeid="n4976ea";
$beforenum="2";


while($row=$result->fetchArray()){
	$ncodeid=$row["ncode"];
	$beforenum=$row["latest"];
	while(1){
		$atai=$beforenum+1;
		$url="http://ncode.syosetu.com/".$ncodeid."/".$atai."/";
		exec("wget ".$url,$out,$ret);
		if($ret == 8){
		echo "New File get Error.";
		$atai=$atai-1;
		$db->exec("update meta set latest=".$atai." where ncode='".$ncodeid."'");
		break;
		}else{
		echo "New File get Success";
		require('./fileedit.php');
		}
		exec("rm index.html");
		sleep(10);
		$beforenum=$atai;
	}
}
?>
