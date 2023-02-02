<?php

namespace App\Http\Controllers\Api\ClientsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClientsServicesRepositoryEloquent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ClientServicesDeleteController extends Controller
{
    
    private $clientsServicesRepository;
    private $user;
    private $clientService;

    public function __construct(){

        $this->clientsServicesRepository = new ClientsServicesRepositoryEloquent();
        
    }

    public function delete($id)
    {
            $this->user = Auth::user();
            
            $this->clientService = $this->clientsServicesRepository->clientServiceShowById(["user_id" => $this->user->id, "id" => intval($id)]);
            
            if(!empty($this->clientService)){

                $this->clientsServicesRepository->delete($id);

                return Controller::apiResponceSuccess("user service delete", 200);

            }else{

                return Controller::apiResponceError("user service not found", 404);

            }
        
    }

}