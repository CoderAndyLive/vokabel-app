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
}