<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Comment;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index', [
            'notes' => auth()->user()->notes()->get()
        ]);
    }
    public function showUserNotes($user_id)
    {
        $user = User::find($user_id);
        return view('notes.index', [
            'notes' => $user->notes()->get(),
            'title' => 'Заметки' . ' '. $user->name
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
        try {
            $note = Note::create([
                    'user_id' => Auth::id() ?? $request['user_id'],
                    'title' => $validated['title'],
                    'content' => $validated['content']
                ]
            );
            if(!$note) {
                return redirect()->back()->withErrors(['msg' => 'Ошибка при создании заметки']);
            }
            return to_route('notes.show', ['id' => $note->id]);
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }

    }
    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $note = Note::find($id);
        $isLiked = $note->likes()->where('user_id', auth()->id())->exists();
        return view('notes.show', [
            'note' => $note,
            'isLiked' => $isLiked,
        ])->with('comments', Comment::with('user')->where('note_id', $note->id)->get());
    }
    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit', [
            'note' => $note
        ]);
    }
    public function update(NoteRequest $request, $id)
    {
        $note = Note::find($id);
        if(!Gate::allows('update-note', $note)){
            abort(403);
        }
        $validated = $request->validated();
        $note->update($validated);
        $note->save();
        return to_route('notes.show', ['id' => $note->id]);
    }
    public function destroy($id)
    {
        Note::destroy($id);
        return redirect(route('notes.index'))->with('message', 'Заметка успешно удалена');
    }
}
