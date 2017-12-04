<?php
if(empty($_POST["ncode"])){
    echo "error";
    exit();
}
$ncode=$_POST["ncode"];

$url="http://ncode.syosetu.com/".$ncode;
exec("wget ".$url,$out,$ret);
if($ret == 8){
    header("Location:./new.php?error=404");
    exit();
}
$state=0;
$fp = fopen("./".$ncode,'r');
while ($line = fgets($fp)){
    if(strpos($line,'<p class="novel_title">') !== false){
        $line=substr($line,23);
        $novel_title=substr($line,0,strpos($line,"</p>"));
    }
    if(strpos($line,'<div id="novel_ex">') !== false){
        $state=1;
        $novel_ex=$line;
    }
    if($state==1){
        $novel_ex=$novel_ex.$line;
        if(strpos($line,'</div>') !== false)$state=0;
    }
}
fclose($fp);
$directory_path = "./ncode/".$ncode;    //この場合、一つ上の階層に「hoge」というディレクトリを作成する
 $st=0;
//「$directory_path」で指定されたディレクトリを作成する
if(mkdir($directory_path, 0777)){
    $st=0;
}else{
    echo "ERROR:Can't create folder";
    exit();
}
$fp = fopen("./ncode/".$ncode."/ex",'w');
fwrite($fp,$novel_ex);
fclose($fp);
exec("rm ".$ncode);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>新しい小説-<?php echo $ncode; ?></title>
    </head>
    <body>
        <h1>新しい小説-<?php echo $ncode; ?></h1>
        <dl>
            <dt>ncode</dt>
            <dd><?php echo $ncode; ?></dd>
        </dl>
        <dl>
            <dt>タイトル</dt>
            <dd><?php echo $novel_title; ?></dd>
        </dl>
        <dl>
            <dt>あらすじ</dt>
            <dd><?php echo $novel_ex; ?></dd>
        </dl>
        <form action="./add_ncode.php" method="post">
            <input type="hidden" name="ncode" value="<?php echo $ncode; ?>">
            <input type="hidden" name="title" value="<?php echo $novel_title; ?>">
            <input type="submit" name="submit" value="登録">
        </form>
    </body>
</html>
