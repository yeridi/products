<?php

namespace App\Http\Controllers;

use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            // 'files' => 'required'
        ]);
        // dd(Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath());
        $files = [];
        // dd($request->file('files'));
        foreach ($request->file('files') as $file) {
            // dd(Cloudinary::upload($file->getRealPath()));
            $cloud = Cloudinary::upload($file->getRealPath());
            array_push($files,[
                'url' => $cloud->getSecurePath(),
                'key' => $cloud->getPublicId()
            ]);
        }
        $product = Product::create($request->except(['files']));

        $product->images()->createMany($files);

        return redirect()->route('products.index')->with('message','Product added successfully');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            // 'files' => 'required'
        ]);
        $files = [];
        // dd($request->all());
        $imagenes = $product->images;

        if (!isset($request->all()['files'])) {
            foreach ($imagenes as $imagen) {
                Cloudinary::destroy($imagen->key);
                $imagen->delete();
            }    
        }else{
            $requestCollect = collect($request->all()['files']);
            $deleteImages = $imagenes->whereNotIn('url',$requestCollect->pluck('hidden')->toArray());
            foreach ($deleteImages as $deleteImage) {
                Cloudinary::destroy($deleteImage->key);
                $deleteImage->delete();
            }
            foreach ($requestCollect as $key => $container) {
                if (isset($container['hidden'])) { // los que venian desde la base de datos
    
                    if (isset($container['file'])) { //si se ha subido una imagen
                        $cloud = Cloudinary::upload($container['file']->getRealPath());
                        $dbImagen = $imagenes->where('url',$container['hidden'])->first();
                        Cloudinary::destroy($dbImagen->key);
                        $dbImagen->update(['url' => $cloud->getSecurePath(), 'key' => $cloud->getPublicId() ]);
                    }else{
                    }
                }
                if (isset($container['file']) && !isset($container['hidden'])) {
                    $cloud = Cloudinary::upload($container['file']->getRealPath());
                    array_push($files,['url' => $cloud->getSecurePath(),'key' => $cloud->getPublicId()]);
                }
            }
            $product->update($request->all());
            $product->images()->createMany($files);

        }
        return redirect()->route('products.index')->with('message','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Cloudinary::destroy($image->key);
            $image->delete();
        }

        $product->delete();
        return redirect()->route('products.index')->with('message','Product deleted successfully');
    }
}
