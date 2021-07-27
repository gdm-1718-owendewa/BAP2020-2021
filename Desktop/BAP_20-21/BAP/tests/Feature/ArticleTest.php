<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_article_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/article/create/submit', $this->data());
        $this->assertCount(1, Article::all());
    }
    /** @test */
    public function a_title_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/article/create/submit', array_merge($this->data(), ['title' => '']));
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Article::all());
    }
    /** @test */
    public function a_title_is_max_200_char()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/article/create/submit', array_merge($this->data(), ['title' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']));
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Article::all());
    }
    /** @test */
    public function a_content_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/article/create/submit', array_merge($this->data(), ['inhoud' => '']));
        $response->assertSessionHasErrors('inhoud');
        $this->assertCount(0, Article::all());
    }
     /** @test */
     public function a_content_is_min_300()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/article/create/submit', array_merge($this->data(), ['inhoud' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']));
         $response->assertSessionHasErrors('inhoud');
         $this->assertCount(0, Article::all());
     }
     /** @test */
     public function an_image_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/article/create/submit', array_merge($this->data(), ['banner-image' => '']));
         $response->assertSessionHasErrors('banner-image');
         $this->assertCount(0, Article::all());
     }

    /** @test */
    public function an_article_can_be_edited_through_the_form()
    {
        $this->withoutExceptionHandling();
        $user = $this->actingAsUserWithReturn();
        $article = $this->createArticle();
        $response = $this->patch('/article/edit/'.$article->id.'/submit', [
            'title' => 'Article title edit',
            'inhoud' => $article->content,
        ]);
        $response->assertRedirect('/article/article-detail/'.$article->id);
    }
    
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function createArticle(){
        $article = Article::factory()->create();
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/articles/'.$article->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $article;
    }
    private function createArticleWithUser($user){
        $article = Article::factory()->create(['author_id' => $user->id]);
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/articles/'.$article->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $article;
    }
    private function data(){
        return [
            'title' => 'Article title',
            'inhoud' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
            'banner-image' => UploadedFile::fake()->image('avatar.jpg'),
           
        ];
    }
    private function editdata(){
        return [
            'title' => 'Article title',
            'inhoud' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
           
        ];
    }
}
