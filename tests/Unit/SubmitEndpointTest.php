<?php

namespace Tests\Unit;


use App\Jobs\ProcessSubmit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SubmitEndpointTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Bus::fake();
    }

    public function test_submit_creates_submission_with_valid_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message',
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Thanks for your submission!',
        ]);

        Bus::assertDispatched(ProcessSubmit::class);
    }

    public function test_submit_doesnt_create_submission_with_invalid_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message',
        ];

        foreach (['name', 'email', 'message'] as $key) {
            $invalidData = $data;
            unset($invalidData[$key]);

            $response = $this->postJson('/api/submit', $invalidData);

            $response->assertStatus(422);
            $response->assertJsonFragment([
                'message' => "The $key field is required.",
            ]);

            Bus::assertNotDispatched(ProcessSubmit::class);
        }
    }
}
