<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Auth::user()->words()->get();
        return view('words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'deutsch' => 'required',
            'englisch' => 'required',
        ]);

        Auth::user()->words()->create($request->all());

        return redirect()->route('words.index')
                        ->with('success','Word created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        return view('words.show',compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        return view('words.edit',compact('word'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $request->validate([
            'deutsch' => 'required',
            'englisch' => 'required',
        ]);

        $word->update($request->all());

        return redirect()->route('words.index')
                        ->with('success','Word updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();

        return redirect()->route('words.index')
                        ->with('success','Word deleted successfully');
    }
    /**
     * Handle the training answer submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAnswer(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'word_id' => 'required|exists:words,id',
        ]);

        $word = Word::find($request->word_id);
        if (!$word) {
            return response()->json([
                'correct' => false,
                'newScore' => null,
                'correctAnswer' => null,
            ], 404);
        }

        $correct = strtolower($request->answer) === strtolower($word->englisch);

        if ($correct) {
            Auth::user()->increment('score');
            $newScore = Auth::user()->score;
        }

        return response()->json([
            'correct' => $correct,
            'newScore' => $correct ? Auth::user()->score : null,
            'correctAnswer' => $correct ? null : $word->englisch,
        ]);
    }

    /**
     * Load the next word for training.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function nextWord()
    {
        $word = Auth::user()->words()->inRandomOrder()->first();

        return response()->json([
            'word' => $word,
        ]);
    }
    /**
     * Display the training view.
     *
     * @return \Illuminate\Http\Response
     */
    public function training()
    {
        return view('training.index');
    }
}