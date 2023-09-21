window.onload = function(){

    /* 
    NEW :: lets display what is in local storage (same page)
    usinG A REFRESH BUTTON ...
     */
//CLEARING LOCAL STORAGE :;)
//localStorage.clear();

//CALL refreh handler on load:::
 //3:: we can ALSO call the refresh handler every time we save a text///
 refreshHandler();

let theButtons = document.getElementsByClassName("titleBar");
for(let i = 0; i< theButtons.length; i++){
  theButtons[i].addEventListener('click',saveStateHandler);
}

//NEW :: A:: refresh handler - get output...
document.getElementById("refresh").addEventListener("click", refreshHandler);

function refreshHandler(){
  //get all keys in localstorage
 // helper methods::
  console.log(Object.entries(localStorage));
  console.log(Object.keys(localStorage));

  //then -> break into key values
  for (let [key, value] of Object.entries(localStorage)) {
    //console.log(`${key}: ${value}`);
    console.log(`key::${key}`)
    //console.log(`value::${value}`)
    //turn value back into array
    let arr = JSON.parse(value);
    //console.log(arr)

 
   // find the element whose data-ref MATCHES the key ... 
   //note how we can make more complex query selectors ... 
    let textBox = document.querySelector(`div[data-ref=${key}]`);
    //clear
    textBox.innerHTML ="";
    //now go through the array
    for(let i = 0; i< arr.length;i++){
        let p = document.createElement("p");
        p.textContent = arr[i];
        p.classList.add("textRet")
        textBox.appendChild(p);
    }
  }



}

// SAME AS IN 2
function saveStateHandler(event){

        console.log(this.parentElement)
        console.log(this.parentElement.querySelector("input").value)
        if(this.parentElement.querySelector("input").value!==''){
            //id of the element
            saveStateOfOption(this.id,this.parentElement.querySelector("input").value);
            //reset input val 
            this.parentElement.querySelector("input").value =''
            //2:: we can ALSO call the refresh handler every time we save a text///
            refreshHandler();
         }

         
     
  }

  // a function for all
  function saveStateOfOption(key, textField){
    //retrieve ;;; 
    let value_string = localStorage.getItem(key);
    //check if there is an item ...
    let arr = [];
    if(value_string!==null){
        arr =  JSON.parse(value_string);
    }

    //add a new val
    arr.push(textField);
    let appended_string = JSON.stringify(arr)
    // stringify + add
    localStorage.setItem(key, appended_string);


  }
}