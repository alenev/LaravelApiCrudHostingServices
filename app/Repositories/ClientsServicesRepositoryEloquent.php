<?php 

namespace App\Repositories;

use App\Models\ClientsServices;
use App\Repositories\Interfaces\ClientsServicesRepositoryInterface;

class ClientsServicesRepositoryEloquent implements ClientsServicesRepositoryInterface
{

    public function all($user_id)
    {
        return ClientsServices::where("user_id", $user_id)->get();
    }

    public function create(array $data)
    {
        return ClientsServices::create($data);
    }

    public function update(array $data, $id)
    {
        return ClientsServices::where("id", $id)
            ->update($data);
    }

    public function delete($id)
    {
        return ClientsServices::destroy($id);
    }

    public function find($id)
    {
        return ClientsServices::find($id);     
    }

    public function clientServiceExistbyProductId(array $data){
        return ClientsServices::where([["user_id", $data["user_id"]], ["product_id", $data["product_id"]]])->first();
    }

    public function clientServiceShowById(array $data){
        return ClientsServices::where([["user_id", $data["user_id"]], ["id", $data["id"]]])->first();
    }
}