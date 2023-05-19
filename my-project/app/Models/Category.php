<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
  use HasFactory;

  static $statusOptions = [
    'draft' => 'Darft',
    'closed' => 'Closed',
    'public' => 'public'
  ];

  private $categoryOptions = array(0 => 'root');

  private function categoriesSelectGenerate($id = 0, $depth = 1)
  {
    $categories = DB::table('categories')->where('father_id', $id)->get();
    // $count = $categories->items;
    // print_r($categories);
    foreach ($categories as $item) {
      $this->categoryOptions[$item->id] = str_repeat('--', $depth) . ' ' . $item->title;
      $this->categoriesSelectGenerate($item->id, $depth + 1);
    }
  }
  public function getTree()
  {
    $this->categoriesSelectGenerate();
    return $this->categoryOptions;
  }
}