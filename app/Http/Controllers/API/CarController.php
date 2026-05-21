<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function __construct() {
      config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    //
    public function getCars(Request $request) {

      $cars = DB::table('cars')
      ->select('cars.car_id AS car_id', 'cars.name AS name', 'brands.name as brand', 'models.name as model', 'type.name as type', 'cars.image_64 AS image')
      ->leftJoin('cars_models', 'cars_models.car_id', '=', 'cars.car_id')
      ->leftJoin('models', 'models.model_id', '=', 'cars_models.model_id')
      ->leftJoin('brands_models', 'brands_models.model_id', '=', 'cars_models.model_id')
      ->leftJoin('brands', 'brands.brand_id', '=', 'brands_models.brand_id')
      ->leftJoin('cars_type', 'cars_type.car_id', '=', 'cars.car_id')
      ->leftJoin('type', 'type.type_id', '=', 'cars_type.type_ID')
      ->inRandomOrder()
      ->get();

      return $this->sendResponse($cars, 'Cars data loaded successfully.');
    }

    //
    public function getStats(Request $request) {

      $stats_brand = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, bm.brand_id, b.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->groupBy('bm.brand_id')
      ->orderBy('stat', 'desc')
      ->first();

      $stats_model = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, cm.model_id, m.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->groupBy('cm.model_id')
      ->orderBy('stat', 'desc')
      ->first();

      $stats_type = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, ct.type_id, t.name')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'uc.car_id')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->groupBy('ct.type_id')
      ->orderBy('stat', 'desc')
      ->first();

      $data = [
        'stats_brand' => $stats_brand,
        'stats_model' => $stats_model,
        'stats_type' => $stats_type,
      ];

      return $this->sendResponse($data, 'Stats data loaded successfully.');
    }

    //
    public function getStatsByUser(Request $request) {

      $user_id = $request->id;

      $stats_brand = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, bm.brand_id, b.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->leftJoin('brands AS b', 'b.brand_id', '=', 'bm.brand_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('bm.brand_id')
      ->first();

      $stats_model = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, cm.model_id, m.name')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'uc.car_id')
      ->leftJoin('models AS m', 'm.model_id', '=', 'cm.model_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('cm.model_id')
      ->first();

      $stats_type = DB::table('users_cars AS uc')
      ->selectRaw('COUNT(*) AS stat, ct.type_id, t.name')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'uc.car_id')
      ->leftJoin('type AS t', 't.type_id', '=', 'ct.type_id')
      ->where('uc.user_id', $user_id)
      ->groupBy('ct.type_id')
      ->first();

      $data = [
        'stats_brand' => $stats_brand,
        'stats_model' => $stats_model,
        'stats_type' => $stats_type,
      ];

      return $this->sendResponse($data, 'Stats data loaded successfully.');
    }
}
