<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Word;

class WordTest extends TestCase
{
    /**
     * Test if a word model can be instantiated.
     *
     * @return void
     */
    public function test_word_model_can_be_instantiated()
    {
        $word = new Word([
            'deutsch' => 'Haus',
            'englisch' => 'House',
        ]);

        $this->assertEquals('Haus', $word->deutsch);
        $this->assertEquals('House', $word->englisch);
    }
}