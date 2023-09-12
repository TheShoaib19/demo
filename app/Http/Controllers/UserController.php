<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

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
        try{
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
        catch(Throwable $th){
            return redirect()->back()->with('user_add' , $th->getMessage());
        }
    }

    public function updateForm(string $id){
        // $user= DB::table('users')->where('id', $id)->get();
        $user = DB::table('users')->find($id);  //this does the same as the above but it returns an array whereas the
                                                //above returns a JSON
        return view('/user.updateUser', ['data' => $user]);
    }

    public function updateUser(UserUpdateRequest $req, $id){
        try {
            $user = [
                'first_name' => $req->first_name,
                'last_name' => $req->last_name, 
                'email' => $req->email,
                'age' => $req->age,
                'phone' => $req->phone
            ];
            if($req->has('password') && !empty($req->get('password'))){
                $user['password'] = Hash::make($req->password);
            }
            User::where('id' , $id)->update($user);
            
            if($user){
                return redirect()->route('users');
            }
            else{
                return redirect()->route('users');
            }
        } catch (Throwable $th)
        {
            return redirect()->back()->with('user_update' , $th->getMessage());
        }
    }

    public function index(){
        return view('user.index');
    }
    // AJAX request
    public function getUsers(Request $request){
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get('length');

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

     // Total records
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('first_name', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
        ->where('users.first_name', 'like', '%' .$searchValue . '%')
        ->orWhere('users.last_name', 'like', '%' .$searchValue . '%')
        ->orWhere('users.email', 'like', '%' .$searchValue . '%')
        ->orWhere('users.age', 'like', '%' .$searchValue . '%')
        ->select('users.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
     
        foreach($records as $record){
            $id = $record->id;
            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $email = $record->email;
            $age = $record->age;
            $phone = $record->phone;

            $data_arr[] = array(
            "id" => $id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "age" => $age,
            "phone" => $phone,
            "view" => '<a href="'.route('updateForm', $id).'"class="btn btn-primary btn-sm">View</a>',
            "checkbox" => '<input type="checkbox" class="checkbox" onclick="individual()" data-id="'.$id.'">'
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        echo json_encode($response);
        exit;
    }
    public function removeMulti(Request $request)
    {
        try {
            $ids = $request->ids;
            User::whereIn('id',explode(",",$ids))->delete();
            return response()->json(['status'=>true,'message'=>"User successfully removed."] , 200);
        } catch (Throwable $th){
            return response()->json(['status'=>false,'message'=>$th->getMessage()] , 422);
        }
    }
}
