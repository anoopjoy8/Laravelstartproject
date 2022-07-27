<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use Config;
use session;
use Image;
function validation($f1)
{
    $val = array();
    $res ="";
    foreach ($f1 as $key=>$value) 
    {
        if($value[0] == "")
        {
            array_push($val,$value[1]);
        }
    }
    if(!empty($val))
    {
        foreach ($val as $key1=>$value1) 
        {
            $res.= $value1;
            $res.='<br>';
        }
    }
    return $res;
}

function success($val)
{
    $res_succ ="";
    $res_succ.= $val;
    return $res_succ;
}
function paginate($count)
{
    $y =0;
    $t = array();
    for ($x = 1; $x <= $count; $x+=Config::get('constants.PG_LIMIT_AD')) 
    {
        $y++;
        array_push($t,$y);
    }
    return $t;
}
function getStatus($val,$current_url)
{
    $val1  =  explode(",",$current_url);
    if(in_array($val, $val1))
    {
        $stat = array('main_accrodian' =>"true",'accordian_stat'=>"show");
    }
    else
    {
        $stat = array('main_accrodian' =>"false",'accordian_stat'=>"");
    }
    return $stat;
}
function getButton($id)
{
    $stat = array();
    if($id == "")
    {
        $stat = array('button_sta' =>"Submit",'button_labl'=>"primary");
    }
    else
    {
        $stat = array('button_sta' =>"Update",'button_labl'=>"danger");
    }
    return $stat;
}

