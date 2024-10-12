<?php

function responseJson($status,$message,$data=null){
    $response =[
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json($response);
}

function commission(){
    $settings = \App\Models\Setting::class;

    if ($settings){
        $commission = $settings::where('key','commission')->first();
        return $commission['value'];
    }else{
        return responseJson(404,'Cant find commission',[]) ;
    }
}
