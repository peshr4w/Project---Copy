<?php

$year_post = date("Y", strtotime($cmd));
$month_post = date("m", strtotime($cmd));
$day_post =date("d", strtotime($cmd));
$h_post = date("h", strtotime($cmd));
$m_post = date("i", strtotime($cmd));
$s_post =date("s", strtotime($cmd));

$year_now = date("Y");
$month_now = date("m");
$day_now = date("d");
$h_now = date("h", strtotime("+1 hour"));
$m_now = date("i");
$s_now = date("s");


if($year_now > $year_post){
    echo $year_now  - $year_post."y";
}elseif($month_now > $month_post){
    echo $month_now - $month_post."month";
}elseif($day_now > $day_post){
    echo $day_now - $day_post."d";
}elseif($h_now > $h_post){
    echo $h_now - $h_post."h";
}elseif($m_now > $m_post){
    echo $m_now - $m_post."m";
}elseif($s_now > $s_post){
    echo $s_now - $s_post."s";  
}else{
    echo "Just now";
}