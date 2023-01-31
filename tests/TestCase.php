<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    private Generator $faker;
    public $testUser;
    public function setUp():void 
    {
        parent::setUp();
        $this->faker = Factory::create();
        Artisan::call('migrate:refresh');
        Artisan::call('passport:install');
        $this->testUser = User::factory()->create([
            "name" => "testname",
            "email" => "testmail@example.com",
            "password" => Hash::make("12345678")
        ]);
    }
}
