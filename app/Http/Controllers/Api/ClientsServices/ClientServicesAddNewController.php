<?php

namespace App\Http\Controllers\Api\ClientsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClientsServicesRepositoryEloquent;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ServiceAddRequest;
use Illuminate\Support\Facades\Auth;

class ClientServicesAddNewController extends Controller
{
    
    private $clientsServicesRepository;
    private $user;
    private $clientService;

    public function __construct(){

        $this->clientsServicesRepository = new ClientsServicesRepositoryEloquent();
        
    }

    public function addNew(ServiceAddRequest $request):JsonResponse
    {
        if(isset($request->validator) && $request->validator->fails()) { 
  
            return Controller::apiResponceError($request->validator->errors()->first(), 422); 
 
       }else{

            $this->user = Auth::user();

            $this->clientService = $this->clientsServicesRepository->clientServiceExistbyProductId(["user_id" => $this->user->id, "product_id" => $request["product_id"]]);
            
            if(!empty($this->clientService)){

                return Controller::apiResponceError("user have service with this product", 409); 

            }

            $newItemId = $this->clientsServicesRepository->create(["user_id" => $this->user->id, "product_id" => $request["product_id"], "name" => $request["name"]])->id;
           
            if($newItemId){

                $this->clienService = $this->clientsServicesRepository->find($newItemId);

                return Controller::apiResponceSuccess($this->clienService, 200);

            }else{

                return Controller::apiResponceError("adding service error", 500); 
            }

       }

    }


}
