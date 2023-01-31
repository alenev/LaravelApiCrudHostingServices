<?php

namespace App\Http\Controllers\Api\ClientsServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ClientsServicesRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ClientServiceUpDownGradeController extends Controller
{
    private ClientsServicesRepositoryInterface $clientsServicesRepository;
    private $user;
    private $event;
    private $clientService;

    public function __construct(ClientsServicesRepositoryInterface $clientsServicesRepository){
        
        $this->clientsServicesRepository = $clientsServicesRepository;
    }

    public function upDownGrade($id, $product_id):JsonResponse
    {

        if(strpos(\Request::url(), 'upgrade') > 0){

            $this->event = 'upgrade';

        }else if(strpos(\Request::url(), 'downgrade') > 0){

            $this->event = 'downgrade';

        }

        $this->user = Auth::user();
            
        $this->clientService = $this->clientsServicesRepository->clientServiceShowById(["user_id" => $this->user->id, "id" => intval($id)]);
        
        if(empty($this->clientService)){

            return Controller::apiResponceError("user service not found", 404);

        }else{
            
            if($this->event == 'upgrade' && (intval($this->clientService->product_id) > intval($product_id))){

                return Controller::apiResponceError("this current user service have more high product", 406);

            }else if($this->event == 'downgrade' && (intval($this->clientService->product_id) < intval($product_id))){

                return Controller::apiResponceError("this current user service have more low product", 406);

            }else if(intval($this->clientService->product_id) == intval($product_id)){  

                return Controller::apiResponceError("user have service with this product", 409);

            }else{

                if(!$this->clientsServicesRepository->update(["product_id" => $product_id], $id)){

                    return Controller::apiResponceError("upgrade user service error", 500); 

                }

                $this->clientService = $this->clientsServicesRepository->find($id);

                return Controller::apiResponceSuccess($this->clientService, 200);

            }

        }
  
    }
}
