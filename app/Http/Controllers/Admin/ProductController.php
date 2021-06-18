<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequst;
use App\Models\Category;
use App\Models\Imagesproduct;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id','name', 'price_buy', 'price_sell', 'status')->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name', 'status')->where('status', '1')->get();
        $suppliers = Kontak::select('id','pemasok', 'nama')->where('pemasok', true)->get();
        $units = Unit::select('id', 'name', 'status')->where('status', '1')->get();
        
        return view('admin.product.create', compact('categories', 'suppliers', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequst $request)
    {   
        $price_sell = preg_replace('/[Rp. ]/','',$request->price_sell);
        $price_buy = preg_replace('/[Rp. ]/','',$request->price_buy);

        $products = Product::create([
            'name' => $request->name,
            'price_sell' => $price_sell,
            'price_buy' => $price_buy,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'supplier_id' => $request->supplier_id
        ]);

        if($request->hasFile('image')){
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->extension();

            $file->storeAs('public/images/product', $fileName);

            $photo = $fileName;
            Imagesproduct::create([
                'product_id' => $products->id,
                'image' => $photo
            ]);
        }
        return redirect()->route('admin.product.index')->with('success', 'Berhasil Menambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('unit', 'category', 'supplier')->findOrFail($id);
        $images = Imagesproduct::select('id', 'images', 'product_id')->where('product_id', $id);

        return view('admin.product.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::select('id','name', 'status')->where('status', '1')->get();
        $suppliers = Kontak::select('id','pemasok', 'nama')->where('pemasok', true)->get();
        $units = Unit::select('id', 'name', 'status')->where('status', '1')->get();

        $product = Product::findOrFail($id);
        $images = Imagesproduct::select('id', 'image', 'product_id')->where('product_id', $id)->get();

        return view('admin.product.edit', compact('product', 'images', 'categories', 'suppliers', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequst $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.product.index')->with('success', 'Berhasil Mengupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Berhasil Mendelete');
    }

    public function getDatatables()
    {

    }
}
