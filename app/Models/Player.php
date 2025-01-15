<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
