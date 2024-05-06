<?php

namespace App\Http\Controllers\imagen;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {


        $images =  $request->file('file');
        $nombreImagen = Str::uuid() . "." . $images->extension();
        $imagenServidor = Image::make($images);
        $imagenServidor->fit(400, 400);
        $images->storeAs('uploads/clienteslogos/', $nombreImagen, 'public');
        //$imagenPath = ('uploads/clienteslogos/' . $nombreImagen);
        //$imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
    public function firmaradiologo(Request $request)
    {


        $images =  $request->file('file');
        $nombreImagen = Str::uuid() . "." . $images->extension();
        $imagenServidor = Image::make($images);
        $imagenServidor->fit(400, 400);
        $images->storeAs('uploads/firmasradiologos/', $nombreImagen, 'public');
        //$imagenPath = public_path('uploads/firmasradiologos/' . $nombreImagen);
        //$imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
