<?php 

function compareStrings($s1, $s2) {
    //to check if the two answer script are available for comparison else return nothing 
    if (strlen($s1)==0 || strlen($s2)==0) {
        return 0;
    }

    //checking for  alphanumeric characters
    //i left - in case its used to combine words
    $s1clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s1);
    $s2clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s2);

    //remove double spaces
    while (strpos($s1clean, "  ")!==false) {
        $s1clean = str_replace("  ", " ", $s1clean);
    }
    while (strpos($s2clean, "  ")!==false) {
        $s2clean = str_replace("  ", " ", $s2clean);
    }

    //create arrays
    $array_one = explode(" ",$s1clean);
    $array_two = explode(" ",$s2clean);
    $l1 = count($array_one);
    $l2 = count($array_two);

    //flip the arrays if needed so array1 is always largest.
    if ($l2>$l1) {
        $t = $array_two;
        $array_two = $array_one;
        $array_one = $t;
    }

    //switch array_two to make words key
    $array_two = array_flip($array_two);


    $maxwords = max($l1, $l2);
    $matches = 0;

    //Look up words that match
    foreach($array_one as $word) {
        if (array_key_exists($word, $array_two))
            $matches++;
    }

    return ($matches / $maxwords) * 100;    
}
?>