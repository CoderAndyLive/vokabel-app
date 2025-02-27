<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Word;
use App\Models\User;

class WordTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * Test if the words index page returns a successful response.
     *
     * @return void
     */
    public function test_words_index_page_returns_successful_response()
    {
        $response = $this->get('/words');

        $response->assertStatus(200);
    }

    /**
     * Test if a word can be created.
     *
     * @return void
     */
    public function test_word_can_be_created()
    {
        $response = $this->post('/words', [
            'deutsch' => 'Haus',
            'englisch' => 'House',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('words', [
            'deutsch' => 'Haus',
            'englisch' => 'House',
        ]);
    }

    /**
     * Test if a word can be updated.
     *
     * @return void
     */
    public function test_word_can_be_updated()
    {
        $word = Word::factory()->create();
    
        $response = $this->put("/words/{$word->id}", [
            'deutsch' => 'Baum',
            'englisch' => 'Tree',
        ]);
    
        $response->assertStatus(200); 
        $response->assertJson(['success' => true]); 
    
        $this->assertDatabaseHas('words', [
            'id' => $word->id,
            'deutsch' => 'Baum',
            'englisch' => 'Tree',
        ]);
    }

    /**
     * Test if a word can be deleted.
     *
     * @return void
     */
    public function test_word_can_be_deleted()
    {
        $word = Word::factory()->create();

        $response = $this->delete("/words/{$word->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('words', [
            'id' => $word->id,
        ]);
    }
}