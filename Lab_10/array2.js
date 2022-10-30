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
/*-----------------------------*/
function formToArr(arr, n){
    for (let i = 0; i < n; i++){
        arr[i] =  document.getElementById("v" + i).value;
    }
}

var httpRequest;
function sendArr(){
    var n = document.getElementById("arrayN").value;
    // new arr to fill w/strs
    let form_arr = new Array();
    // fill new arr w/ id V# values
    formToArr(form_arr, n);
    //stringify arr ["#","#",...n]
    let str_arr = JSON.stringify(form_arr);

    httpRequest = new XMLHttpRequest(); // create the req object
    if (!httpRequest) { // check if the object was properly created
        alert('Cannot create an XMLHTTP instance');  // issues with the browser, example: old browser
        return false;
    }
    httpRequest.onreadystatechange = getArrResponse();  // assign a callback function to the property onreadystatechange
    httpRequest.open('POST','processArr.php');  // GET/POST ACTION + php where req is going     
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('Array=' + str_arr); // {Array key = str val} sent
  }

function getArrResponse() {
    try {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
              // get response obj back and process it
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

  // process obj
  function processResponse(response){
    var str = "";
    str += "Mean: " + response.mean + "<br>";
    str += "STD: " + response.std + "<br>";
    str += "Median: " + response.median + "<br>";
    str += "Min: " + response.min + "<br>";
    str += "Max: " + response.max + "<br>";
    document.getElementById("response").innerHTML = str;
  }