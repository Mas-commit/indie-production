<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        // カテゴリ毎の商品数の表示
        $items = Item::where('type', 1)->get();
        $count_01 =($items->count());

        $items = Item::where('type', 2)->get();
        $count_02 =($items->count());

        $items = Item::where('type', 3)->get();
        $count_03 =($items->count());

        $items = Item::where('type', 4)->get();
        $count_04 =($items->count());

        $items = Item::where('type', 5)->get();
        $count_05 =($items->count());
        
        // 一覧から最新５件取得
        $items = Item::orderBy('created_at','desc')->take(5)->get();

        return view('home',[
            'count_01' => $count_01,
            'count_02' => $count_02,
            'count_03' => $count_03,
            'count_04' => $count_04,
            'count_05' => $count_05,

            'items' => $items
        ]
        );
    }
}
