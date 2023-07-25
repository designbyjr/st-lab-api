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
            'status' => $this->codeMessage($code),
            "message"=> $message,
            "data" => $data
        ], $code);
    }

    private function codeMessage(int $code){
         switch ($code){
            case "404": "Not Found";
                break;
            case "403": "Forbidden";
                break;
            case "401": "Unauthorized";
                break;
            case "405": "Method Not Allowed";
                break;
            default: "Error Has Occurred";
                break;
        }
    }
}
