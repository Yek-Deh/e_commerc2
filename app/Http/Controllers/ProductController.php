<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('admin.dashboard', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        //
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        //

        $product = new Product();
        //insert single image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $image->storeAs('', $fileName, 'public');
            $filePath = 'uploads/' . $fileName;
            $product->image = $filePath;

        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->sku = $request->sku;
        $product->save();

        if ($request->has('colors') && $request->filled('colors')) {
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color,
                ]);
            }
        }

        // insert images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->storeAs('', $fileName, 'public');
                $filePath = 'uploads/' . $fileName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $filePath,
                ]);
            }
        }
        flash()->success('Product added successfully');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
//        $product=Product::with(['colors','images'])->findOrFail($id);
        $colors = $product->colors->pluck('name')->toArray();
        return view('admin.product.edit', compact('product', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            //delete prev image
            File::delete(public_path($product->image));

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->storeAs('', $filename, 'public');
            $filePath = 'uploads/' . $filename;
            $product->image = $filePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->sku = $request->sku;
        $product->update();

        //update colors
        if ($request->hasFile('colors') && $request->filled('colors')) {
            $product->colors()->delete();
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'name' => $color,
                ]);
            }
        }

        //update images
        if ($request->hasFile('images')) {
            //delete perv images in folders
            foreach ($product->images as $image) {
                $fileName = $image->path;
                File::delete(public_path($fileName));
            }
            $product->images()->delete();
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->storeAs('', $fileName, 'public');
                $filePath = 'uploads/' . $fileName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $filePath,
                ]);
            }
        }
        flash()->success('Product updated successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->colors()->delete();
        File::delete(public_path($product->image));
        foreach ($product->images as $image) {
            File::delete(public_path($image->path));
        }
        $product->delete();
        flash()->success('Product deleted successfully');
        return redirect()->route('product.index');
    }
}
