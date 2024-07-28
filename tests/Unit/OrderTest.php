<?php

namespace Tests\Unit;


use Tests\TestCase; //this
use App\services\OrderSevice;


class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_ping()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
	}


    public function test_checkFormat_name_contain_not_english()
    {
        $order = [
            "id" => "A0000001",
            "name" => "MlodyHoliday我Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "21.22",
            "currency" =>"USD"
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(400)
            ->assertJsonStructure(['error'])
            ->assertJsonPath('error','Name contains non-English characters');
    }


    public function test_checkFormat_success()
    {
        $order = [
            "id" => "A0000001",
            "name" => "Mlody Holiday Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "200",
            "currency" =>"TWD"
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(200);
    }


    public function test_checkFormat_name_first_must_be_capitalized()
    {
        $order = [
            "id" => "A0000001",
            "name" => "nlody Holiday Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "21.22",
            "currency" =>"USD"
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(400)
            ->assertJsonStructure(['error'])
            ->assertJsonPath('error','Name is not capitalized');
    }


    public function test_checkFormat_name_price_is_over_2000()
    {
        $order = [
            "id" => "A0000001",
            "name" => "Nlody Holiday Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "2001",
            "currency" =>"TWD",
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(400)
            ->assertJsonStructure(['error'])
            ->assertJsonPath('error','Price is over 2000');
    }


    public function test_checkFormat_currency()
    {
        $order = [
            "id" => "A0000001",
            "name" => "Nlody Holiday Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "200",
            "currency" =>"THB",
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(400)
            ->assertJsonStructure(['error'])
            ->assertJsonPath('error','Currency format is wrong');
    }


    public function test_checkFormat_currency_mul_31_when_usd()
    {
        $order = [
            "id" => "A0000001",
            "name" => "Nlody Holiday Inn",
            "address" => [
               "district" => "da-an-district",
               "city" => "22222",
               "street" => "333333"
            ],
            "price" => "200",
            "currency" =>"USD",
        ];

        $response = $this->post('/api/order',$order);

        $response->assertStatus(200)
            ->assertJsonStructure(['currency','price'])
            ->assertJsonPath('currency','TWD')
            ->assertJsonPath('price','6200');
     }
 }

