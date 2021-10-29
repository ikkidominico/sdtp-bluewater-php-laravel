<?php

namespace Tests\Feature\Operator;

use App\Models\Operator;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OperatorTest extends TestCase
{

    use WithFaker;

    public function test_store_operator() 
    {
        $data = [
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'name' => $this->faker->name()
        ];
        $response = $this->json('POST', route('operators.store'), $data);
        $response->assertStatus(201);
    }

    public function test_get_operators()
    {
        $response = $this->json('GET', route('operators.index'));
        $response->assertStatus(200);
    }

    public function test_get_operator()
    {
        $cpf = $this->faker->numerify('###.###.###-##');
        $data = [
            'cpf' => $cpf,
            'name' => $this->faker->name()
        ];
        $response = $this->json('POST', route('operators.store'), $data);
        $operator = Operator::select()->where('cpf', $cpf)->first();
        $response = $this->get('api/operators/'.$operator->id);
        $response->assertStatus(200);
    }

    public function test_update_operator()
    {
        $cpf = $this->faker->numerify('###.###.###-##');
        $before = [
            'cpf' => $cpf,
            'name' => $this->faker->name()
        ];
        $response = $this->json('POST', route('operators.store'), $before);
        $operator = Operator::select()->where('cpf', $cpf)->first();
        $after = [
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'name' => $this->faker->name()
        ];
        $response = $this->json('PUT', url('api/operators/'.$operator->id), $after);
        $response->assertStatus(200);
    }

    public function test_delete_operator()
    {
        $cpf = $this->faker->numerify('###.###.###-##');
        $before = [
            'cpf' => $cpf,
            'name' => $this->faker->name()
        ];
        $response = $this->json('POST', route('operators.store'), $before);
        $operator = Operator::select()->where('cpf', $cpf)->first();
        $response = $this->delete('api/operators/'.$operator->id);
        $response->assertStatus(200);
    }

}
