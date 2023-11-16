<?php
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if(isset($_GET['fav_animal'])){


   $animal = $_GET['fav_animal'];
   $color = $_GET ['fav_color'];
   $fav_num = $_GET['fav_num'];
   //If you use fopen() on a file that does not exist, it will create it,
   //given that the file is opened for writing (w) or appending (a).
   $theFile = fopen("files/testInput.txt", "a") or die("Unable to open file!");

  fwrite($theFile, "\n"."ANIMAL:".$animal."\n");
  fwrite($theFile, "COLOR:".$color."\n");
  //fwrite($theFile, $color); // no newline...
  fwrite($theFile,  "FAVNUM:".$fav_num);

  fclose($theFile);
  $outArray = array();
  $outArray["response"] = "success to file";
  $myJSONObj = json_encode($outArray);
  echo $myJSONObj;
   // you must exit
exit;
}

}
?>

