function genArray(){
    var n = document.getElementById("arrayN").value;
    let str = "";
    for (let i = 0; i < n; i++){
        str += '<td><input type="text" id="v' + (i) + '"></td>';

    }
    document.getElementById("row").innerHTML = str;
    let arr = randomList();
    arrToForm(arr);
}
function randomList(){
    let n = document.getElementById("arrayN").value;
    var arr = new Array();
    for (let i = 0; i < n; i++){
        arr[i] = Math.round(Math.random()*10);
    }
    return arr;
}
function arrToForm(arr){
    let n = document.getElementById("arrayN").value;
    for (let i = 0; i < n; i++){
        document.getElementById("v" + i).value = arr[i];
    }
}
function formToArr(arr){
    let n = document.getElementById("arrayN").value;
    for (let i = 0; i < n; i++){
        arr[i] =  document.getElementById("v" + i).value;
    }
}
var httpRequest;
function sendArr(){
    let arr = new Array();
    formToArr(arr);
    let strArr = JSON.stringify(arr);
    console.log(arr);

    httpRequest = new XMLHttpRequest(); // create the object
    if (!httpRequest) { // check if the object was properly created
        // issues with the browser, example: old browser
        alert('Cannot create an XMLHTTP instance');
        return false;
    }
    httpRequest.onreadystatechange = getArrResponse;  // we assign a function to the property onreadystatechange (callback function)
    httpRequest.open('POST','processArr.php');  // ACTION + (string containing address of the file + parameters if needed)       
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('Array=' + strArr); // POST = send with parameter (the string with the relevant information)
}
function getArrResponse() {
    try {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {      
              // We retrieve a piece of text corresponding to some JSON
              // now you have a nice object in the response, you can access its properties and values to populate the different fields of your form
              // the next stages will be about the creation of this JSON from the PHP side, in relation to some data that we extracted from a database
              alert(httpRequest.responseText); // If you have a bug, use an alert of what is given back from the server (for textual content)
              // if you return something that cannot be converted to an object, then debug the PHP side !
              var response = JSON.parse(httpRequest.responseText);
              processResponse(response);
        } 
        else {
          alert('There was a problem with the request.');
        }
      }
    }
    // catch any errors
    catch( e ) {
      alert('Caught Exception: ' + e.description);
    }
  }
  function processResponse(response){
    var str = "";
    str += "Mean: " + response.mean + "<br>";
    str += "STD: " + response.std + "<br>";
    str += "Median: " + response.median + "<br>";
    str += "Min: " + response.min + "<br>";
    str += "Max: " + response.max + "<br>";
    document.getElementById("response").innerHTML = str;
  }