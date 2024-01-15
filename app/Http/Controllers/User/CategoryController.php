<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Supermarket;
use App\Models\SupermarketDetail;
use App\Models\Price;

class CategoryController extends Controller
{
    //
    public function index(): View
    {
        //カテゴリ一覧全件取得
        $categories = Category::all();
        $category_id = Category::select('id')->get();
        $images = Category::select('image')->get();

        return view('index', [
            'categories' => $categories,
            'category_id' => $category_id,
            'images' => $images,
        ]);
    }

    public function getCategory(string $id)
    {
        //カテゴリ1件取得
        $category = Category::findOrFail($id);

        return $category;
    }

    public function getProducts(string $category_id): View
    {
        //商品テーブルの指定のカテゴリIDと一致するカラムを全件取得
        $products = Product::select('*')->where('category_id', $category_id)->get();
        //指定のカテゴリIDとカテゴリテーブルのIDが一致するカラムを取得する
        $category = $this->getCategory($category_id);

        return view('products', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function getResults(string $product_id)
    {
        //スーパーマーケットテーブル、価格テーブル、スーパー詳細テーブルを結合し、以下のIDと一致するカラムを全件取得
        $results = DB::table('prices')
            ->join('supermarkets', 'prices.supermarket_id', '=', 'supermarkets.id')
            ->join('supermarket_details', 'supermarkets.id', '=', 'supermarket_details.supermarket_id')
            ->select('prices.*', 'supermarkets.*', 'supermarket_details.*')
            ->where('prices.product_id', '=', $product_id)
            ->get();

        return $results;
    }

    //カテゴリテーブルと商品テーブルを操作するため、変数は2つ設定する
    public function getPrices(string $category_id, string $product_id): View
    {
        //商品テーブルに格納されている画像名をproduct_idと一致したものを取得する
        $img = Product::select('image')->where('id', $product_id)->first();
        $results = $this->getResults($product_id);
        //カテゴリIDと一致するカラムの情報を取得
        $category = $this->getCategory($category_id);
        $count = count($results);

        return view('results', [
            'img' => $img,
            'results' => $results,
            'count' => $count,
            'category' => $category,
        ]);

    }

}