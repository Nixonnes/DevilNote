<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Note;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($note_id,CommentRequest $request)
    {
        $validated = $request->validated();
        $note = Note::find($note_id);
    $comment = Comment::create([
        'note_id' => $note_id,
        'user_id' => auth()->user()->getAuthIdentifier(),
        'content' => $validated['content'],
    ]);
    $comment->save();
    return redirect()->back();
    }
}
