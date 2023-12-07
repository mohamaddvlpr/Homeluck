<?php

const BASE_URL = 'http://localhost:8000/';

function dd($data){
    die('<pre>' . var_export($data , true) . '</pre>');
}

function asset($file){
  return BASE_URL . 'assets/' . $file;
}

function url($path , $query = []){
    if(!count($query))
        return BASE_URL . $path;

        return BASE_URL . $path . '?' . http_build_query($query);
    
}

function redirect($path , $query = []){
    $url = url($path , $query);
    header("location: $url");
    exit;
}