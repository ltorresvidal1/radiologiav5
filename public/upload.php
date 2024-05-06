
<?php

use PhpParser\Node\Stmt\Else_;

$ext = ".ogg";
$target_dir = "audios/";
$target_dir = $target_dir . $_POST["name"] . "/";
$nombreaudio = "audio_";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    exec("chmod 777 " . $target_dir);
}

$target_file = $target_dir . "audio";
$i = 1;
if (file_exists($target_file . '1' . $ext)) {

    //   unlink($target_file  . $ext);

    while (file_exists($target_file . "" . $i  . $ext))
        $i++;
    $target_file = $target_file . "" . $i . $ext;
} else {
    $target_file = $target_file . '1' . $ext;
}


if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
    exec("chmod 777 " . $target_file);
    echo "ok";
} else
    echo "error";

?>
