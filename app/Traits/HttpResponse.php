<?php

namespace App\Traits;

trait HttpResponse
{
    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, $message = null, $code = 201)
    {
        return response()->json([
            'status' => "OK",
            "message"=> $message,
            "data" => $data
        ], $code);
    }

    /**
     * @param $data
     * @param null $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => "Error Has Occurred",
            "message"=> $message,
            "data" => $data
        ], $code);
    }
}
