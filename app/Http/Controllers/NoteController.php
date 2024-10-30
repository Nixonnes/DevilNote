<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index', [
            'notes' => auth()->user()->notes()->get()
        ]);
    }
    public function create()
    {
        return view('notes.create', [
            'user_id' => auth()->user()->getAuthIdentifier()
        ]);
    }
    public function store(NoteRequest $request)
    {
        $validated = $request->validated();
        Note::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => $validated['title'],
            'content' => $validated['content']
                ]
            );
    }
    public function show(Note $note): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('notes.show', [
            'note' => $note
        ]);
    }
}
