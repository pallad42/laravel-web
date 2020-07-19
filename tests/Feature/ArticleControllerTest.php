<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function createUser()
    {
        $response = $this->post(route('register'), [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin_admin',
            'password_confirmation' => 'admin_admin'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('home.index'));
        $this->assertCount(1, User::all());

        return User::whereName('admin')->firstOrFail();
    }

    public function createArticle()
    {
        $user = $this->createUser();
        $data = $this->articleData();

        $response = $this->actingAs($user)->post(route('articles.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('articles.index'));
        $this->assertCount(1, Article::all());

        return Article::first();
    }

    public function articleData()
    {
        return [
            'title' => 'Example title with 15 characters',
            'content' => 'Example content'
        ];
    }

    /** @test */
    public function store_with_valid_data_by_authenticated_user()
    {
        $this->withoutExceptionHandling();

        $this->createArticle();

        $this->assertCount(1, Article::all());
    }

    /** @test */
    public function store_with_invalid_data_by_authenticated_user()
    {
        $this->withExceptionHandling();

        $authUser = $this->createUser();

        $data = [
            'title' => 'Too short'
        ];

        $response = $this->actingAs($authUser)
            ->post(route('articles.store'), $data);

        $response->assertSessionHasErrors(['title', 'content']);
        $this->assertCount(0, Article::all());
    }

    /** @test */
    public function store_by_unauthenticated_user()
    {
        $response = $this->post(route('articles.store'), $this->articleData());

        $response->assertRedirect(route('login'));
        $this->assertCount(0, Article::all());
    }

    /** @test */
    public function index_by_unauthenticated_user()
    {
        $response = $this->get(route('articles.index'));
        $response->assertOk();
    }

    /** @test */
    public function update_with_valid_data_by_authenticated_user()
    {
        $this->withoutExceptionHandling();

        $authUser = $this->createUser();

        $article = $this->createArticle();

        $data = $article->toArray();

        $data['title'] = 'New valid title';

        $response = $this->actingAs($authUser)
            ->put(route('articles.update', ['article' => $article]), $data);

        $response->assertRedirect(route('articles.show', ['article' => $article]));
    }
}
