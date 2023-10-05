#! /usr/bin/env php 

<?php 


$input = (string) readline("Please provide your text : ");
$result = preg_replace('~[^A-Za-z]~','',$input);
printf("The are " . strlen($result) . " alphabets.");