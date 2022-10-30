<?php
# CSci130 - Web Programming (notice how the comment is a # at the beginning of the line)

# Example (dont worry for the PHP syntax, we will have a class about it)
// isset: function that determines if a variable is set and is not NULL
// $name: variable containing the value of the variable defined as userName sent by the client
$name = (isset($_POST['userName'])) ? $_POST['userName'] : 'no name';
# Create a string 
$computedString = "Hi, " . $name . " welcome";

// The double arrow operator (=>): an access mechanism for arrays. 
// what is on the left side of it will have a corresponding value of what is on the right side of it in array context.

/* 
The simple arrow operator (->): used in object scope to access methods and properties of an object. 
what is on the right of the operator is a member of the object instantiated into the variable on the left side of the operator.
*/

// Here we are not doing much, just repackaging the variable within an array and encoded into a JSON structure 
$array = ['userName' => $name, 'computedString' => $computedString];
echo json_encode($array);
// the output of the echo will be caught by the XMLHttpRequestobject responseText value
?>