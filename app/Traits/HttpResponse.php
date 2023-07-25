<?php

namespace App\Traits;

trait HttpResponse
{
    protected function success($data, $message = null, $code = 201)
    {
        return response()->json([
            'status' => "OK",
            "message"=> $message,
            "data" => $data
        ], $code);
    }

    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => "Error Has Occurred",
            "message"=> $message,
            "data" => $data
        ], $code);
    }
}
