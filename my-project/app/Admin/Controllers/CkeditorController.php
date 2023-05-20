<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class CkeditorController extends AdminController
{
  public function upload(Request $request)
  {
    if ($request->hasFile('upload')) {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = 'aaaa' . $fileName . '_' . time() . '.' . $extension;

      // $request->file('upload')->move(storage_path('app/public/uploads/ckeditor'), $fileName);

      $CKEditorFuncNum = $request->input('CKEditorFuncNum');
      $url = asset('storage/uploads/ckeditor/' . $fileName);
      $msg = 'Image uploaded successfully';

      // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

      return response()->json([
        'url' => $url,
        'msg' => $msg
      ]);
      // file_put_contents(storage_path('app/public/uploads/ckeditor/file.txt'), $response);
      // @header('Content-type: text/html; charset=utf-8');
      // echo $response;
      exit();
    }
  }
}