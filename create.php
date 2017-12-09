<?php
$directory_path = "./ncode/".$ncode;    //この場合、一つ上の階層に「hoge」というディレクトリを作成する
 $st=0;
//「$directory_path」で指定されたディレクトリを作成する
if(mkdir($directory_path, 0777)){
    $st=0;
}else{
    echo "ERROR:Can't create folder";
    exit();
}

?>