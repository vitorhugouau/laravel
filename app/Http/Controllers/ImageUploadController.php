<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImgApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    protected function authenticate()
    {
        $cloudinaryUrl = env('CLOUDINARY_URL');
        $cloudinaryKey = env('CLOUDINARY_API_KEY');

        if ($cloudinaryUrl && $cloudinaryKey) {
            Log::info("Configuração do Cloudinary carregada com sucesso.");
        } else {
            throw new \Exception("A URL do Cloudinary não está definida no arquivo .env.");
        }
    }
    public function upload(Request $request)
    {
        $nomeImagem = $request->file('image')->getClientOriginalName();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'nome' => $nomeImagem,
            'valor' => 'required|numeric',
        ]);

       
        $uploadedFileOriginal = Cloudinary::upload($request->file('image')->getRealPath());
        $urlOriginal = $uploadedFileOriginal->getSecurePath();

        $uploadedFileWatermarked = Cloudinary::upload($request->file('image')->getRealPath(), [
            'transformation' => [
                'overlay' => 'imagem_principal',  
                'gravity' => 'center',          
                'x' => 100,
                'y' => 100,
                'opacity' => 50,
            ],
            'folder' => 'watermarked_images',       
            'public_id' => uniqid() . '_watermarked' 
        ]);
        $urlMarcaDagua = $uploadedFileWatermarked->getSecurePath();

        ImgApi::create([
            'nome' => $nomeImagem,
            'url_original' => $urlOriginal,
            'url_marca_dagua' => $urlMarcaDagua,
            'valor' => $request->valor,
        ]);

        return redirect()->route('control')->with('success', 'Imagem enviada com sucesso!');
    }
    public function indexTable2()
    {
    
        $urlMarcaDagua = ImgApi::all();

        return view('biblioteca.biblioteca', compact('urlMarcaDagua'));
    }
}