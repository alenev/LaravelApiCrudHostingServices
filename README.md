# LaravelApiCrudHostingServices

### CRUD API points set on Laravel 9 for hosting user services 

## API points

- POST `/api/login` Public access. Login user. Request data with test user {"email" : "alex@mail.com", "password" : "123456"}
- POST `/api/services/add` Auth access. Add new user hosting service with hosting product id.  Request data format 
{"name": "Lorem Ipsum", "product_id" : 3}
- GET `/api/services` Auth access. Get logged-in user list of services. 
- GET `/api/services/edit/{id}` Auth access. Get logged-in user service data for edit. 
- GET `/api/services/delete/{id}` Auth access. Delete logged-in user service.
- POST `/api/services/upgrade/{id}/{product_id}` Auth access. Set to logged-in user service other product with high params.
- POST `/api/services/downgrade/{id}/{product_id}` Auth access. Set to logged-in user service other product with low params.

All auth access API points needs Laravel Passport [Bearer access token](https://learning.postman.com/docs/sending-requests/authorization/#bearer-token) for authorization.  

In migrations exist data for 'products' and 'users'.

Hosting products structure:

![Hosting products structure](http://laravelapicrudhostingservices.alenev.name/products.png)

- https://www.postman.com/aldenpostman/workspace/laravelapicrudhostingservices/request/11745573-08104080-e3e2-4c64-97e5-00fa4cf8d91e
- https://documenter.getpostman.com/view/11745573/2s935iv6jf

In API points /upgrade user can change product id only on high id and in point /downgrade product id can be changed only on low id. 

## Install

`composer install`

`php artisan migrate`

`composer require laravel/passport`

`php artisan passport:install`

`php artisan passport:keys`

## Test data
- In migrations for DB tables 'products' and 'users' exist test data
- PHPUnit-test for CRUD controllers (app\Http\Controllers\Api\ClientsServices) in tests\Unit\Api\ClientServicesTest.php

