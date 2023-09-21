window.onload = function(){

//onload 
refreshHandler();


//and with button
document.getElementById("refresh").addEventListener("click", refreshHandler);
//FROM BEFORE::
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
}//load