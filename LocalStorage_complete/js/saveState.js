window.onload = function(){
     
     
//end on load //ONLY HOLD THE SAVE FUNCTIONALITY
  let theButtons = document.getElementsByClassName("titleBar");
  for(let i = 0; i< theButtons.length; i++){
    theButtons[i].addEventListener('click',saveStateHandler);


  }


  function saveStateHandler(event){

    console.log(this.parentElement)
    console.log(this.parentElement.querySelector("input").value)
    if(this.parentElement.querySelector("input").value!==''){
        saveStateOfOption(this.id,this.parentElement.querySelector("input").value);
        //reset input val 
        this.parentElement.querySelector("input").value ='';
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