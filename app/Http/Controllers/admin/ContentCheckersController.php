<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestrictWord;
use Illuminate\Pagination\Paginator;



class ContentCheckersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewCheckerForm()
    {
        $words = RestrictWord::paginate(5); // 5 words per page

        return view('administrator.contentChecker', ['words' => $words]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.contentCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'word_name'             => 'required|max:50',
        ]);

        $latestWord = RestrictWord::latest('word_id')->first();
        $lastWordId = $latestWord ? $latestWord->word_id : 'RW0000';
        $wordId = 'RW' . str_pad((int) substr($lastWordId, 2) + 1, 4, '0', STR_PAD_LEFT);

        $administratorId = auth()->guard('administrator')->user()->administrator_id;

        RestrictWord::create([
            'word_id'               => $wordId,
            'word_name'             => $request->word_name,
            'administrator_id'      => $administratorId
        ]);

        return redirect()->route('viewCheckerForm')->with('info', 'Done adding a new restricted word!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $word = RestrictWord::findOrFail($id);
        return view('administrator.contentEdit', ['word' => $word]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'word_name'             => 'required|max:50',
        ]);

        $word = RestrictWord::findOrFail($id);


        $word->update([
            'word_name'             => $request->word_name,
        ]);

        return redirect()->route('viewCheckerForm')->with('info', 'Done updateing the restricted word!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $word = RestrictWord::findOrFail($id);
        $word->delete();
        return redirect()->route('viewCheckerForm')->with('info', 'The selected word deleted successfully.');
    }
}
