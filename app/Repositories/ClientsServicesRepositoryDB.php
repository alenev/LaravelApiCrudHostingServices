<?php 

namespace App\Repositories;

use App\Models\ClientsServices;
use App\Repositories\Interfaces\ClientsServicesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClientsServicesRepositoryDB implements ClientsServicesRepositoryInterface
{

    public function all($user_id)
    {
        return DB::select('select * from clients_services');
       
    }

    public function create(array $data)
    {
       
    }

    public function update(array $data, $id)
    {
        
    }

    public function delete($id)
    {
        
    }

    public function find($id)
    {
          
    }

    public function clientServiceExistbyProductId(array $data){

    }

    public function clientServiceShowById(array $data){
        
    }
}