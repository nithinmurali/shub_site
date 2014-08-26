<?php
$allowedExts = array("mp3", "wav");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$_POST['name'] =  $_POST['name'] .'.'. $extension;
if (in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_POST["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("upload/" . $_POST["name"])) {
      echo $_POST["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "songs/" . $_POST["name"]);
      echo "Stored in: " . "songs/" . $_POST["name"];
      file_put_contents("new.txt",$_POST["name"]);
    }
  }
} else {
  echo "Invalid file";
}
echo" \nyou will be redirected";
header("refresh: 4; url=admin.php");
?>