<?php

namespace App\Helpers;

class APIHelpers{
    public static function createAPIResponse($is_error, $code, $message, $content)
    {
        $result = [];

        if($is_error){
            $result['success'] = false;
            $resutl['code'] = $code;
            $result['message'] = $message;
        } 
        else{
            $result['success'] = true;
            $result['code'] = $code;
            
            if($content == null){
                $result['message'] = $message;
            } else {
                $result['data'] = $content;
            }
        }

        return $result;
    }

    




}
