<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;

class CarController extends Controller
{
    public function __construct(protected AdminController $adminController) {
      config(['app.timezone' => 'Asia/Kuala_Lumpur']);
    }

    //
    public function getCars(Request $request) {
      if (!auth()->check()) {
        return redirect('/login');
      }

      $cars = DB::table('cars')->orderBy('name', 'asc')->get();
      $total = $cars->count();

      if ($total > 0) {
        foreach ($cars as $car) {
          $car->brand = $this->adminController->getBrandByCar($car->car_id);
          $car->model = $this->adminController->getModelByCar($car->car_id);
          $car->type = $this->adminController->getTypeByCar($car->car_id);
        }
      }

      $data = [
        'cars' => $cars,
        'total' => $total,
      ];

      return view('admin.cars', $data);
    }

    //
    public function addCar(Request $request) {
      $brands = DB::table('brands')->get();
      $models = DB::table('models')->get();
      $types = DB::table('type')->get();

      $car = [
        'type_id' => '',
        'brand_id' => '',
        'model_id' => '',
      ];
      $object = (object) $car;

      $data = [
        'brands' => $brands,
        'models' => $models,
        'types' => $types,
        'car' => $object,
      ];
      return view('admin.cars.form_cars', $data);
    }

    //
    public function editCar(Request $request) {
      $id = $request->id;

      if (!$id) {
        return back()->withInput()->withErrors("Invalid Car.");
      }

      $car = DB::table('cars')
      ->leftJoin('cars_type AS ct', 'ct.car_id', '=', 'cars.car_id')
      ->leftJoin('cars_models AS cm', 'cm.car_id', '=', 'cars.car_id')
      ->leftJoin('brands_models AS bm', 'bm.model_id', '=', 'cm.model_id')
      ->where('cars.car_id', $id)
      ->first();

      if (!$car) {
        return back()->withErrors("Invalid Car.");
      }

      $brands = DB::table('brands')->get();
      $models = DB::table('models')->get();
      $types = DB::table('type')->get();

      $data = [
        'brands' => $brands,
        'models' => $models,
        'types' => $types,
        'car' => $car,
      ];

      return view('admin.cars.form_cars', $data);
    }

    //
    public function saveCar(Request $request) {
      $id = $request->id;
      $name = $request->name;
      $type = $request->type;
      $brand = $request->brand;
      $model = $request->model;
      $picture = $request->picture;

      if (!$name) {
        return back()->withInput()->withErrors("Name cannot be empty.");
      }

      if (!$type) {
        return back()->withInput()->withErrors("Must select type to continue.");
      }

      if (!$brand) {
        return back()->withInput()->withErrors("Must select brand to continue.");
      }

      if (!$model) {
        return back()->withInput()->withErrors("Must select model to continue.");
      }

      $base64Image = '';
      if (!$id) {
        if ($request->file('picture')) {
          $uploaded_file = $request->file('picture');
          $base64String = base64_encode(file_get_contents($uploaded_file->path()));

          $mimeType = $uploaded_file->getMimeType();
          $base64Image = "data:{$mimeType};base64,{$base64String}";
        }

        $insert = DB::table('cars')->insertGetId([
          'name' => $name,
          'image_64' => $base64Image,
          'created_at' => date('Y-m-d H:i:s'),
        ]);

        $insert_type = DB::table('cars_type')->insert([
          'car_id' => $insert,
          'type_id' => $type,
        ]);

        $insert_model = DB::table('cars_models')->insert([
          'car_id' => $insert,
          'model_id' => $model,
        ]);
      }
      else {
        $car = DB::table('cars')->where('car_id', $id)->first();
        if (!$car) {
          return back()->withErrors("Invalid Car.");
        }

        if ($request->file('picture')) {
          $uploaded_file = $request->file('picture');
          $base64String = base64_encode(file_get_contents($uploaded_file->path()));

          $mimeType = $uploaded_file->getMimeType();
          $base64Image = "data:{$mimeType};base64,{$base64String}";

          $update = DB::table('cars')->where('car_id', $id)->update([
            'name' => $name,
            'image_64' => $base64Image,
          ]);
        }
        else {
          $update = DB::table('cars')->where('car_id', $id)->update([
            'name' => $name,
          ]);
        }

        $deleted = DB::table('cars_type')->where('car_id', $id)->delete();
        $insert_type = DB::table('cars_type')->insert([
          'car_id' => $id,
          'type_id' => $type,
        ]);

        $deleted = DB::table('cars_models')->where('car_id', $id)->delete();
        $insert_model = DB::table('cars_models')->insert([
          'car_id' => $id,
          'model_id' => $model,
        ]);
      }

      return redirect()->route('get_cars')->withSuccess("Selected car has been updated successfully.");
    }

    //
    public function deleteCar(Request $request) {
      $id = $request->id;

      if (!$id) {
        return back()->withInput()->withErrors("Invalid Car.");
      }

      $car = DB::table('cars')->where('car_id', $id)->first();
      if (!$car) {
        return back()->withErrors("Invalid Car.");
      }

      $deleted = DB::table('cars_type')->where('car_id', $id)->delete();
      $deleted = DB::table('cars_models')->where('car_id', $id)->delete();
      $deleted = DB::table('cars')->where('car_id', $id)->delete();

      return redirect()->route('get_cars')->withSuccess("Selected car has been deleted successfully.");

    }
}
