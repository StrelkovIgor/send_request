<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;
use App\Models\Request;

class RequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function good_send_request_validate_data()
    {
        list($createRequest, $fllable) = $this->createRequest();

        $response = $this->post(route('send_request'), $createRequest);

        $response->assertStatus(200);

        $lastRequest = Request::orderBy('id', 'DESC')->first();

        $this->assertNotEquals($lastRequest, null);

        $this->assertEquals($createRequest, $lastRequest->only($fllable));
    }

    /**
     * @test
     */
    public function good_send_request_data_not_valid()
    {
        list($createRequest, $fllable) = $this->createRequest();

        $createRequest['email'] = 'not_email';
        $createRequest['name'] = null;
        $createRequest['message'] = null;

        $response = $this->post(route('send_request'), $createRequest, ['Accept' => 'application/json']);

        $response->assertStatus(422);

        $responseData = $response->json();

        //bad email
        $this->assertNotEquals(Arr::get($response, 'errors.email', null), null);

        //bad name
        $this->assertNotEquals(Arr::get($response, 'errors.name', null), null);

        //bad message
        $this->assertNotEquals(Arr::get($response, 'errors.message', null), null);


    }

    private function createRequest(): array
    {
        $createRequest = Request::factory()->state(function(){
            return [
                'status' => Request::STATUS_ACTIVE,
                'comment' => null
            ];
        })->make();

        $fllable = $createRequest->getFillable();

        $createRequest = $createRequest->only($fllable);

        return [$createRequest, $fllable];
    }
}
