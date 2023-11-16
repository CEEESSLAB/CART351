<?php
//https://www.php.net/manual/en/features.file-upload.php#114004
//https://www.sitepoint.com/community/t/file-uploading-with-fetch-and-php/357513/2
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
// need to process
 $artist = $_POST['a_name'];
 $title = $_POST['a_title'];
 $loc = $_POST['a_geo_loc'];
 $description = $_POST['a_descript'];
 $creationDate = $_POST['a_date'];
 if($_FILES)
  {
    //echo "file name: ".$_FILES['filename']['name'] . "<br />";
    //echo "path to file uploaded: ".$_FILES['filename']['tmp_name']. "<br />";
   $fname = $_FILES['filename']['name'];
   move_uploaded_file($_FILES['filename']['tmp_name'], "images/".$fname);
   //make an array an encode as json
  // $msg = array();
  // $msg["response"] = "success";
    //echo json_encode($msg);


    //package the data and echo back...
    /* make  a new generic php object */
   $myPackagedData=new stdClass();
   $myPackagedData->response = "success";
   $myPackagedData->artist = $artist ;
   $myPackagedData->title = $title ;
   $myPackagedData->location = $loc ;
   $myPackagedData->description = $description ;
   $myPackagedData->creation_Date = $creationDate ;
   $myPackagedData->fileName = $fname ;
    /* Now we want to JSON encode these values as a JSON string ..
    to send them to $.ajax success  call back function... */
   $myJSONObj = json_encode($myPackagedData);
   echo $myJSONObj;

    exit;
  }//FILES
}//POST
        

?>

<html>
<head>
<title>Sample Insert into Gallery Form USING FETCH </title>
<!--set some style properties::: -->
<link rel="stylesheet" type="text/css" href="css/galleryStyle.css">
</head>
<body>
  <!-- NEW for the result -->
<div id = "result"></div>
 
<div class= "formContainer">
<!--form done using more current tags... -->
<form id="insertGallery" action="" enctype ="multipart/form-data">
<!-- group the related elements in a form -->
<h3> SUBMIT AN ART WORK :::</h3>
<fieldset>
<p><label>Artist:</label><input type="text" size="24" maxlength = "40" name = "a_name" required></p>
<p><label>Title:</label><input type = "text" size="24" maxlength = "40"  name = "a_title" required></p>
<p><label>Geographic Location:</label><input type = "text" size="24" maxlength = "40" name = "a_geo_loc" required></p>
<p><label>Creation Date (DD-MM-YYYY):</label><input type="date" name="a_date" required></p>
<p><label>Description:</label><textarea type = "text" rows="4" cols="50" name = "a_descript" required></textarea></p>
<p><label>Upload Image:</label> <input type ="file" name = 'filename' size=10 required/></p>
<p class = "sub"><input type = "submit" name = "submit" value = "submit my info" id ="buttonS" /></p>
 </fieldset>
</form>
</div>
<script>
    window.onload = function (){
        console.log("ready");
        document.querySelector("#insertGallery").addEventListener("submit", function(){
            event.preventDefault();
            console.log("button clicked");
            console.log("form has been submitted");


            //part two
            let form = document.querySelector("#insertGallery");
            let formData = new FormData(form);
            /*console.log to inspect the data */
           for (let pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
         }

       

    fetch('/InsertGalleryFetch.php', {
    method: 'POST',
    body: formData
    })
    .then(function (response) {
            console.log("got here with response ...");
            return response.json();
     })
    .then(result => {
        
        console.log(result.response);
        if(result.response!=="success"){
            throw new Error('Something went wrong '+ result);

        }
        else{
            console.log('Here:', result);
            displayResponse(result);
            form.reset();

        }
     })
    .catch(error => {
    console.error('Error:', error);
    });

 })

 function displayResponse(theResult){
      let container = document.createElement("div");
      container.classList.add("outer");
      document.querySelector("#result").appendChild(container);
      
      let title = document.createElement("h3");
      title.textContent= "Results from user";
      container.appendChild(title);
      
      let contentContainer = document.createElement("div");
      contentContainer.classList.add("content");
      container.appendChild(contentContainer);

      for (let property in theResult) {
        console.log(property);
        if(property ==="fileName"){
          let img = document.createElement("img");
          img.setAttribute('src','images/'+theResult[property]);
          contentContainer.appendChild(img);
        }
        else if(property!=="response"){
          let para = document.createElement('p');
         para.textContent = property+"::" +theResult[property];
            contentContainer.appendChild(para);
        }

      }
    

    }
}

</script>
</body>
</html>