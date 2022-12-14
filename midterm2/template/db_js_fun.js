var curr_index = 0;
var httpRequest;
var db_obj;

function load_db() {
  send_request("POST", "get_all_records=", "get_all_records.php", display_obj_handler);
}

function display_obj_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        db_obj = JSON.parse(httpRequest.responseText);
        max = parseInt(db_obj.pop()) - 1;
        displayObj(db_obj[curr_index]);
        displayPageNum();
        displayJson(db_obj);
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}

function displayJson(){
  document.getElementById("jdisplay").innerHTML = JSON.stringify(db_obj[curr_index]);

}

// display an object
function displayObj(obj) {
  document.getElementById("col1").value = obj.col1;
  document.getElementById("col2").value = obj.col2;
  document.getElementById("col3").value = obj.col3;
  document.getElementById("id").value = obj.id;
}

// display curr index results/max
function displayPageNum() {
  document.getElementById("record_num").innerHTML =
    "Results " + (curr_index + 1) + "/" + (max + 1);
}

function goNext() {
  if (curr_index == max) {
    return;
  } else {
    curr_index += 1;
    displayObj(db_obj[curr_index]);
    displayPageNum();
    displayJson()
  }
}

function goPrev() {
  if (curr_index == 0) {
    return;
  } else {
    curr_index -= 1;
    displayObj(db_obj[curr_index]);
    displayPageNum();
    displayJson()
  }
}

function goFirst() {
  curr_index = 0;
  displayObj(db_obj[curr_index]);
  displayPageNum();
  displayJson()
}

function goLast() {
  curr_index = max;
  displayObj(db_obj[curr_index]);
  displayPageNum();
  displayJson()
}

// get specified index input from html and display the obj
function get_item() {
  let input = document.getElementById("getItem").value - 1;
  if (input > max || input < 0) {
    alert("Invalid Input");
    return;
  }
  curr_index = input;
  displayObj(db_obj[curr_index]);
  displayPageNum();
  displayJson()
}

// generalized request function for post and get
function send_request(action, send_str, path, callback) {
  //console.log("request:", action, " ", send_str);
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

// sort depending on incoming criteria from html
function sort_record(sort_criteria) {
  send_request("POST", sort_criteria, "sort_records.php", display_obj_handler);
}

// toggle form elements disable or enable 
function toggle_edit() {
  let form = document.getElementById("page_form");
  let elements = form.elements;
  for (let i = 0, len = elements.length; i < len; i++) {
    elements[i].disabled == true
      ? (elements[i].disabled = false)
      : (elements[i].disabled = true);
  }
}

// just a test function to see a response 
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
    alert("test: Caught Exception: " + e.synopsis);
  }
}

load_db();
toggle_edit();
