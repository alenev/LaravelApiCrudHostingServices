<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function apiResponceSuccess(string|array|object $data, int $code = 200):JsonResponse
    {
        if($code < 200 || $code  > 299)
        {

            return response()->json(['error' => "success response code not valid"], $code);
        }

        if(empty($data)){
 
            return response()->json(['error' => "success response data is empty"], $code);
    
        }else{

            if(is_string($data) || is_array($data)){

              return response()->json(['data' => $data], $code);

            }else if(is_object($data)){

                $adata = get_object_vars($data);
                
                if(empty($adata)){

                    return response()->json(['error' => "success response data object is empty"], $code);

                }else{

                    $oadata = [];
                        
                    foreach($adata as $key => $val){
                        
                        $oadata[$key] = $val;

                    }

                    return response()->json(['data' => $data], $code);

                }

            }

             
        }
      
    }

    protected function apiResponceError(string|array|object $message, int $code = 200):JsonResponse
    {
        if($code < 300)
        {

            return response()->json(['error' => "error response code not valid"], $code);
        }

        if(empty($message)){

            return response()->json(['error' => "error response message is empty"], $code);
    
        }else{

            return response()->json(['error' => $message], $code);

        }
    }
    
}
