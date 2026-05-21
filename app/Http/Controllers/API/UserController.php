<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
      config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    //
    public function getLikes(Request $request) {
      $email = $request->email;
      $likes = $request->likes;

      if (!$email) {
        return $this->sendError("Email address cannot be empty.", null, 200);
      }

      if (!$likes) {
        return $this->sendError("Likes data cannot be empty.", null, 200);
      }

      $user = DB::table('users')->where('email', $email)->where('is_admin', '<>', 1)->first();
      if ($user) {

        $likesObject = json_decode($likes);
        if (count($likesObject) > 0) {
          foreach ($likesObject as $like_item) {
            $like = DB::table('users_cars')->where('user_id', $user->id)->where('car_id', $like_item->car_id)->first();
            if (!$like && $like_item->timestamp != '0') {
              $insert = DB::table('users_cars')->insert([
                'user_id' => $user->id,
                'car_id' => $like_item->car_id,
                'created_at' => date('Y-m-d H:i:s', strtotime($like_item->timestamp)),
              ]);
            }
          }
        }

        $likes = DB::table('users_cars')
        ->select('car_id', 'created_at')
        ->where('user_id', $user->id)
        ->orderBy('id', 'asc')
        ->get();

        if (count($likes) > 0) {
          foreach ($likes as $item) {
            $item->timestamp = strtotime($item->created_at);
          }
        }

        return $this->sendResponse($likes, 'Likes data loaded successfully.');
      }
      else {
        return $this->sendError("Invalid email address.", null, 200);
      }
    }

    //
    public function postLogin(Request $request) {
      $email = $request->email;
      $password = $request->password;

      if (!$email) {
        return $this->sendError("Email address cannot be empty.", null, 200);
      }

      if (!$password) {
        return $this->sendError("Password cannot be empty.", null, 200);
      }

      $user = DB::table('users')->where('email', $email)->where('is_admin', '<>', 1)->first();

      if($user) {
        if (Hash::check($password, $user->password)) {
            return $this->sendResponse($user, 'Login successfully.');
        } else {
            return $this->sendError("Invalid password.", null, 200);
        }
      } else {
          return $this->sendError("Invalid email address.", null, 200);
      }

    }

    //
    public function postInteraction(Request $request) {
      $email = $request->email;
      $car_id = $request->car;

      if (!$email) {
        return $this->sendError("Email address cannot be empty.", null, 200);
      }

      if (!$car_id) {
        return $this->sendError("Car id cannot be empty.", null, 200);
      }

      $user = DB::table('users')->where('email', $email)->first();
      if($user) {
        $like = DB::table('users_cars')->where('user_id', $user->id)->where('car_id', $car_id)->first();
        if (!$like) {
          $insert = DB::table('users_cars')->insert([
            'user_id' => $user->id,
            'car_id' => $car_id,
            'created_at' => date('Y-m-d H:i:s'),
          ]);
        }
        else {
          $deleted = DB::table('users_cars')->where('user_id', $user->id)->where('car_id', $car_id)->delete();
          $insert = DB::table('users_cars')->insert([
            'user_id' => $user->id,
            'car_id' => $car_id,
            'created_at' => date('Y-m-d H:i:s'),
          ]);
        }

        return $this->sendResponse([], 'Liked successfully.');
      } else {
          return $this->sendError("Invalid user.", null, 200);
      }

    }
}
