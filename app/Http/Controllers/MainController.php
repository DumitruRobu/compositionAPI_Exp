<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function getPeople(){
        $users = User::with('country')->get();
        return response()->json(['users'=>$users]);
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message'=>'User Deleted successfully!']);

    }
}
