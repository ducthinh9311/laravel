<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

class ProductCategory extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $sortBy = $request->sortBy ?? 'latest';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';
        // $page = $_GET['page'] ?? 1;

        $page = $request->page ?? 1;
        $itemPerPage = 2;
        $offset = ($page - 1) * $itemPerPage;

        $sqlSelect = 'select * from product_categories';
        $paramsBinding = [];
        if (!empty($keyword)) {
            $sqlSelect .= ' where name like ? ';
            $paramsBinding[] = '%' . $keyword . '%';
        }
        $sqlSelect .= ' order by created_at ' . $sort;
        $sqlSelect .= ' limit ?,?';
        $paramsBinding[] = $offset;
        $paramsBinding[] = $itemPerPage;

        $productCategories = DB::select($sqlSelect, $paramsBinding);
        $totalRecords = DB::select('select count(*) as sum from product_categories')[0]->sum;

        $totalPages = ceil($totalRecords / $itemPerPage);

        return view(
            'admin.pages.product_category.list',
            ['productCategories' => $productCategories, 'totalPages' => $totalPages, 'currentPage' => $page, 'keyword' => $keyword, 'sortBy' => $sortBy]
        );
    }
    public function add()
    {
        return view('admin.pages.product_category.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $bool = DB::insert('insert into product_categories (name, status, created_at, updated_at) values (?, ?, ?, ?)', [
            $request->name,
            $request->status,
            Carbon::now()->addDays(999)->addMonth()->addYear(),
            Carbon::now()
        ]);
        $message = $bool ? 'Tao thanh cong' : 'Tao that bai';

        //session flash
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }

    public function detail($id)
    {
        $productCategory = DB::select('select * from product_categories where id = ?', [$id]);
        return view('admin.pages.product_category.detail', ['productCategory' => $productCategory[0]]);
    }
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        //UPDATE `product_categories` SET name='', status='' WHREe id=1;
        $check = DB::update('UPDATE `product_categories` SET name = ? , status = ? where id = ?', [$request->name, $request->status, $id]);
        $message = $check > 0 ? 'Cap Nhat Thanh Cong' : 'Cap Nhat That Bai';
        //session flash
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
    public function destroy($id)
    {
        $check = DB::delete('DELETE from product_categories WHERE id = ?', [$id]);
        $message = $check > 0 ? 'Xoa Thanh Cong' : 'Xoa That Bai';
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
}
