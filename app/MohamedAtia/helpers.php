<?php

function responseJson($status,$message,$data=null){
    $response =[
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json($response);
}

function settings(){
    $settings = \App\Models\Setting::find(1);

    if ($settings){
        return $settings;
    }else{
        return new \App\Models\Setting ;
    }
}
