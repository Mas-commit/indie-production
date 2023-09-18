<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

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

        // アイテム一覧から最新５件取得
        $items = Item::orderBy('created_at','desc')->take(5)->get();
        // お知らせ一覧から最新５件取得
        $notifications = Notification::orderBy('created_at','desc')->take(5)->get();

        return view('home',[
            'count_01' => $count_01,
            'count_02' => $count_02,
            'count_03' => $count_03,
            'count_04' => $count_04,
            'count_05' => $count_05,

            'items' => $items,
            'notifications' => $notifications
        ]
        );
    }

    /**
     * お知らせ登録
     */
    public function notificationAdd(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'notification' => 'required|max:200',
            ],
            [
                'notification.max' => 'お知らせは200文字以内で設定してください',
                'notification.required' => 'お知らせを入力してください',
            ]);

            // お知らせ登録
            Notification::create([
                'user_id' => Auth::user()->id,
                'notification' => $request->notification,
            ]);

            return redirect('/');
        }

        return view('notificationadd');
    }

    /**
     * お知らせ編集
     */

    //  public function itemEdit(Request $request)
    public function notificationEdit($id)
     {
         /**
          * idに紐づくデータを抽出し、item.editに渡す
          */

        $user_id = \Auth::user()->name;
        $notification=Notification::find($id);
        return view('/notificationedit', compact('notification', 'user_id'));
     }

     public function notificationEditor(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'notification' => 'required|max:200',
        ],
        [
            'notification.max' => 'お知らせは200文字以内で設定してください',
            'notification.required' => 'お知らせを入力してください',
        ]);
        $notification = Notification::find($request->id);
        $notification->notification=$request->notification;
        $notification->save();

        return redirect('/');
    }

    public function notificationDestroyer(Request $request){
        $notification = Notification::find($request->id)->delete();

        return redirect('/');
    }
}
