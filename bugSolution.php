To address this issue, ensure consistent use of either string or integer keys throughout your array operations.  Explicitly type cast array keys to strings using (string)$key if you expect string keys.  For comparing arrays where you want to ignore key type differences, use a function that iterates over the values for comparison. 

```php
<?php
$array1 = [0 => 'a', 1 => 'b', 2 => 'c'];
$array2 = ['0' => 'a', '1' => 'b', '2' => 'c'];

// Incorrect comparison
if ($array1 == $array2) {
    echo "Arrays are equal";
} else {
    echo "Arrays are NOT equal"; //This will be the output
}

// Solution: Iterate and compare values
function compareArraysByValue(array $arr1, array $arr2): bool {
    return count($arr1) === count($arr2) && array_intersect_assoc($arr1,$arr2) === $arr1;
}

if (compareArraysByValue($array1, $array2)) {
    echo "\nArrays have same values";
} else {
    echo "\nArrays do not have same values";
}

// Alternative solution: Cast keys to strings
$array3 = array_map(function ($v, $k) { return [$k => $v]; }, $array1, array_keys($array1));
$array4 = array_map(function ($v, $k) { return [$k => $v]; }, $array2, array_keys($array2));

foreach ($array3 as $key => $value) {
    $array3[(string)$key] = $value;
}
foreach ($array4 as $key => $value) {
    $array4[(string)$key] = $value;
}

if ($array3 == $array4) {
    echo "\nArrays are equal after key casting";
} else {
    echo "\nArrays are NOT equal after key casting";
}
?>
```