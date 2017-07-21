<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use Image, Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.dash.index');
    }

    public function uploadImgFile(Request $request)
    {
        //Ajax上传图片
        // $file = Input::file('file');
        // $filetype = Input::get('filetype');
        $file = $request->file('file');
        $filetype=$request->filetype;
        $ext=strtolower($file->getClientOriginalExtension());

        $allowed_extensions = array("jpg", "bmp", "gif", "tif","png","jpeg");
        if ($ext && !in_array($ext, $allowed_extensions)) {
            return Response::json([ 'errors' => '只能上传png、jpg、gif、等等文件.']);
        }
        if ($filetype=='image'){
            $destinationPath = config('subscribesystem.thumb_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);
            $img = Image::make(public_path($destinationPath.$fileName))
                        ->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
            $img->save(public_path($destinationPath.$fileName));
        }else if($filetype=='adimg'){
            $destinationPath = config('subscribesystem.thumb_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(16).'.'.$extension;
            $file->move($destinationPath, $fileName);
            $img = Image::make(public_path($destinationPath.$fileName))
                        ->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });

        }
        return Response::json(
            [
                'success' => true,
                'src' =>$fileName,
                'filetype' => $filetype
            ]
        );
    }
}
