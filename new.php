<?php

if(!empty($_GET["error"])){
    $ec=$_GET["error"];
    if($ec == "404"){
        $mes="入力されたncodeに対応する小説を発見できませんでした.";
    }else{
        $mes="不明なエラーが検出されました.";
    }
}


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>新しい小説の追加</title>
    </head>
    <body>
        <h1>新しい小説の追加</h1>
        <h2><font color="red"><?php echo $mes; ?></font></h2>
        <form action="./new_ncode.php" method="POST">
            <input type="text" name="ncode">
            <input type="submit" name="submit">
        </form>
    </body>
</html>