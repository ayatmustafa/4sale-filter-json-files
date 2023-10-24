<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_get_users_from_multiple_providers_without_filtration_a_successful_response(): void
    {
        $response = $this->get('api/v1/users/testing');

        $response->assertStatus(200)
            ->assertOk()
            ->assertJsonStructure([
                "Status",
                "Count" ,
                "Data" => [
                    '*' => ['Id', 'Email', 'Currency', 'Balance', 'StatusCode', 'CreatedAt']
                ],
            ]);
    }

    public function test_get_users_from_multiple_providers_with_statusCode_filtration_a_successful_response(): void
    {
        $response = $this->get('api/v1/users/testing?statusCode=authorised');

        $response->assertStatus(200)
            ->assertOk()
            ->assertJsonStructure([
                "Status",
                "Count" ,
                "Data" => [
                    '*' => ['Id', 'Email', 'Currency', 'Balance', 'StatusCode', 'CreatedAt']
                ],
            ]);
    }

    public function test_get_users_from_specific_providers_with_statusCode_filtration_with_empty_a_successful_response(): void
    {
        $response = $this->get('api/v1/users/testing?provider=DataProviderX&statusCode=refunded');

        $response->assertStatus(200)
            ->assertOk()
            ->assertJsonStructure([
                "Status",
                "Count",
                "Data" => [
                    '*' => ['Id', 'Email', 'Currency', 'Balance', 'StatusCode', 'CreatedAt']
                ],
            ])->assertJson([
            "Status" => true,
            "Count" => 0,
        ]);
    }

    public function test_get_users_from_specific_providers_with_max_balance_filtration_with_a_successful_response(): void
    {
        $response = $this->get('api/v1/users/testing?provider=DataProviderX&balanceMax=100');

        $response->assertStatus(200)
            ->assertOk()
            ->assertJsonStructure([
                "Status",
                "Count",
                "Data" => [
                    '*' => ['Id', 'Email', 'Currency', 'Balance', 'StatusCode', 'CreatedAt']
                ],
            ]);
    }

}
