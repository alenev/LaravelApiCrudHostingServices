<?php

namespace App\Http\Controllers\Api\ClientsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ClientsServicesRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ClientServicesEditController extends Controller
{
    
    private ClientsServicesRepositoryInterface $clientsServicesRepository;
    private $user;
    private $clientService;

    public function __construct(ClientsServicesRepositoryInterface $clientsServicesRepository){
        
        $this->clientsServicesRepository = $clientsServicesRepository;
    }


 public function edit($id):JsonResponse
    {
        $this->user = Auth::user();

        $this->clientService = $this->clientsServicesRepository->clientServiceShowById(["user_id" => $this->user->id, "id" => intval($id)]);

        return Controller::apiResponceSuccess([$this->clientService], 200);
    }

}