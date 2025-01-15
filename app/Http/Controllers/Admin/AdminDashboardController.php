<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function dashboard(){
        $data = [];
        $data['users']=User::where('role_id', 2)->count();
        $data['games']=Game::count();
        return view('admin.dashboard', $data);
    }
    public function user(){
        $data = [];
        $data['users']=User::where('role_id', 2)->latest()->get();
        return view('admin.user.index', $data);
    }
    public function createUser(){
        return view('admin.user.create-and-edit');
    }
    public function editUser($id){
        User::findOrFail($id);
        return view('admin.user.create-and-edit');
    }
    public function roleCreate(){
        return view('admin.roles.create-and-edit');
    }
    public function role(){
        return view('admin.roles.index');
    }

    public function userApprove($id){
        $user = User::findOrFail($id);
        if ($user->status == false)
        {
            $user->status = true;
            $user->save();
            notify()->success('Approved','User Approved.', );
            return back();
        } else {
            notify()->info('Approved', 'User Already Approved!');
        }
        return redirect()->back();
    }

    public function userDelete($id){
        $user = User::findOrFail($id);
        $user->delete();
        notify()->success('User Successfully Deleted!', 'Success');
        return back();
    }
}
