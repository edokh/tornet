<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function testCreateCategory()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/categories/create');
        $response->assertStatus(200);

        $postData = [
            'title' => 'Test Title',
            'image' =>  'test.jpg',
        ];

        $response = $this->post('/categories', $postData);
        $response->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'title' => 'Test Title',
        ]);
    }

    public function testGetAllCategories()
    {
        // Create a user
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('categories.index'));
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories');

        $categories = $response->viewData('categories');
        $this->assertIsIterable($categories);

        foreach ($categories as $category) {
            $this->assertNotNull($category->title);
            $this->assertNotNull($category->created_at);
            $this->assertNotNull($category->updated_at);
            $this->assertNull($category->deleted_at);
        }
    }


    public function testGetCategory()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a category post by the user
        $post =
            Category::create(
                [
                    'title' => 'Test Title',
                    'image' =>  'test.jpg',
                ]
            );

        // Send a GET request to the show method with the ID of the category post
        $response = $this->actingAs($user)->get(route('categories.show', $post->id));

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the category post title is displayed in the response
        $response->assertSee($post->title);

        // Assert that the category post content is displayed in the response
        $response->assertSee($post->content);
    }


    public function testCategoryUpdate()
    {
        // create a new user
        $user = User::factory()->create();

        // create a new category
        $category = Category::first();

        // simulate a logged-in user
        $this->actingAs($user);

        // send a PUT request to update the category
        $response = $this->put(route('categories.update', $category->id), [
            'title' => 'My Updated Category1',
        ]);

        // assert that the response was successful
        $response->assertStatus(302);

        // assert that the category   was updated in the database
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'title' => 'My Updated Category1',
        ]);
    }
    public function testSoftDeleteCategory()
    {
        // Create a test user
        $user = User::factory()->create();

        // Create a test category category
        $category = Category::create(
            [
                'title' => 'Test Title',
                'image' =>  'test.jpg',
            ]
        );

        // Login the user
        $this->actingAs($user);

        // Soft delete the category category
        $response = $this->delete(route('categories.destroy', $category));

        // Check if the category category was soft deleted
        $this->assertSoftDeleted($category);

        // Check if the response status is 302 (redirect)
        $response->assertStatus(302);

        // Check if the user is redirected to the category categories index page
        $response->assertRedirect(route('categories.index'));
    }
}
