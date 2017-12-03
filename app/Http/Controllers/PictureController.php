<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use zgldh\QiniuStorage\QiniuStorage;

class PictureController extends Controller
{
    //
    public function upload(Request $request)
    {
        $file = $request->file('upload_file');
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['success' => false,'msg' => __('You may only upload png, jpg or gif.'),'file_path'=>''];
        }
        $picture = new Picture();
        $picture -> user_id = Auth::id();
        $picture -> type = $request->get('type');

        $filename = str_random(32) . "." . $file->getClientOriginalExtension();
        $disk = QiniuStorage::disk('qiniu');
        $path = $disk -> put(Auth::id() . "/".$picture -> type ,$file);

        $picture -> path = config('filesystems.disks.qiniu.url') . $path;
        $picture -> save();
        return ['success' => true,'msg' => __('You may only upload png, jpg or gif.'),'file_path'=> $picture -> path];
    }
}
