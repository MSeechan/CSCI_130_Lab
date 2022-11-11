var max;
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

/* function initArr() {
                var movieArr = [];

                var SGmovie1 = new SGmovie("Spirited Away", 2001, "PG", "2h 5m", "10-year-old Chihiro and her parents stumble upon a seemingly abandoned amusement park. After her mother and father are turned into giant pigs, Chihiro meets the mysterious Haku, who explains that the park is a resort for supernatural beings who need a break from their time spent in the earthly realm, and that she must work there to free herself and her parents.", false);
                var SGmovie2 = new SGmovie("Kiki's Delivery Service", 1989, "G", "1h 43m", "This is the story of a young witch, named Kiki who is now 13 years old. But she is still a little green and plenty headstrong, but also resourceful, imaginative, and determined. With her trusty wisp of a talking cat named Jiji by her side she's ready to take on the world, or at least the quaintly European seaside village she's chosen as her new home.", true);
                var SGmovie3 = new SGmovie("My Neighbor Totoro", 1988, "G", "1h 26m", "Two young girls, 10-year-old Satsuki and her 4-year-old sister Mei, move into a house in the country with their father to be closer to their hospitalized mother. Satsuki and Mei discover that the nearby forest is inhabited by magical creatures called Totoros (pronounced toe-toe-ro). They soon befriend these Totoros, and have several magical adventures.", false);
                var SGmovie4 = new SGmovie("Howl's Moving Castle", 2004, "PG", "1h 59m", "A love story between an 18-year-old girl named Sophie, cursed by a witch into an old woman's body, and a magician named Howl. Under the curse, Sophie sets out to seek her fortune, which takes her to Howl's strange moving castle. In the castle, Sophie meets Howl's fire demon, named Karishifâ. Seeing that she is under a curse, the demon makes a deal with Sophie--if she breaks the contract he is under with Howl, then Karushifâ will lift the curse that Sophie is under, and she will return to her 18-year-old shape.", true);
                var SGmovie5 = new SGmovie("Ponyo", 2008, "G", "1h 41m", "A five-year-old boy develops a relationship with Ponyo, a young goldfish princess who longs to become a human after falling in love with him.", true);

                movieArr[0] = SGmovie1;
                movieArr[1] = SGmovie2;
                movieArr[2] = SGmovie3;
                movieArr[3] = SGmovie4;
                movieArr[4] = SGmovie5;

                myJSON = JSON.stringify(movieArr)
            }*/

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
    "Results " + (curr_index + 1) + "/" + max;
}

function goNext() {
  if (curr_index == max - 1) {
    return;
  } else {
    curr_index += 1;
    displayPageNum();
  }
  displayObj(movies_arr[curr_index]);
}

function goPrev() {
  if (curr_index == 0) {
    return;
  } else {
    curr_index -= 1;
    displayPageNum();
  }
  displayObj(movies_arr[curr_index]);
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
    alert("Caught Exception: " + e.synopsis + " wth is happening?");
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
    alert("Caught Exception: " + e.synopsis + " test error?");
  }
}

//--------- load initial array of movies
function loadJSON() {
  httpRequest = new XMLHttpRequest(); // create the object
  if (!httpRequest) {
    // check if the object was properly created
    // issues with the browser, example: old browser
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = loadJSON_handler; // we assign a function to the property onreadystatechange (callback function)
  httpRequest.open("POST", "get_mysql_data.php"); // Use a file in reference to the page where you are!
  httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  httpRequest.send('index='+encodeURIComponent(curr_index)); 
}

// var printout = document.getElementById("printout");

function loadJSON_handler() {
  try {
    console.log(httpRequest.readyState)
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        movies_arr = JSON.parse(httpRequest.responseText); // str to Obj
        console.log(movies_arr)
        max = movies_arr.length;
        let tmp = movies_arr[0];
        displayObj(tmp);
        displayPageNum();
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Caught Exception: " + e.synopsis);
  }
}
loadJSON();
