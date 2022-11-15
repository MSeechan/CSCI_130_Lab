
// var movies_arr;
var curr_index = 0; 
var httpRequest;
var db_obj


function load_db(){
  send_request("POST", "array=", "get_mysql_data.php", display_obj_handler);
}

function display_obj_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        db_obj = JSON.parse(httpRequest.responseText);
        max = parseInt(db_obj.pop())-1
        displayObj(db_obj[curr_index]);
        displayPageNum();
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}

function displayObj(obj) {
  document.getElementById("title").value = obj.title;
  document.getElementById("year").value = obj.year;
  document.getElementById("length").value = obj.length;
  document.getElementById("rating").value = obj.rating;
  document.getElementById("synopsis").innerText = obj.synopsis;
  document.getElementById("recommended").value = obj.recommended;
  document.getElementById("movie_id").value = obj.movie_id;
}

function displayPageNum() {
  document.getElementById("page_num").innerHTML =
    "Results " + (curr_index+1) + "/" + (max+1);
}

function goNext() {
  if (curr_index == max) {
    return;
  } else {
    curr_index+=1;
    displayObj(db_obj[curr_index]);
    displayPageNum();
  }
}

function goPrev() {
  if (curr_index == 0) {
    return;
  } else {
    curr_index-=1;
    displayObj(db_obj[curr_index]);
    displayPageNum();
  }
}

function goFirst() {
  curr_index = 0;
  displayObj(db_obj[curr_index]);
  displayPageNum();
}

function goLast() {
  curr_index = max;
  displayObj(db_obj[curr_index]);
  displayPageNum();
}

function get_item() {
  let input = document.getElementById("getItem").value-1;
  if (input > max || input < 0){
    alert("Invalid Input");
    return;
  }
  curr_index = input;
  displayObj(db_obj[curr_index]);
  displayPageNum();
}

// send post
function send_request(action, send_str, path, callback) {
  console.log("request:", action ,' ',send_str);
  httpRequest = new XMLHttpRequest();
  if (!httpRequest) {
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = callback;
  httpRequest.open(action, path);
  httpRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  httpRequest.send(send_str);
}

function add_item() {
  send_request("POST", "", "add_item.php", load_db);
}

function update_item(){

}

function test() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        let data = JSON.parse(httpRequest.responseText);
        console.log("in test:       ", data);
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("test: Caught Exception: " + e.synopsis );
  }
}

load_db();

