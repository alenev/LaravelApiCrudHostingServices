<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\Products;
use App\Models\ClientsServices;

class ClientServicesTest extends TestCase
{

    public function testApiLoginController()
    {
            
        $payload = [
            "email" => "testmail@example.com",
            "password" => "12345678"
        ];

            $response = $this->json('post', 'api/login', $payload);

            $response_content = $response->getOriginalContent();

            $statusCode = $response->getStatusCode();

                if (!empty($response_content) && empty($response_content["errors"]) && $statusCode == 200) {

                 //   print "\xA\xA testApiLoginController data: ".json_encode($response_content);

                    $response->assertStatus($statusCode);
               
                }else{

                    $message = 'test_register_and_login fail';

                    if (!empty($response_content["errors"])) {
                 
                        $message =  'test_register_and_login error: ' . $response_content["errors"];
                    }
        
                    $message = $message.' response status code: '.$statusCode;
        
                    $this->fail($message);
               
                }
    }

    

    public function testApiClientServicesAddNewController(){

         Passport::actingAs($this->testUser);

         $payload = [
            "name" => "Lorem Ipsum",
            "product_id" => 2
         ];

        $response = $this->json('POST', 'api/services/add', $payload);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (!empty($response_content) && empty($response_content["errors"]) && $statusCode == 200) {

            print "\xA\xA".'testApiClientServicesAddNewController data'.json_encode($response_content);

            $response->assertStatus($statusCode);
       
        } else {

            $message = 'testApiClientServicesAddNewController fail';

            if (!empty($response_content["errors"])) {
         
                $message =  'testApiClientServicesAddNewController error: ' . $response_content["errors"];
            }

            $message = $message.' response status code: '.$statusCode;

            $this->fail($message);
       
        } 
        
        
    }

    public function testApiClientServicesGetAllController(){

         Passport::actingAs($this->testUser);

         $payload = [
            "name" => "Lorem Ipsum",
            "product_id" => 1
         ];
        $response = $this->json('POST', 'api/services/add', $payload);

        $payload = [
            "name" => "Lorem Ipsum",
            "product_id" => 2
         ];
        $response = $this->json('POST', 'api/services/add', $payload);

        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {

            $this->fail('testApiClientServicesEditController add servise error');

        }
 
         $response = $this->json('GET', 'api/services');
 
         $response_content = $response->getOriginalContent();
 
         $statusCode = $response->getStatusCode();
 
         if (!empty($response_content) && empty($response_content["errors"]) && $statusCode == 200) {
 
             print "\xA\xA".'testApiClientServicesGetAllController data'.json_encode($response_content);
 
             $response->assertStatus($statusCode);
        
         } else {
 
             $message = 'testApiClientServicesGetAllController fail';
 
             if (!empty($response_content["errors"])) {
          
                 $message =  'testApiClientServicesGetAllController error: ' . $response_content["errors"];
             }
 
             $message = $message.' response status code: '.$statusCode;
 
             $this->fail($message);
        
         }
         
     }

     public function testApiClientServicesEditController(){

        Passport::actingAs($this->testUser);

        $payload = [
           "name" => "Lorem Ipsum",
           "product_id" => 1
        ];
        $response = $this->json('POST', 'api/services/add', $payload);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {

            $this->fail('testApiClientServicesEditController add servise error');
            
        }else{

            $id = $response_content["data"]->id;
        }

        $response = $this->json('GET', 'api/services/edit/'.$id);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (!empty($response_content) && empty($response_content["errors"]) && $statusCode == 200) {

            print "\xA\xA".'testApiClientServicesEditController data'.json_encode($response_content);

            $response->assertStatus($statusCode);
       
        } else {

            $message = 'testApiClientServicesEditController fail';

            if (!empty($response_content["errors"])) {
         
                $message =  'testApiClientServicesEditController error: ' . $response_content["errors"];
            }

            $message = $message.' response status code: '.$statusCode;

            $this->fail($message);
       
        }

     }

