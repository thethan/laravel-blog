<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    use DatabaseTransactions;

    public $posts, $tags;

    /**
     * @return array
     */
    public function setUp()
    {
        parent::setUp();


        $this->posts = factory(App\Post::class, 10)->create();

        $this->tags = factory(App\Tag::class, 3)->create();

        foreach ($this->posts as $key => $post) {
            $post->tags()->save($this->tags->first());
            if($key % 2 === 0){
                $post->tags()->save($this->tags->all()[1]);
            }
            if($key % 3 === 0){
                $post->tags()->save($this->tags->all()[2]);
            }
        }
    }
    /**
     * @test
     */
    public function post_tags()
    {
        $tag1 = $this->tags->first();
        $tag2 = $this->tags->all()[1];
        $tag3 = $this->tags->all()[2];

        foreach ($this->posts as $key => $post){
            $this->assertEquals($tag1->name, $post->tags->first()->name);
            $this->assertEquals($tag1->slug, $post->tags->first()->slug);
            if($key % 2 === 0){
                $this->assertEquals($tag2->name, $post->tags->all()[1]->name);
                $this->assertEquals($tag2->slug, $post->tags->all()[1]->slug);
            }
            if($key % 3 === 0){
                $this->assertEquals($tag3->name, $post->tags->last()->name);
                $this->assertEquals($tag3->slug, $post->tags->last()->slug);
            }

            if($key % 3 === 0 && $key % 2 === 0) {
                $this->assertEquals(3, $post->tags->count());
            }
        }
    }
}