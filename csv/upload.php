<?php

//Controllo presenza file
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  header('Location: index.html?uploadDone=0&why=notFound');
  exit;
}

//Elimino file dentro files
$files = glob('files/*');
foreach($files as $file){
  if(is_file($file))
    unlink($file);
}

//Controllo estensione
$ext_ok = array('csv');
$temp = explode('.', $_FILES['userfile']['name']);
$ext = end($temp);
if (!in_array($ext, $ext_ok)) {
  header('Location: index.html?uploadDone=0&why=ext');
  exit;
}

//Caricamento
$uploaddir = 'files/';
$userfile_tmp = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];

if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  header('Location: index.html?uploadDone=1&fileName='.$_FILES['userfile']['name']."&column=".$_POST["column"]);
}else{
  header('Location: index.html?uploadDone=0&why=upload');
}

?>
