<?php
namespace app\user\controller;

class Result
{
    //success
    public static function Success($data)
    {
        $rs['data'] = [
            'code' => 1,
            'msg'  => "success",
            'data' => $data,
        ];
        return json($rs);
    }
    //error
    public static function Error($code, $msg)
    {
        $rs['data'] = [
            'code' => $code,
            'msg'  => $msg,
            'data' => "",
        ];
        return json($rs);
    }
}
