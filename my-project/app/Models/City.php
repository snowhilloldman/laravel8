<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
  use HasFactory;

  static function deep0Options()
  {
    $options = [];
    $rs = City::where('deep', '=', 0)->get();

    foreach ($rs as $r) {
      $options[$r->id] = $r->name;
    }
    return $options;
  }


  static function deep1Options()
  {
    $options = [];
    $rs = City::where('deep', '=', 1)->get();

    foreach ($rs as $r) {
      $options[$r->id] = $r->name;
    }
    return $options;
  }
}