<?php
$filename = './index.html';
$fp = fopen($filename,'r');
$state=0;
$ncodeid="n4976ea";
$atai=1;
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
		if(strpos($line,'<p class="novel_subtitle">') !== false){
		      $state=1;
		      $num=strpos($line,'<p class="novel_subtitle">');
		      $string=substr($line,$num+29);
			$num=strpos($string,'</p>');
			$string=substr($string,0,$num);
                }
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
