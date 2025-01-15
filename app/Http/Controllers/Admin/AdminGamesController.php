<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminGamesController extends Controller
{
    public function indexGame(){
        $data = [];
        $data['games'] = Game::latest()->get();
        return view('admin.games.games', $data);
    }

    public function createGame(){
        return view('admin.games.create-games');
    }

    public function storeGame(Request $request){
        $this->validate($request, [
            'game_name' => 'required|max:255|unique:games,game_name',
            'member' => 'required|integer|max:10',
            'board_bg_color' => 'required',
            'board_color' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'game_avater' => 'required|mimes:jpeg,png,jpg'
        ]);
        if ($request->hasfile('game_avater'))
        {
            $file = $request->file('game_avater');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('games/', $filename);
        } 
        Game::create([
            'game_name' => $request->game_name,
            'member' => $request->member,
            'board_bg_color' => $request->board_bg_color,
            'board_color' => $request->board_color,
            'status' => $request->status,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'game_avater'=>$filename
        ]);
        notify()->success('Successfully Saved', 'Success');
        return redirect()->route('admin.game-list');
    }

    public function editGame($id){
        $data = [];
        $data['game'] = Game::findOrFail($id);
        return view('admin.games.create-games', $data);
    }


    public function updateGame(Request $request, $id){
        $game = Game::findOrFail($id);
        $this->validate($request, [
            'game_name' => 'required|max:255',
            'member' => 'required|integer|max:10',
            'board_bg_color' => 'required',
            'board_color' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'game_avater' => 'mimes:jpeg,png,jpg'
        ]);
        if ($request->hasfile('game_avater'))
        {
            $game_avatar_path = public_path('games/' . $game->game_avater);
            if (File::exists($game_avatar_path)) {
                File::delete($game_avatar_path);
            }
            $file = $request->file('game_avater');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('games/', $filename);
        } else {
            $filename = $game->game_avater;
        }
        $game->update([
            'game_name' => $request->game_name,
            'member' => $request->member,
            'board_bg_color' => $request->board_bg_color,
            'board_color' => $request->board_color,
            'status' => $request->status,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'game_avater'=>$filename
        ]);
        notify()->success('Successfully Saved', 'Success');
        return redirect()->route('admin.game-list');
    }

    public function deleteGame($id){
        $game = Game::findOrFail($id);
        $game->delete();
        notify()->success('Games Successfully Deleted!', 'Success');
        return back();
    }
}
