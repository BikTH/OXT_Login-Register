<?php

function base64UrlEncode($inputStr){ return strtr(base64_encode($inputStr), '+/=', '-_,'); }

function base64UrlDecode($inputStr){ return base64_decode(strtr($inputStr, '-_,', '+/=')); }


function unlink_ ( $filename ) {
    // try to force symlinks
    if ( is_link ($filename) ) {
        $sym = @readlink ($filename);
        if ( $sym ) {
            return is_writable ($filename) && @unlink ($filename);
        }
    }

    // try to use real path
    if ( realpath ($filename) && realpath ($filename) !== $filename ) {
        return is_writable ($filename) && @unlink (realpath ($filename));
    }

    // default unlink
    return is_writable ($filename) && @unlink ($filename);
}


function array_serialize($array, $key){
    if( ( gettype( $array ) !== "object" ) AND ( gettype( $array ) !== "array") ){
        return false;
    }

    $result = array();
    foreach ($array as $value) {
        $result[] = ( !is_array( $value ) ) ? $value->$key : $value[$key];
    }

    return $result;
}



function aksort(&$array,$valrev=false,$keyrev=false) {
  if ($valrev) { arsort($array); } else { asort($array); }
    $vals = array_count_values($array);
    $i = 0;
    foreach ($vals AS $val=>$num) {
        $first = array_splice($array,0,$i);
        $tmp = array_splice($array,0,$num);
        if ($keyrev) { krsort($tmp); } else { ksort($tmp); }
        $array = array_merge($first,$tmp,$array);
        unset($tmp);
        $i = $num;
    }
}



function assets($ressource = null, $public = false){
    $base = !$public ? base_url() : "https://www.pubshake.com/";
    if( $ressource !== "" ){
        echo $base."public/assets/".$ressource;
    }
    else{
        return $base."public/assets/";
    }
}



function emptybox($text = null, $subtext = "", $imgName = null, $id = "emptybox", $className = "" ){
    if( $text == null ){$text = "No data for the moment";}
    if( $imgName == null ){$imgName = "empty.svg";}
    echo '<div class="emptybox startertip '.$className.'" id="'.$id.'"><img class="img-fluid py-3 p-b-0" src="'.assets('').'img/'.$imgName.'" alt="" /><div class="font-weight-light h4 no-select">'.$text.'</div><div class="font-notice mt-2 text-muted no-select">'.$subtext.'</div></div>';
}



function now($fulldate = true){
    if( $fulldate )
        return date("Y-m-d H:i:s");
    else{
        return date("Y-m-d");
    }
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
