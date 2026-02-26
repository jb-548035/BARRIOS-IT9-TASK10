<?php
//Math functions
echo "<h2>Math Fuctions</h2>";

//1. abs() - returns the absolute value 
$number = -10;
echo "abs($number) = ". abs($number) . "<br>";

//2. round() - rounds a number
$number = 4.6;
echo "round($number) = ". round($number) . "<br>";

//3. ceil() - rounds up
$number = 4.2;
echo "ceil($number) = ". ceil($number) . "<br>";

//4. floor() - rounds dows
$number = 4.8;
echo "floor($number) = ". floor($number) . "<br>";

//5. pow() - power of a number
$base = 2;
$exp = 3;
echo "pow($base, $exp) = ". pow($base, $exp) . "<br>";

//6. sqrt() - squareroot of a number
$number = 16;
echo "sqrt($number) = ". sqrt($number) . "<br>";

//7. max() / min() - find largest/smallest 
echo "max(1,5,3) = ". max(1,5,3) . "<br>";
echo "min(1,5,3) = ". min(1,5,3) . "<br>";

//8. rand() - random number
echo "rand(1,100) = ". rand(1,100) . "<br>";

//string functions
echo "<h2>String Functions</h2>";

//1. strlen() - get string lent
$str = "Hello World";
echo "strlen('$str') = ". strlen($str) . "<br>";

// 2. strtoupper() - convert to uppercase 
echo "strtoupper($str) = ". strtoupper($str) . "<br>";

// 3. strtolower() - convert to lowercase
echo "strtolower($str) = ". strtolower($str) . "<br>";

//4. 
$str2 = "apple,banana,orange";
$fruits = explode(",", $str);
echo "explode(",",$str) = ";
print_r($fruits);
echo "<br>";

// 5. 
$joined = implode(" - ", $fruits);
echo "implode(' - ', fruits) = $joined<br>";

// 6. 
echo "strrev('$str') =" . strrev($str) . "<br>";
