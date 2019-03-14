<?php

namespace Honviettour\Utilities;

class Api
{

    function response($data, $statusCode = 200)
    {
        if($statusCode >= 400) {
            $response['status'] = 'error';
            $response = array_merge($response, $data);
        } else {
            $response['status'] = 'success';
            $response['data'] = $data;
            $response['links'] = [
                'self' => [
                    'href' => url()->current(),
                    'method' => $_SERVER['REQUEST_METHOD']
                ]
            ];
        }
        $response['code'] = $statusCode;
        return response()->json($response, $statusCode);
    }

}
