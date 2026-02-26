<?php

//Index array
$fruits = array("Apple", "Banana", "Mango");

echo $fruits[0];
echo $fruits[1];
$student = array(
    "name" => "Janna", 
    "age" => "20",
    "course" => "IT"
);

//Associative array
echo "Name: ", $student["name"] . "<br>";
echo "Age: ", $student["age"] . "<br>";
echo "Course: ", $student["course"] . "<br>";
$students = array (
    array("name" => "Janna", "age" => 20, "course" => "IT"),
    array("name" => "George", "age" => 23, "course" => "CS"),
    array("name" => "Ben", "age" => 21, "course" => "IS")
);

//Multi Dimensional Array
echo $students[0]['name'] . "<br>";
echo $students[1]['age'] . "<br>";
echo $students[2]['course'] . "<br>";

$text = "apple,banana,orange";
$fruits1 = explode(",",$text);
print_r($fruits);
echo "<br><br>";

$fruits2 = implode(",",$fruits);
echo $text;

?>