<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('can:delete-user')->only(['destroy']);
        $this->middleware('can:switch-client-to-librarian')->only(['update']);
        $this->middleware('can:all-users')->only(['index']);
        $this->middleware('can:show-user')->only(['show']);


    }
    public function index()
    {

       $users=User::with('roles')->get();

         return response()->json([
            'message'=>'users found',
            'users'=>$users,
         ]);
      

    }


    public function show($id)
    {
        $user=User::with('roles')->find($id);

        if(!$user){
            return response()->json([
                'message'=>'user not found',
                'user'=>$user,
           ]);
        }
        return response()->json([
            'message'=>'user found',
            'user'=>$user,
       ]);
    }

   // switch role to librarian
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->syncRoles('librarian');

        return response()->json([
            'message'=>'user updated',
            'user'=>$user,
       ]);
    } 

    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();

        return response()->json([
            'message'=>'user deleted',
            'user'=>$user,
       ]);
    }
    

}
