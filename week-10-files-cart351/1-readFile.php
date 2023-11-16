<html>
<head>
<title>READ FROM A FILE</title>
</head>
<body>
  <h1> CART 351 : READING FROM A FILE </h1>
<?php
//https://www.w3schools.com/php/php_ref_filesystem.asp
//A:does? exist?
//$theFile = fopen("files/testCART351file.txt", "r") or die("Unable to open file!");
//B this one exists :)
$theFile = fopen("files/testCART351file_2021.txt", "r") or die("Unable to open file!");
//The first parameter of fread() contains the name of the file to read
//from and the second parameter specifies the maximum number of bytes to read.
//i.e. lets read the entire file ///
//echo (fread($theFile,filesize("files/testCART351file_2021.txt")));

// step 2 : we want to not only read the entirety - but line by line (ensure that data saved is on each line)
// Output one line until end-of-file
// while(!feof($theFile)) {
//   echo ("a string:: ".fgets($theFile) . "<br/>") ;
// }

//// step 3 : we want to not only read the entirety - but char by char
// Output one line until end-of-file
// while(!feof($theFile)) {
//   echo ("a char:: ".fgetc($theFile) . "<br/>") ;
// }
//close at end
fclose($theFile);
?>

</body>
</html>
