<?php
        try{
            $db=new SQLite3('./sqlite3/meta.sqlite3');
        } catch (Exception $ex) {
            print $e->getTraceAsString();
            exit();
        }
if(!empty($_GET["ncode"])){
        $ncode=$_GET["ncode"];
        $result=$db->query("select * from meta where ncode='".$ncode."'");
        $row=$result->fetchArray();
        $maintitle=$row["maintitle"];
        try{
            $ncode_db=new SQLite3("./sqlite3/".$ncode.".sqlite3");
        } catch (Exception $ex) {
            echo "そのような小説は存在しません";
            
            exit();
        }
        $result=$ncode_db->query("select * from data");
    }else{
        $result=$db->query("select * from meta");
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
            echo "<table border><tr><td>話数</td><td>サブタイトル</td><td>洗濯</td></tr>";
            while ($row=$result->fetchArray()){
                echo "<tr><td>".$row["id"]."</td><td>".$row["subtitle"]."</td><td><a href='./view.php?ncode=".$ncode."&num=".$row["id"]."'>読む</a></td></tr>";
            }
        }else{
            echo "読みたい小説を選択してください.";
            echo "<table border><tr><td>タイトル</td><td>選択</td></tr>";
            while($row=$result->fetchArray()){
                echo "<tr><td>".$row["maintitle"]."</td><td><a href='./index.php?ncode=".$row["ncode"]."'>選択</td></tr>";
            }
        }
    ?>

</body>
</html>
