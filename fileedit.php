<?php
$filename = './index.html';
$fp = fopen($filename,'r');
$state=0;
$array=array();
if(!file_exists("./ncode")){
	if(!mkdir("./ncode")){
		echo "ncodeフォルダを作成できませんでした.";
		exit(1);
	}
}
if(!file_exists("./ncode/".$ncodeid)){
	if(!mkdir("./ncode/".$ncodeid)){
		echo $ncodeid."フォルダを作成できませんでした.";
		exit(1);
	}
}
if($fp){
	while ($line = fgets($fp)){
		if(strpos($line,'<div id="novel_no">') !== false)$state=1;
		if(strpos($line,'<div class="novel_bn">') !== false)$state=0;
		if($state==1){
			array_push($array,$line);
		}
	}
}
print_r($array);
fclose($fp);
$filewrite_p="./ncode/".$ncodeid."/".$atai.".ncode";
$fp=fopen($filewrite_p,'w');
foreach($array as $value){
	fwrite($fp,$value);	
}
fclose($fp);
?>
