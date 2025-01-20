<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function getPeople(SearchRequest $request){
        $query = User::with('country'); //e un eagerMethod
        if($request->has('searchCriterion') &&  $request->input('searchCriterion')){
            $search = $request->input('searchCriterion');
            $query->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        $users = $query->get();
        return response()->json(['users'=>$users]);
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message'=>'User Deleted successfully!']);
    }
    public function getUser($id){
        $user = User::findOrFail($id);
        $usersCountry = $user->country;
        $countries = Country::all();
        $roles = Role::all();
        return response()->json([
            'user'=>$user,
            'usersCountry'=>$usersCountry,
            'countries'=>$countries,
            'roles'=>$roles,
        ]);
    }
    public function editUser($id, EditUserRequest $request){
        $data = $request->validated();
        $userToEdit = User::findOrFail($id);
        $userToEdit->update($data);
        return response()->json(['message'=>'Edited successfully!']);
    }
}
