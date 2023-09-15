<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        return view('roles.roleIndex');
    }
    public function getRoles(Request $request){
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
        $totalRecords = DB::table('roles')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DB::table('roles')->select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
        $records = DB::table('roles')->orderBy($columnName,$columnSortOrder)
        ->where('roles.name', 'like', '%' .$searchValue . '%')
        ->select('roles.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
     
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;

            $data_arr[] = array(
            "id" => $id,
            "name" => $name,
            "view" => '<a href="'.route('updateRoleForm', $id).'"class="btn btn-primary btn-sm">View</a>',
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

    public function addRole(Request $req){
        try{
            $role = DB::table('roles')
                ->insert(['name' => $req->name,
                          'guard_name' => 'web',
                          'created_at' => now(),
                          'updated_at' => now()]);
            if($role){
                return redirect()->route('roles')->with('message', 'Role Added Successfully');
            }
            else{
                echo "<h1>Data Not Added</h1>";
            }
        }
        catch(Throwable $th){
            return redirect()->back()->with('role_add' , $th->getMessage());
        }
    }
    public function updateRoleForm(string $id){
        $role = DB::table('roles')->find($id);
        return view('/roles.updateRole', ['data' => $role]);
    }
    public function updateRole(Request $req, $id){
        try {
            $current_user = DB::table('roles')->where('id' , $id)->update(['name' => $req->name]);
            
            if($current_user){
                return redirect()->route('roles')->with('message1', 'Role Updated Successfully');
            }
        }
        catch (Throwable $th)
        {
            return redirect()->back()->with('user_update' , $th->getMessage());
        }
    }
    public function removeRoles(Request $request){
        try {
            $ids = $request->ids;
            Role::whereIn('id',explode(",",$ids))->delete();
            return response()->json(['status'=>true,'message'=>"User successfully removed."] , 200);
        } catch (Throwable $th){
            return response()->json(['status'=>false,'message'=>$th->getMessage()] , 422);
        }
    }
}
