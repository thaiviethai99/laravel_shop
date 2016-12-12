<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(UserRequest $request)
    {
        $user                 = new User;
        $user->username       = $request->txtUserName;
        $user->email          = $request->txtEmail;
        $user->password       = Hash::make($request->txtPass);
        $user->level          = $request->rdoLevel;
        $user->status         = $request->rdoStatus;
        $user->remember_token = $request->_token;
        $user->save();
        return redirect()->route('admin.user.list')->with(['level' => 'success', 'message' => 'Add success']);
    }

    public function getList()
    {

        $data = User::select('id', 'username', 'email', 'level', 'status')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.user.list', compact('data'));
    }

    public function getDelete($id)
    {
        $user_current_login = Auth::id();
        $user = User::find($id);
        if($id==1 || ($user_current_login!=1 && $user->level==1)){
            return redirect()->route('admin.user.list')->with(['level' => 'danger', 'message' => 'Sorry you cannot delete user']);
        }else {
            $user->delete();
            return redirect()->route('admin.user.list')->with(['level' => 'success', 'message' => 'Delete success']);
        }
        
       
    }

    public function getEdit($id)
    {
        $data = User::find($id)->toArray();
        if((Auth::id()!=1) && ($id==1 || ($data['level']==1 &&(Auth::id()!=$id)))){
            return redirect()->route('admin.user.list')->with(['level' => 'danger', 'message' => 'Sorry you cannot edit user']);
        }
        return view('admin.user.edit', compact('data','id'));
    }

    public function postEdit(Request $request, $id)
    {
        /*Session::push('user.teams', 'developers');
        Session::push('user.teams', 'developers2');
        $res = Session::get('user.teams');
        print_r($res);
        die();*/
        $error = array();
        $user  = User::find($id);
        //Consumer::where('lastName', 'LIKE', $request->lastName)->get();
        $username = DB::table('users')
            ->where('id', '<>', $id)
            ->where('username', $request->txtUserName)
            ->get();
        $email = DB::table('users')
            ->where('id', '<>', $id)
            ->where('email', $request->txtEmail)
            ->get();
        if (count($username) > 0) {
            $error[] = 'username da ton tai';
        } else {
            $user->username = $request->txtUserName;
        }
        if (count($email) > 0) {
            $error[] = 'email da ton tai';
        } else {
            $user->email = $request->txtEmail;
        }
        if (count($email) == 0 && count($username) == 0) {
            if (isset($request->txtPass)) {
                $user->password = Hash::make($request->txtPass);
            }

            $user->level  = $request->rdoLevel;
            $user->status = $request->rdoStatus;
            $user->remember_token = $request->_token;
            $user->save();
            return redirect()->route('admin.user.list')->with(['level' => 'success', 'message' => 'Update success']);
        } else {
            Session::flash('error', $error);
            return redirect()->route('admin.user.getEdit', $id);
        }

    }

    /*if (Hash::check(Input::get('old_password'), Auth::user()->password) {
    echo 'done';
    }

    $credentials = ['email' => Auth::user()->email, 'password' => Input::get('old_password')];

    if (Auth::validate($credentials)) {
    echo "Successful";
    }*/

    public function loginPost(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('admin/dashboard');
        }

        return Redirect::to('login');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        /*
         * Validate all input fields
         */
        $this->validate($request, [
            'password'     => 'required_with:new_password|password|max:8',
            'new_password' => 'confirmed|max:8',
        ]);

        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->newPassword),
            ])->save();

            $request->session()->flash('success', 'Password changed');
            return redirect()->route('your.route');

        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->route('your.route');
        }

    }

    /*public function postLogin(LoginRequest $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password,
            'level'    => 1
        ];
        if($this->auth->attempt($login)){
            return redirect()->route('admin.user.list');
        }else {
            return redirect()->back();
        }
    }*/
}
