<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // for HTTP code  -> Response.php
  
    public function sendResponse($message, $result=[], $code = 200)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            // 'status_code' => $code,
        ];

        if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
        {
        	$response = [
                'success' => false,
                'message' => $error,
                // 'status_code' => $code,
            ];
            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }
            return response()->json($response, $code);
        }


}
