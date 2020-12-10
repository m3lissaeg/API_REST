<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use SebastianBergmann\FileIterator\Factory;

class StudentTest extends TestCase
{
    // public function testExample()
    // {
    //     $response = $this->get('/');
    //     $response->assertStatus(200);
    // }

    public function testsStudentsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20',
        ];

        $this->json('POST', '/api/students', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'name' => 'Sara', 'lastName' => 'Smith', 'age' => '20']);
}

    public function testsStudentsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $student = factory(Student::class)->create([
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20',
        ]);

        $payload = [
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20',
        ];

        $response = $this->json('PUT', '/api/students/' . $student->id, $payload, $headers)
        ->assertStatus(200)
        ->assertJson(['id' => 1, 'name' => 'Sara', 'lastName' => 'Smith', 'age' => '20']);
}

    public function testsStudentsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $student = factory(Student::class)->create([
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20',
        ]);

        $this->json('DELETE', '/api/students/' . $student->id, [], $headers)
            ->assertStatus(204);
    }

    public function testsStudentsAreListedCorrectly()
    {
        factory(Student::class)->create([
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20'
        ]);

        factory(Student::class)->create([
            'name' => 'Sara',
            'lastName' => 'Smith',
            'age' => '20'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/students', [], $headers)
        ->assertStatus(200)
        ->assertJson([
            [ 'name' => 'Sara', 'lastName' => 'Smith', 'age' => '20' ],
            [ 'name' => 'Sara', 'lastName' => 'Smith', 'age' => '20' ]
        ])
        ->assertJsonStructure([
            '*' => ['id', 'lastName', 'name', 'age' ,'created_at', 'updated_at'],
        ]);
    }
}
