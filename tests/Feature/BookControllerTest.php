<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Tests\TestCase;

class BookControllerTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_book_user_index_page_rendering()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $user->assignRole('userRole');

        $response = $this->get('/books');

        $response->assertStatus(200);
    }


    public function test_the_book_admin_index_page_rendering()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $user->assignRole('adminRole');

        $response = $this->get('/admin/books');

        $response->assertStatus(200);
    }



    public function test_the_book_fetching_from_the_api_rendering()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }



    public function test_if_admin_can_create_books()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $user->assignRole('adminRole');

        $response = $this->post('/admin/books', [
            'book_title' => 'wasaka tonge',
            'book' => '',
            'thumbnail' => '',
        ]);

        $response->assertStatus(200);
    }


}
