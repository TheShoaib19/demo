<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //NOW the index() is doing the showing and deleting
    // public function showUsers(){
    //     $users = DB::table('users')->get();
    //     return view('includes.users', ['data' => $users]);
    // }

    //$req->first_name hai, ye 'addUser.blade.php' main jo name hai wo hai idhr
    //'first_name' table ka column name hai
    public function addUser(UserRequest $req){
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name, 
            'email' => $req->email,
            'age' => $req->age,
            'password' => $req->password,
            'phone' => $req->phone
        ]);
        if($user){
            return redirect()->route('users');
        }
        else{
            echo "<h1>Data Not Added</h1>";
        }
    }

    public function updateForm(string $id){
        // $user= DB::table('users')->where('id', $id)->get();
        $user = DB::table('users')->find($id);  //this does the same as the above but it returns an array whereas the
                                                //above returns a JSON
        return view('/user.updateUser', ['data' => $user]);
    }

    public function updateUser(UserUpdateRequest $req, $id){
        $user = [
            'first_name' => $req->first_name,
            'last_name' => $req->last_name, 
            'email' => $req->email,
            'age' => $req->age,
            'password' => $req->password,
            'phone' => $req->phone
        ];
        User::where('id' , $id)->update($user);
        
        if($user){
            return redirect()->route('users');
        }
        else{
            return redirect()->route('users');
        }
    }

    public function deleteUser(string $id){
        $user = DB::table('users')->where('id', $id)->delete();
        if($user){
            return redirect()->route('users');
        }
    }

    public function deleteAllUsers(){
        $user = DB::table('users')->delete(); //using truncate here because delete will not reset the ID column
                                                //and new data will have the ID of after the last which was deleted
        if($user){
            return redirect()->route('users');
        }
    }

    public function index()
    {
        $data['users'] = User::get();
        return view('user.index', $data);
    }

    public function removeMulti(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"User successfully removed."]);
         
    }
}
