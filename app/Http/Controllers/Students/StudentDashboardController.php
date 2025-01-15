<?php

namespace App\Http\Controllers\Students;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function dashboard(){
        $data = [];
        $data['games']=Game::where('status', 'on')->latest()->get();
        return view('student.dashboard', $data);
    }

    public function bookGame($id){

        $currentTime = Carbon::now('Asia/Dhaka');
        $time = $currentTime->format('H:i');

        $game = Game::findOrFail($id);
        $user_id = Auth::user()->id;
        $game_id = $game->id;

        $bookedInGame = Player::select('user_id', 'game_id')
                        ->where('user_id', $user_id)
                        ->where('game_id', $game_id)
                        ->first();

        if($bookedInGame){
            notify()->error("You already booked in $game->game_name", 'Error');
            return back();
        }else{
            $gameBookTime = Game::select('start_time', 'end_time')
                        ->where('start_time', '<=', $time)
                        ->where('end_time', '>=', $time)
                        ->first();

            if($gameBookTime){
                if($game){
                    if($game->booked_person){
                        $counter = $game->booked_person;
                        $counterUp = $counter + 1;
                        $game->update([
                            'booked_person' => $counterUp,
                        ]);
                        Player::create([
                            'game_id' => $game->id,
                            'user_id' => Auth::user()->id,
                        ]);
                        notify()->success("Your are booked in $game->game_name", 'Success');
                        return back();
                    }else{
                        $counterUp = 1;
                        $game->update([
                            'booked_person' => $counterUp,
                        ]);
                        Player::create([
                            'game_id' => $game->id,
                            'user_id' => Auth::user()->id,
                        ]);
                        notify()->success("Your are booked in $game->game_name", 'Success');
                        return back();
                    }
                }
            }else{
                notify()->error("Booking request is not between Start & End time", 'Error');
                return back();
            }
        }
        
        
    }
}
