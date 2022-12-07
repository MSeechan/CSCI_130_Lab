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
        maketbl(db_obj);
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}

function maketbl(){
  let tbl = document.getElementById("mytbl");
  for(let i=0; i<db_obj.length;i++){ 
    let tr = document.createElement("TR");
    tbl.appendChild(tr);
    let td = document.createElement("TD");
    td.innerText=JSON.stringify(db_obj[i]);
    tr.appendChild(td);
  }

}

// display an object
function displayObj(obj) {
  document.getElementById("LivingSpace").value = obj.LivingSpace;
  document.getElementById("Beds").value = obj.Beds;
  document.getElementById("Baths").value = obj.Baths;
  document.getElementById("Zip").value = obj.Zip;
  document.getElementById("id").value = obj.Index;
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



load_db();

