<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // =======================================================
    // GET REQUESTS
    // =======================================================

    public function admin(){
        return view('admin');
    }

    // =======================================================
    // POST REQUESTS
    // =======================================================
    // Load the admin panel (Return user that was searched for)
    public function searchUser(Request $request){
        $receivedEmail = $request->userEmail;

        $users = User::where('email', 'LIKE', '%'.$receivedEmail.'%')->get();

        if(empty($users[0])){
            return redirect('/admin')->with('error', 'Could Not Find User!');
        } else {
            return redirect('/admin')->with('userList', $users);
        }
    }

    public function addUser(Request $request){
        if($request->userpassword != $request->userconfirmpassword){
            return redirect('/admin')->with('passwordError', 'Passwords Do Not Match! Try Again...');
        } else {
            try {
                $user = User::where('email', $request->useremail)->get();

                if(empty($user[0])){
                    User::create([
                        'name' => $request->username,
                        'email' => $request->useremail,
                        'password' => Hash::make($request->userpassword),
                    ]);

                    return redirect('/admin')->with('error', 'User Created Successfully! Try Searching For Them...');
                } else {
                    return redirect('/admin')->with('error', 'Duplicate Entry Detected!');
                }
            } catch (QueryException $e) {
                // Handle other query exceptions
                return redirect('/admin')->with('error', $e->getMessage());
            }
        }
    }

    public function changePrivilege($id){
        $currUser = User::find($id);

        if(is_null($currUser)){
            return redirect('/admin')->with('error', 'Could Not Find User!');
        } else {
            if($currUser->user_type == 'user'){
                DB::table('users')
                    ->where('id', $currUser->id)
                    ->update(['user_type' => 'admin']);
            } else if($currUser->user_type == 'admin'){
                DB::table('users')
                    ->where('id', $currUser->id)
                    ->update(['user_type' => 'user']);
            } else {
                return redirect('/admin')->with('error', 'Invalid User Type');
            }

            return redirect('/admin')->with('error', 'User Privileges Changed! Try Searching For Them...');
        }
    }

    public function deleteUser($id){
        $currUser = User::find($id);

        if(is_null($currUser)){
            return redirect('/admin')->with('error', 'Could Not Find User!');
        } else {
            $currUser->delete();
            return redirect('/admin')->with('error', 'User DELETED!');
        }
    }
}
