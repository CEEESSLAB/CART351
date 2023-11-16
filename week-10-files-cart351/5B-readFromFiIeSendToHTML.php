<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["requestFile"]))
{
  //echo($_GET["requestFile"]);
  //get the data
  // exit;
   $path = "files/".$_GET["requestFile"];
   $theFile = fopen($path, "r") or die("Unable to open file!");
   //read until eof
   //$i=0;
   $outArr = array();
   $NUM_PROPS = 3;
    //echo("test");
      while(!feof($theFile)) {
        //create an object to send back

        $packObj=new stdClass();

        for($j=0;$j<$NUM_PROPS;$j++){
          $str = fgets($theFile);
          //split and return an array ...
          $splitArr = explode(":",$str);
          $key = $splitArr[0];
          $val = $splitArr[1];
          //append the key value pair
          $packObj->$key = trim($val);
        }
        $outArr[]=$packObj;
      }

      fclose($theFile);
        // var_dump($outArr);
        // Now we want to JSON encode these values to send back.
       $myJSONObj = json_encode($outArr);
      echo $myJSONObj;
      exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>5- READ AND OUTPUT EXAMPLE </title>


<style>
body{
  background:black;
}
.wrapper-flex{
  display:flex;
    background:rgba(0, 137, 255,0.1);
  flex-wrap: wrap;
}
.single_container{
  background:rgba(0, 137, 255,0.65);
  width:25%;
  margin:3%;
  color:white;
  overflow-wrap: break-word; /** wrap text */
  padding:1%;
}
.single_container h1{
    padding:2%;
    background:rgba(0, 137, 255,0.55);

}
.single_container h2{
    padding:2%;
    background:rgba(0, 137, 255,0.45);

}
.single_container h3{
    padding:2%;
    background:rgba(0, 137, 255,0.35);

}
span{
  display:inline-block;
  color: rgba(255, 255, 255,0.35);
  width:50%;

}
#result{
  color:white;
}


</style>

</head>
<body>
  <!-- NEW for the result -->
<div id = "result"><h3> CLICK TO GET RESULTS </h3><div class = "wrapper-flex"></div> </div>
<script>
// here we put our JQUERY
window.onload = function(){
console.log("in doc load");
window.addEventListener("click",getDataOnClickGET);

function getDataOnClickGET(){

fetch('5B-readFromFiIeSendToHTML.php/?requestFile=testInput.txt')

.then(function(data){
    return data.json();
})
.then(function(res){
    console.log(res);
    showResults(res);

})
//show the results...
function showResults(arrayFromServer){
  document.querySelector(".wrapper-flex").innerHTML ="";
  for(let i =0; i<arrayFromServer.length;i++){
     //**** need to split every string here on : ***/

    let container = document.createElement("div");
    container.classList.add("single_container");
    let h1 =  document.createElement("h1");
    h1.innerHTML = "<span>ANIMAL:</span>"+arrayFromServer[i].ANIMAL;
    container.appendChild(h1);

    let h2 =  document.createElement("h2");
    h2.innerHTML="<span>COLOR:</span>"+arrayFromServer[i].COLOR;
    container.appendChild(h2);

    let h3 = document.createElement("h3");
    h3.innerHTML="<span>NUMBER:</span>"+arrayFromServer[i].FAVNUM;
    container.appendChild(h3);
    document.querySelector(".wrapper-flex").appendChild(container);
  }
}
}
}



</script>
</body>
</html>
