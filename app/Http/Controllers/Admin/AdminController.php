<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct() {
      config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    //
    public function getDashboard(Request $request) {
      if (!auth()->check()) {
        return redirect('/login');
      }

      $stats_brand_display = 'N/A';
      $stats_model_display = 'N/A';
      $stats_type_display = 'N/A';

      $stats_brand = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, bm.brand_id, b.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->groupBy('bm.brand_id')
      ->orderBy('stat', 'desc')
      ->first();

      if ($stats_brand) {
        $stats_brand_display = $stats_brand->name;
      }

      $stats_model = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, cm.model_id, m.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->groupBy('cm.model_id')
      ->orderBy('stat', 'desc')
      ->first();

      if ($stats_model) {
        $stats_model_display = $stats_model->name;
      }

      $stats_type = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, ct.type_id, t.name')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'uc.car_id')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->groupBy('ct.type_id')
      ->orderBy('stat', 'desc')
      ->first();

      if ($stats_type) {
        $stats_type_display = $stats_type->name;
      }

      $data = [
        'stats_brand' => $stats_brand_display,
        'stats_model' => $stats_model_display,
        'stats_type' => $stats_type_display,
      ];

      return view('admin.dashboard', $data);
    }

    //
    public function getLogin(Request $request) {
      return view('admin.login');
    }

    //
    public function postLogin(Request $request) {
      $email = $request->email;
      $password = $request->password;

      $user = DB::table('users')->where('email', $email)->where('is_admin', 1)->first();

      if($user) {
        if (Hash::check($password, $user->password)) {

          $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
          ]);

          if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
          }
        } else {
          return redirect()->route('get_login')->withErrors("Invalid password. Please try again.");
        }
      } else {
          return redirect()->route('get_login')->withErrors("Invalid email address. Please try again.");
      }
    }

    //
    public function getReports(Request $request) {
      if (!auth()->check()) {
        return redirect('/login');
      }

      $users = DB::table('users')->where('is_admin', '<>', 1)->get();
      $total = $users->count();

      if ($total > 0) {
        foreach ($users as $user) {
          $user->brand = $this->getMostLikeBrandByUser($user->id);
          $user->model = $this->getMostLikeModelByUser($user->id);
          $user->type = $this->getMostLikeTypeByUser($user->id);
        }
      }

      $data = [
        'users' => $users,
        'total' => $total,
      ];

      return view('admin.reports', $data);
    }

    //
    public function logOut(Request $request) {

      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/');
    }

    //
    public function getMostLikeBrandByUser($user_id) {
      $brand = 'N/A';
      $result = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, bm.brand_id, b.name AS name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('bm.brand_id')
      ->orderBy('stat', 'desc')
      ->orderBy('uc.id', 'desc')
      ->first();

      if ($result) {
        $brand = $result->name;
      }

      return $brand;
    }

    //
    public function getMostLikeModelByUser($user_id) {
      $model = 'N/A';
      $result = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, cm.model_id, m.name AS name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('cm.model_id')
      ->orderBy('stat', 'desc')
      ->orderBy('uc.id', 'desc')
      ->first();

      if ($result) {
        $model = $result->name;
      }

      return $model;
    }

    //
    public function getMostLikeTypeByUser($user_id) {
      $type = 'N/A';
      $result = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, ct.type_id, t.name AS name')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'uc.car_id')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('ct.type_id')
      ->orderBy('stat', 'desc')
      ->orderBy('uc.id', 'desc')
      ->first();

      if ($result) {
        $type = $result->name;
      }

      return $type;
    }

    //
    public function getBrandByCar($car_id) {
      $brand = '';
      $result = DB::table('cars_models AS cm')
      ->selectRaw('b.name AS name')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->where('cm.car_id', $car_id)
      ->first();

      if ($result) {
        $brand = $result->name;
      }

      return $brand;
    }

    //
    public function getModelByCar($car_id) {
      $model = '';
      $result = DB::table('cars_models AS cm')
      ->selectRaw('m.name AS name')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->where('cm.car_id', $car_id)
      ->first();

      if ($result) {
        $model = $result->name;
      }

      return $model;
    }

    //
    public function getTypeByCar($car_id) {
      $type = '';
      $result = DB::table('cars_type AS ct')
      ->selectRaw('t.name AS name')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->where('ct.car_id', $car_id)
      ->first();

      if ($result) {
        $type = $result->name;
      }

      return $type;
    }

    //
    public function getUserActivities($user_id) {
      $activities = [];
      $result = DB::table('users_cars AS uc')
      ->select('c.name AS car', 'uc.created_at AS liked_at')
      ->leftJoin('cars AS c', 'c.car_id', '=', 'uc.car_id')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'uc.car_id')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->where('uc.user_id', $user_id)
      ->orderBy('uc.created_at', 'desc')
      ->get();

      if (count($result) > 0) {
        foreach ($result as $activity) {

          $activity->custom_datetime = strtotime($activity->liked_at);
          $now = time();

          $current_diff = (($now - $activity->custom_datetime) / 3600);

          if ($current_diff < 24) {
            $activity->custom_datetime = round($current_diff) . " hours ago.";
          }
          else if ($current_diff > 24 && $current_diff < 48) {
            $activity->custom_datetime = "Yesterday, at " . date('g:ia', $activity->custom_datetime);
          }
          else {
            $activity->custom_datetime = date('g:ia, d/m/Y', $activity->custom_datetime);
          }
        }

        $activities = $result;
      }

      return $activities;
    }
}
