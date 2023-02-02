<?php

namespace App\Http\Controllers\Api\ClientsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClientsServicesRepositoryDB;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ServiceAddRequest;
use Illuminate\Support\Facades\Auth;

class ClientServicesGetAllController extends Controller
{
    
    private $clientsServicesRepository;
    private $user;
    private $clientServices;
    private $clienNewService;
    private $clientService;

    public function __construct(){

        $this->clientsServicesRepository = new ClientsServicesRepositoryDB();
        
    }

    public function getAll():JsonResponse
    {

        $this->user = Auth::user();
  
        $this->clientServices = $this->clientsServicesRepository->all($this->user->id);

        return Controller::apiResponceSuccess([$this->clientServices], 200);
    }




}