     public function testApiClientServicesDeleteController(){

        Passport::actingAs($this->testUser);

        $payload = [
           "name" => "Lorem Ipsum",
           "product_id" => 1
        ];
        $response = $this->json('POST', 'api/services/add', $payload);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {

            $this->fail('testApiClientServicesDeleteController add servise error');
            
        }else{

            $id = $response_content["data"]->id;
        }

        $response = $this->json('GET', 'api/services/delete/'.$id);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (!empty($response_content) && empty($response_content["errors"]) && $statusCode == 200) {

            print "\xA\xA".'testApiClientServicesDeleteController delete success';

            $response->assertStatus($statusCode);
       
        } else {

            $message = 'testApiClientServicesDeleteController fail';

            if (!empty($response_content["errors"])) {
         
                $message =  'testApiClientServicesDeleteController error: ' . $response_content["errors"];
            }

            $message = $message.' response status code: '.$statusCode;

            $this->fail($message);
       
        }

     }

     public function testApiClientServiceUpDownGradeController(){

        Passport::actingAs($this->testUser);

        $payload = [
           "name" => "Lorem Ipsum",
           "product_id" => 2
        ];
        $response = $this->json('POST', 'api/services/add', $payload);

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();

        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {

            $this->fail('testApiClientServiceUpDownGradeController add servise error');
            
        }else{

            $id = $response_content["data"]->id;
        }

        $errors = 0;
        
        // test upgrade part
        $response = $this->json('POST', 'api/services/upgrade/'.$id.'/1');

        $statusCode = $response->getStatusCode();

        if($statusCode != 406){

            $errors++;

            print "\xA\xA".'testApiClientServiceUpDownGradeController upgrage validation error, status code '.$statusCode;

        }

        $response = $this->json('POST', 'api/services/upgrade/'.$id.'/2');

        $statusCode = $response->getStatusCode();

        if($statusCode != 409){

            $errors++;
            
            print "\xA\xA".'testApiClientServiceUpDownGradeController upgrage validation error, status code '.$statusCode;

        }

        $response = $this->json('POST', 'api/services/upgrade/'.$id.'/3');

        $statusCode = $response->getStatusCode();

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();


        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {


            $message = 'testApiClientServiceUpDownGradeController upgrade fail';

            if (!empty($response_content["errors"])) {
         
                $message =  'testApiClientServiceUpDownGradeController upgrade error: ' . $response_content["errors"];
            }

            $message = $message.' response status code: '.$statusCode;

            $this->fail($message);

            $errors++;
            
       
        }


        // test downgrade part
        $response = $this->json('POST', 'api/services/downgrade/'.$id.'/4');

        $statusCode = $response->getStatusCode();

        if($statusCode != 406){

            $errors++;
            
            print "\xA\xA".'testApiClientServiceUpDownGradeController downgrade validation error, status code '.$statusCode;

        }

        $response = $this->json('POST', 'api/services/downgrade/'.$id.'/3');

        $statusCode = $response->getStatusCode();

        if($statusCode != 409){

            $errors++;
            
            print "\xA\xA".'testApiClientServiceUpDownGradeController downgrade validation error, status code '.$statusCode;

        }

        $response = $this->json('POST', 'api/services/downgrade/'.$id.'/2');

        $statusCode = $response->getStatusCode();

        $response_content = $response->getOriginalContent();

        $statusCode = $response->getStatusCode();


        if (empty($response_content) && !empty($response_content["errors"]) && $statusCode != 200) {

            $message = 'testApiClientServiceUpDownGradeController downgrade fail';

            if (!empty($response_content["errors"])) {
         
                $message =  'testApiClientServiceUpDownGradeController downgrade error: ' . $response_content["errors"];
            }

            $message = $message.' response status code: '.$statusCode;

            $this->fail($message);

            $errors++;      
       
        }

        if(empty($errors)){

            print "\xA\xA".'testApiClientServiceUpDownGradeController upgrage and downgrade is success';

            $response->assertStatus($statusCode);

        }else{

            $message = 'testApiClientServiceUpDownGradeController upgrage and downgrade fail';

            $this->fail($message);

        }

     }

     
 
}
