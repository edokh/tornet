<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;


class BlogTest extends TestCase
{

    public function testCreateBlog()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/blogs/create');
        $response->assertStatus(200);
        $category = Category::create(
            [
                'title' => [
                    'en' => 'Category in English',
                    'ar' => 'الفئة باللغة العربية',
                    'ku' => 'Category in Kurdish'
                ],
                'image' => 'category-image.jpg',
            ]
        );

        $postData = [
            'title_en' => 'Post in English',
            'title_ar' => 'المقال باللغة العربية',
            'title_ku' => 'Post in Kurdish',
            'content_en' => 'Post in English',
            'content_ar' => 'المقال باللغة العربية',
            'content_ku' => 'Post in Kurdish',
            'category_id' => $category->id,
            'author_id' => $user->id,
            'image' => 'image.jpg',
        ];

        $response = $this->post('/blogs', $postData);
        $response->assertRedirect(route('blogs.index'));
    }

    public function testGetAllBlogs()
    {
        // Create a user
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('blogs.index'));
        $response->assertStatus(200);
        $response->assertViewIs('blogs.index');
        $response->assertViewHas('blogs');

        $blogs = $response->viewData('blogs');
        $this->assertIsIterable($blogs);

        foreach ($blogs as $blog) {
            $this->assertNotNull($blog->title);
            $this->assertNotNull($blog->content);
            $this->assertNotNull($blog->category_id);
            $this->assertNotNull($blog->author_id);
            $this->assertNotNull($blog->created_at);
            $this->assertNotNull($blog->updated_at);
            $this->assertNull($blog->deleted_at);
        }
    }

    public function testGetBlog()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a blog post by the user
        $post =
            Blog::create(
                [
                    'title' => [
                        'en' => 'Post in English',
                        'ar' => 'المقال باللغة العربية',
                        'ku' => 'Post in Kurdish',
                    ],
                    'content' => [
                        'en' => 'Post in English',
                        'ar' => 'المقال باللغة العربية',
                        'ku' => 'Post in Kurdish',
                    ],
                    'category_id' => 1,
                    'author_id' => $user->id,
                    'image' => 'image.jpg',
                ]
            );

        // Send a GET request to the show method with the ID of the blog post
        $response = $this->actingAs($user)->get(route('blogs.show', $post->id));

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the blog post title is displayed in the response
        $response->assertSee($post->title);

        // Assert that the blog post content is displayed in the response
        $response->assertSee($post->content);
    }

    public function testBlogUpdate()
    {
        // create a new user
        $user = User::factory()->create();

        $category = Category::first();
        // create a new blog post
        $post = Blog::first();

        // simulate a logged-in user
        $this->actingAs($user);

        // send a PUT request to update the blog post
        $response = $this->put(route('blogs.update', $post->id), [
            'title_en' => 'Post in English',
            'title_ar' => 'المقال باللغة العربية',
            'title_ku' => 'Post in Kurdish',
            'content_en' => 'Post in English',
            'content_ar' => 'المقال باللغة العربية',
            'content_ku' => 'Post in Kurdish',
            'category_id' => $category->id,
            'image' => 'image.jpg',
        ]);

        // assert that the response was successful
        $response->assertStatus(302);
        $response->assertRedirect(route('blogs.index'));
    }

    public function testSoftDeleteBlog()
    {
        // Create a test user
        $user = User::factory()->create();

        // Create a test blog post
        $blog = Blog::create(
            [
                'title' => [
                    'en' => 'Post in English',
                    'ar' => 'المقال باللغة العربية',
                    'ku' => 'Post in Kurdish',
                ],
                'content' => [
                    'en' => 'Post in English',
                    'ar' => 'المقال باللغة العربية',
                    'ku' => 'Post in Kurdish',
                ],
                'category_id' => 1,
                'author_id' => $user->id,
                'image' => 'image.jpg',
            ]
        );

        // Login the user
        $this->actingAs($user);

        // Soft delete the blog post
        $response = $this->delete(route('blogs.destroy', $blog));

        // Check if the blog post was soft deleted
        $this->assertSoftDeleted($blog);

        // Check if the response status is 302 (redirect)
        $response->assertStatus(302);

        // Check if the user is redirected to the blog blogs index page
        $response->assertRedirect(route('blogs.index'));

        // Check if the flash message is displayed
        $response->assertSessionHas('success', 'Blog post deleted successfully.');
    }
    /**/
}
