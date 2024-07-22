<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

it('should call the welcome page successfully', function () {
    /** @var TestCase $this */
    $response = $this->get('/');

    expect($response->getStatusCode())
        ->toBe(Response::HTTP_OK);
});

it('should access to the database successfully', function () {
    User::factory()->create();

    /** @var TestCase $this */
    $this->assertDatabaseCount('users', 1);
});
