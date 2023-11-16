<?php
//If you use fopen() on a file that does not exist, it will create it,
//given that the file is opened for writing (w)
//nOTE  - "w" overwrites ....
$theFile = fopen("files/testCART351fileA.txt", "w") or die("Unable to open file!");

//1::
$txt = "Wagner\n";
fwrite($theFile, $txt);
fclose($theFile);



// //STEP 2: writing more data:
// $txt = "Sabine\n";
// fwrite($theFile, $txt);
// $txt = "Marianne\n";
// fwrite($theFile, $txt);
// fclose($theFile);

/*STEP 3: try to append using write - will OVERWRITE
$txt = "Jacob\n";
fwrite($theFile, $txt);
fclose($theFile);*/

?>
<html>
<head>
<title>WRITE TO A FILE</title>
</head>
<body>
  <h1> CART 351 : WRITING TO A FILE (check files/testCART351fileW.txt)</h1>
</body>
</html>
