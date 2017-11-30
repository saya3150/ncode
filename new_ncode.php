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
        $novel_title=$line;
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
            <input type="hidden" name="ex" value="<?php echo $novel_ex; ?>">
            <input type="submit" name="submit" value="登録">
        </form>
    </body>
</html>
