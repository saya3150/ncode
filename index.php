<?php
    if(!empty($_POST["ncode"])){
        $ncode=$_POST["ncode"];
        try{
            $db=new SQLite3('./meta.sqlite3');
        } catch (Exception $ex) {
            print $e->getTraceAsString();
            exit();

        }
        $result=$db->query("select * from meta where ncode='".$ncode."'");
        $row=$result->fetchArray();
        $maintitle=$row["maintitle"];
        }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>ncode</title>
</head>
<body>
    <?php
        if(!empty($ncode)){
            echo "<h1>".$maintitle."</h1>";
        }else{
            
        }
    ?>
<h1></h1>
</body>
</html>
