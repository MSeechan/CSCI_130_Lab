
// var movies_arr;
var curr_index = 1; 
var httpRequest;

load_init_item();

function load_init_item(){
  send_request("POST", 'Index='+ encodeURIComponent(curr_index), "get_mysql_data.php", display_item_handler);
}


function display_item_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        let data = JSON.parse(httpRequest.responseText);
        obj = data[0];
        max = data[1];
        curr_index = parseInt(obj.movie_id) ;
        displayPageNum();
        displayObj(obj);
        
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}

function displayObj(obj) {
  // console.log(obj);
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
    "Results " + (curr_index+=1) + "/" + max;
}

function goNext() {
  if (curr_index == max) {
    return;
  } else {
    curr_index += 1;
  }
  let send_str ='Index='+ encodeURIComponent(curr_index)
  send_request("POST", send_str, "get_mysql_data.php", display_item_handler) 
}

function goPrev() {
  if (curr_index == 1) {
    return;
  } else {
    curr_index -= 1;
  }
  let send_str ='Index='+ encodeURIComponent(curr_index);
  send_request("POST", send_str, "get_mysql_data.php", display_item_handler) 
}

function goFirst() {
  curr_index = 1;
  let send_str ='Index='+ encodeURIComponent(curr_index);
  send_request("POST", send_str, "get_mysql_data.php", display_item_handler) 
}

function goLast() {
  curr_index = max;
  let send_str ='Index='+ encodeURIComponent(curr_index);
  send_request("POST", send_str, "get_mysql_data.php", display_item_handler) 
}

function get_item() {
  let input = document.getElementById("getItem").value;
  if (input > max || input < 1){
    alert("Invalid Input");
    return;
  }
  let send_str = 'Index='+ encodeURIComponent(input);
  send_request("POST",send_str, "get_mysql_data.php", display_item_handler);
  displayPageNum();
}

// send post
function send_request(action, send_str, path, callback) {
  console.log("in send request", action ,' ',send_str);
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
  send_request("POST", "", "add_item.php", 'movies.html');
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

//--------- load initial array of movies
// function load_db_item() {
  // httpRequest = new XMLHttpRequest(); // create the object
  // if (!httpRequest) {
  //   // check if the object was properly created
  //   // issues with the browser, example: old browser
  //   alert("Cannot create an XMLHTTP instance");
  //   return false;
  // }
  // httpRequest.onreadystatechange = load_db_item_handler; // we assign a function to the property onreadystatechange (callback function)
  // httpRequest.open('POST', "get_mysql_data.php"); // Use a file in reference to the page where you are!
  // httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  // httpRequest.send('Index='+ encodeURIComponent(curr_index)); 
// }

/* get response of single object
function load_db_item_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        // alert(httpRequest.responseText); // json str to Obj
        let movie = JSON.parse(httpRequest.responseText); // json str to Obj
         displayObj(movie);
         displayPageNum();
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("loadjson: Caught Exception: " + e.synopsis);
  }
}*/

// load_db_item();
