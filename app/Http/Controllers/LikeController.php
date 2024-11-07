<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($note_id): \Illuminate\Http\JsonResponse
    {
        $note = Note::find($note_id);
        $like = $note->likes()->where('user_id', Auth::id())->first();
        if(!$like){
            $note->likes()->attach(Auth::id());
        }
        else {
            $note->likes()->detach(Auth::id());
        }
        return response()->json(['message' => 'Liked successfully ', 'likesCount' => $note->likes()->count()]);
    }
    public function unlike($note_id): \Illuminate\Http\JsonResponse
    {
        $note = Note::find($note_id);
        $note->likes()->detach(Auth::id());
        return response()->json(['message' => 'Unliked successfully', 'likesCount' => $note->likes()->count()]);
    }
}
