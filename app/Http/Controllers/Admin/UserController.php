<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;

class UserController extends Controller
{
    public function __construct(protected AdminController $adminController) {
      config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    //
    public function getUsers(Request $request) {
      if (!auth()->check()) {
        return redirect('/login');
      }

      $users = DB::table('users')->where('is_admin', '<>', 1)->orderBy('name', 'asc')->get();
      $total = $users->count();

      if ($total > 0) {
        foreach ($users as $user) {
          $user->brand = $this->adminController->getMostLikeBrandByUser($user->id);
          $user->model = $this->adminController->getMostLikeModelByUser($user->id);
          $user->type = $this->adminController->getMostLikeTypeByUser($user->id);
        }
      }

      $data = [
        'users' => $users,
        'total' => $total,
      ];

      return view('admin.users', $data);
    }

    //
    public function addUser(Request $request) {
      return view('admin.users.form_users');
    }

    //
    public function getUser(Request $request) {
      if (!auth()->check()) {
        return redirect('/login');
      }

      $id = $request->id;

      $user = DB::table('users')->where('id', $id)->first();
      if ($user) {
        $user->brand = $this->adminController->getMostLikeBrandByUser($user->id);
        $user->model = $this->adminController->getMostLikeModelByUser($user->id);
        $user->type = $this->adminController->getMostLikeTypeByUser($user->id);
        $user->activities = $this->adminController->getUserActivities($user->id);
        $user->custom_datetime = date('g:ia, d/m/Y', strtotime($user->created_at));
      }

      $data = [
        'user' => $user,
      ];

      return view('admin.users.details_user', $data);
    }

    //
    public function editUser(Request $request) {
      $id = $request->id;

      if (!$id) {
        return back()->withInput()->withErrors("Invalid User.");
      }

      $user = DB::table('users')->where('id', $id)->first();
      if (!$user) {
        return back()->withErrors("Invalid User.");
      }

      $data = [
        'user' => $user,
      ];

      return view('admin.users.form_users', $data);
    }

    //
    public function saveUser(Request $request) {
      $id = $request->id;
      $name = $request->name;
      $email = $request->email;
      $password = $request->password;

      if (!$name) {
        return back()->withInput()->withErrors("Name cannot be empty.");
      }

      if (!$email) {
        return back()->withInput()->withErrors("Email address cannot be empty.");
      }

      $user = DB::table('users')->where('email', $email)->first();
      if (!$id) {
        if ($user) {
          return back()->withInput()->withErrors("User with the same email address already exist.");
        }

        if (!$password) {
          return back()->withInput()->withErrors("Password cannot be empty.");
        }

        $new_password = Hash::make($password);

        $insert = DB::table('users')->insert([
          'name' => $name,
          'email' => $email,
          'password' => $new_password,
          'created_at' => date('Y-m-d H:i:s'),
        ]);
      } else {

        $new_password = $user->password;
        if ($password) {
          $new_password = Hash::make($password);
        }

        $update = DB::table('users')->where('id', $id)->update([
          'name' => $name,
          'email' => $email,
          'password' => $new_password,
        ]);
      }

      return redirect()->route('get_users')->withSuccess("Selected user has been updated successfully.");
    }

    //
    public function deleteUser(Request $request) {
      $id = $request->id;

      if (!$id) {
        return back()->withInput()->withErrors("Invalid User.");
      }

      $user = DB::table('users')->where('id', $id)->first();
      if (!$user) {
        return back()->withErrors("Invalid User.");
      }

      $deleted = DB::table('users')->where('id', $id)->delete();

      return redirect()->route('get_users')->withSuccess("Selected user has been deleted successfully.");

    }
}
