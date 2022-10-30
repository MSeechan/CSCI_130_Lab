//tbl with 1 long dynamic row
function genArray(){
    var n = document.getElementById("arrayN").value;
    let td_str = "";
    // gen long str to make dynamic n number of empty td's. each have id v<n>
    for (let i = 0; i < n; i++){
        td_str += '<td><input type="text" id="v' + (i) + '"></td>';
    }
    // put long td str in row
    document.getElementById("row").innerHTML = td_str;
    //gen rand arr
    let rand_arr = gen_rand_arr(n);
    //fill empty td's w/rand_arr's values
    arrToForm(rand_arr);
}
function gen_rand_arr(n){
    let arr = new Array();
    // gen rand btwn 1-100
    for (let i = 0; i < n; i++){
        arr[i] = Math.round(Math.random()*100);
    }
    return arr;
}
function arrToForm(rand_arr){
    // get all empty td's made by their id's and put arr vals into them
    for (let i = 0; i < rand_arr.length; i++){
        document.getElementById("v" + i).value = rand_arr[i];
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