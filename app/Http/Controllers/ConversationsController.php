<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function index()
    {
        $user = User::find(1);// Auth::user();
        return $user->conversations()->paginate();
    }

    public function show(Conversation $conversation){
        return $conversation()->load('participants');
    }

    public function addParticipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'int', 'exists:users,id'],
        ]);

        $conversation->participants()->attach($request->post('user_id'), [
            'joined_at' => Carbon::now(),
        ]);
    }

    public function removeParticipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'int', 'exists:users,id'],
        ]);

        $conversation->participants()->detach($request->post('user_id'));
    }
}
