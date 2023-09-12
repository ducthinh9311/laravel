<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use Carbon\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Qury Builder
        $products = DB::table('products')->paginate(1); //pagination page
        return view('admin.pages.product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = DB::select('select * from product_categories where status = 1');
        return view('admin.pages.product.create', ['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        // DB::select("insert into product ('name') VALUE (?)", [$request->name]);

        //Query Builder
        $check = DB::table('products')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "discount_price" => $request->discount_price,
            "short_description" => $request->short_description,
            "information" => $request->information,
            "description" => $request->description,
            "qty" => $request->qty,
            "shipping" => $request->shipping,
            "weight" => $request->weight,
            "status" => $request->status,
            "product_category_id" => $request->product_category_id,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        $message = $check ? 'tao san pham thanh cong' : 'tao san pham that bai';

        return redirect()->route('admin.product.index')->with('message', $message);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function createSlug(Request $request)
    {
        // $name = $request->name;
        // // $name = implode('-', explode(' ', $name));
        // // $name = str_replace(' ', '-', trim($name));
        // // $name = 'nguyen-van-a';
        // return response()->json(['slug' => $name]);
        // // dd($request->all());

        //Helper string
        return response()->json(['slug' => Str::slug($request->name, '-')]);
    }
}
