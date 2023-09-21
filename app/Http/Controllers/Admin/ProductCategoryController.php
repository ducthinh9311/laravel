<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $sortBy = $request->sortBy ?? 'latest';
        $status = $request->status ?? '';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';

        $filter = [];
        if(!empty($keyword)){
            $filter[] = ['name', 'like', '%'.$keyword.'%'];
        }
        if(($status !== '')){
            $filter[] = ['status', $status];
        }

        // $page = $request->page ?? 1;
        // $itemPerPage = 2;
        // $offset = ($page - 1) * $itemPerPage;

        // $sqlSelect = 'select * from product_categories';
        // $paramsBinding = [];
        // if (!empty($keyword)) {
        //     $sqlSelect .= ' where name like ? ';
        //     $paramsBinding[] = '%' . $keyword . '%';
        // }
        // $sqlSelect .= ' order by created_at ' . $sort;
        // $sqlSelect .= ' limit ?,?';
        // $paramsBinding[] = $offset;
        // $paramsBinding[] = $itemPerPage;

        // $productCategories = DB::select($sqlSelect, $paramsBinding);
        // $totalRecords = DB::select('select count(*) as sum from product_categories')[0]->sum;

        // $totalPages = ceil($totalRecords / $itemPerPage);

        //Eloquent
        // $productCategories = ProductCategory::paginate(config('my-config.item-per-pages'));
        $productCategories = ProductCategory::where($filter)
        ->where('status', $status)
        ->orderBy('created_at', $sort)
        ->paginate(config('my-config.item-per-pages'));
        return view(
            'admin.pages.product_category.list',
            ['productCategories' => $productCategories, 'keyword' => $keyword, 'sortBy' => $sortBy]
        );
    }
    public function add()
    {
        return view('admin.pages.product_category.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        // $bool = DB::insert('insert into product_categories (name, status, created_at, updated_at) values (?, ?, ?, ?)', [
        //     $request->name,
        //     $request->status,
        //     Carbon::now()->addDays(999)->addMonth()->addYear(),
        //     Carbon::now()
        // ]);
        //Eloquent
        $productCategory = new ProductCategory;
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();

        $message = $check ? 'Tao thanh cong' : 'Tao that bai';

        //session flash
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }

    public function detail(ProductCategory $productCategory)
    {
        //Query Builder
        // $productCategory = DB::select('select * from product_categories where id = ?', [$id]);
        //Eloquent
        // $productCategory = ProductCategory::find($productCategory);
        return view('admin.pages.product_category.detail', ['productCategory' => $productCategory]);
    }
    public function update(UpdateProductCategoryRequest $request,ProductCategory $productCategory)
    {
        //UPDATE `product_categories` SET name='', status='' WHREe id=1;
        //Query Builder
        // $check = DB::update('UPDATE `product_categories` SET name = ? , status = ? where id = ?', [$request->name, $request->status, $id]);

        //Eloquent
        // $productCategory = ProductCategory::find($id);
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();

        $message = $check > 0 ? 'Cap Nhat Thanh Cong' : 'Cap Nhat That Bai';
        //session flash
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
    public function destroy(ProductCategory $product_category)
    {
        //Query builder
        // $check = DB::delete('DELETE from product_categories WHERE id = ?', [$id]);

        //Eloquent
        $check = $product_category->delete();
        $message = $check > 0 ? 'Xoa Thanh Cong' : 'Xoa That Bai';
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
}