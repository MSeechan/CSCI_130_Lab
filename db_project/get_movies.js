var max=5;
var movies_arr;
var curr_index = 0; //curr index of displayed movie
var httpRequest;

class SGmovie {
  // title;
  // year;
  // length;
  // rating;
  // synopsis;
  // recommended;

  constructor(title, year, rating, length, synopsis, recommended) {
    this.title = title;
    this.year = year;
    this.length = length;
    this.rating = rating;
    this.synopsis = synopsis;
    this.recommended = recommended;
  }
}

var myJSON;

function displayObj(obj) {
  console.log(obj);
  document.getElementById("title").value = obj.title;
  document.getElementById("year").value = obj.year;
  document.getElementById("length").value = obj.length;
  document.getElementById("rating").value = obj.rating;
  document.getElementById("synopsis").innerText = obj.synopsis;
  document.getElementById("recommended").value = obj.recommended;
  document.getElementById("movie_id").value = obj.movie_id;
}

function displayPageNum(curr_index) {
  document.getElementById("page_num").innerHTML =
    "Results " + (curr_index + 1) + "/" + max;
}

function goNext() {
  if (curr_index == max - 1) {
    return;
  } else {
    curr_index += 1;
    displayPageNum();
  }
  // displayObj(movies_arr[curr_index]);
  loadPHP();
}

function goPrev() {
  if (curr_index == 0) {
    return;
  } else {
    curr_index -= 1;
    displayPageNum();
  }
  // displayObj(movies_arr[curr_index]);
  loadPHP();
}

function goFirst() {
  curr_index = 0;
  displayObj(movies_arr[0]);
  displayPageNum();
}

function goLast() {
  curr_index = max - 1;
  displayObj(movies_arr[curr_index]);
  displayPageNum();
}

function get_item() {
  let input = document.getElementById("getItem").value;
  curr_index = input - 1;
  let send_str = "input=" + input;
  send_post(send_str, "get_item.php", display_item);
}

// send post
function send_post(send_str, path, callback) {
  console.log("in send post", send_str);
  httpRequest = new XMLHttpRequest();
  if (!httpRequest) {
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = callback;
  httpRequest.open("POST", path);
  httpRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  httpRequest.send(send_str);
}

function display_item() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        let data = JSON.parse(httpRequest.responseText);
        displayObj(data);
        displayPageNum();
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}
// get curr form values and update array to send to server
function update_item() {
  // movies_arr[curr_index].title = curr_movie.get('title')
  // movies_arr[curr_index].year = curr_movie.get('year')
  // movies_arr[curr_index].length = curr_movie.get('length')
  // movies_arr[curr_index].rating = curr_movie.get('rating')
  // movies_arr[curr_index].recommended = curr_movie.get('recommended')
  // movies_arr[curr_index].synopsis = curr_movie.get('synopsis')
  // myJSON = JSON.stringify(movies_arr);
  // send_post(myJSON, 'update_item.php', test);
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
function loadPHP() {
  httpRequest = new XMLHttpRequest(); // create the object
  if (!httpRequest) {
    // check if the object was properly created
    // issues with the browser, example: old browser
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = loadPHP_handler; // we assign a function to the property onreadystatechange (callback function)
  httpRequest.open('POST', "get_mysql_data.php"); // Use a file in reference to the page where you are!
  httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  httpRequest.send('Index='+ encodeURIComponent(curr_index)); 
}

// get response of single object
function loadPHP_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        alert(httpRequest.responseText); // json str to Obj
        let movie = JSON.parse(httpRequest.responseText); // json str to Obj
        // console.log(movies_arr)
         displayObj(movie);
         curr_index = parseInt(movie.movie_id);
         displayPageNum(curr_index);
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("loadjson: Caught Exception: " + e.synopsis );
  }
}

loadPHP();
