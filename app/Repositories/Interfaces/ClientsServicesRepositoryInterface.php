<?php

namespace App\Repositories\Interfaces;

interface ClientsServicesRepositoryInterface {
    public function all($user_id);
    public function create(array  $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find($id);
    public function clientServiceExistbyProductId(array $data);
    public function clientServiceShowById(array $data);
}