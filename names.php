<?php
/**
 * Created by IntelliJ IDEA.
 * User: lipskp01
 * Date: 09/06/16
 * Time: 11:29
 */

function getRandName(){
    //PHP array containing forenames.
    $names = array(
        'Christopher',
        'Ryan',
        'Ethan',
        'John',
        'Zoey',
        'Sarah',
        'Michelle',
        'Samantha',
        'Piotr',
        'Nathan',
        'Dave'
    );

    //PHP array containing surnames.
    $surnames = array(
        'Walker',
        'Thompson',
        'Anderson',
        'Johnson',
        'Tremblay',
        'Peltier',
        'Cunningham',
        'Simpson',
        'Mercado',
        'Sellers',
        'Lipski',
        'Lawrence',
        'TheCoder'
    );

    //Generate a random forename.
    $random_name = $names[mt_rand(0, sizeof($names) - 1)];

    //Generate a random surname.
    $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];

    //Combine them together and print out the result.
    return $random_name . ' ' . $random_surname;
}
