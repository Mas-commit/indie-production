<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;

class ItemController extends Controller
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
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();
        // $items = Item::paginate(5);

        $query = Item::query();
        $items = $query->paginate(5)->withQueryString();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
        $request->validate([
            'name' => 'required|max:50',
            'type' => ['required'],
            'price' => 'required|max:10',
            'detail' => 'required|max:400',
            'image' => 'file|max:50|mimes:jpg,jpeg,png',
        ],
        [
            'name.required' => '品名を入力してください。',
            'name.max' => '商品名は50字以内で設定してください',
            'type.required' => 'カテゴリを選択してください。',
            'price.required' => '価格は必須です。',
            'price.max' => '価格は10桁以内で設定してください',
            'detail.max' => '詳細情報は400文字以内で設定してください',
            'image.max' => '50KBを超える画像は登録できません',
            'image.mimes' => 'ファイル形式はjpg,jpeg,pngのみ登録可能です',
        ]);

            // 商品登録
            $item = new Item();
            $item->user_id = \Auth::id();
            $item->name = $request->name;
            $item->type =$request->type;
            $item->price =$request->price;
            $item->detail =$request->detail;
            $item->quantity =$request->quantity;
            $item->minquantity =$request->minquantity;
            if(isset($request->image)){
            $image = base64_encode(file_get_contents($request->image->getRealPath()));
            $item->image =$image;
            }
            $item->save();

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集
     */

    //  public function itemEdit(Request $request)
    public function itemEdit($id)
     {
         /**
          * idに紐づく商品データを抽出し、item.editに渡す
          */
        
        // $id = $request->id;
        $user_id = \Auth::user()->name;
 
        // $items = \DB::table('items')->find($id);
         
        //  return view('/item/edit')->with([
        //     'items' => $items,
        //     'user_id' => $user_id,
        // ]);
        $item=Item::find($id);
        return view('/item/edit', compact('item', 'user_id'));
     }

     public function itemEditor(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:50',
            'type' => ['required'],
            'price' => 'required|max:10',
            'detail' => 'required|max:400',
            'image' => 'file|max:50|mimes:jpg,jpeg,png',
        ],
        [
            'name.required' => '品名を入力してください。',
            'name.max' => '商品名は50字以内で設定してください',
            'type.required' => 'カテゴリを選択してください。',
            'price.required' => '価格は必須です。',
            'price.max' => '価格は10桁以内で設定してください',
            'detail.max' => '詳細情報は400文字以内で設定してください',
            'image.max' => '50KBを超える画像は登録できません',
            'image.mimes' => 'ファイル形式はjpg,jpeg,pngのみ登録可能です',
        ]);
        $item = Item::find($request->id);
        $item->user_id = \Auth::id();
        $item->name = $request->name;
        $item->type =$request->type;
        $item->price =$request->price;
        $item->detail =$request->detail;
        $item->quantity =$request->quantity;
        $item->minquantity =$request->minquantity;
        if(isset($request->image)){
            $image = base64_encode(file_get_contents($request->image->getRealPath()));
            $item->image =$image;
        }
        $item->save();

        return redirect('/items');
    }

    public function itemDestroyer(Request $request){
        $item = Item::find($request->id)->delete();

        return redirect('/items');
    }

    public function itemImageDestroyer(Request $request){
        
        $item = Item::find($request->id);
        $item->image = NULL;
        $item->save();
    
        return redirect('/items');
    }

    /**
     * 在庫数量編集
     */
    public function qtyEdit(Request $request)
     {
         /**
          * idに紐づく商品データを抽出し、item.qtyeditに渡す
          */
            // POSTリクエストのとき
            if ($request->isMethod('post')) {
                $item = Item::find($request->id);
                $item->user_id = \Auth::id();
                $item->name = $request->name;
                $item->type =$request->type;
                $item->price =$request->price;
                $item->detail =$request->detail;
                $item->quantity =$request->quantity;
                $item->minquantity =$request->minquantity;
                $item->save();

                return redirect('/items');
            }
            $user_id = \Auth::user()->name;
            $item=Item::find($id);
        return view('/item/qtyedit', compact('item', 'user_id'));
     }
        
    /**
     * 詳細画面
     */
    public function detail($id, Request $request){
        $items = Item::findOrFail($id);
        // $keyword = $request->input('keyword');
        // $page = $request->input('previouspage');
        // 商品詳細画面を表示
        return view('/item/detail',compact('items'));
    }


    /**
     * 商品検索
     */
    public function search(Request $request){
        //キーワード受け取り
        $keyword = $request->input('keyword');
        //クエリ生成
        $query = Item::query();

        //キーワードがあった場合
        if(!empty($keyword)){
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');
            // 単語を配列に変換
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
            $matchedValues = [];
            // $wordArraySearched　= [文房、コピー];
            foreach($wordArraySearched as $keyword) {
                $query->where('name','like','%'.$keyword.'%');
                $query->orWhere('price','like','%'.$keyword.'%');
                $query->orWhere('detail','like','%'.$keyword.'%');

                // constに定義しているtypesの文字列に部分一致するか検証して、一致するならvalue(1や2など)を$matchedValuesにつっこむ
                $types = config("const.types");
                foreach ($types as $value => $label) {
                    if(strpos($label, $keyword) !==false){
                        array_push($matchedValues, $value);
                    };
                }
            }
            $query->orWhereIn( 'type', $matchedValues);
            
        }
        $items = $query->paginate(5)->withQueryString();

        // 商品一覧画面を表示
        return view('item.index', compact('keyword','items'));
    }

    // /navlinkで実行
    public function navlink(Request $request){
        //キーワード受け取り
        $type = $request->input('type');
        //クエリ生成
        $query = Item::query();

        //一致する種別のみを検索
        if(!empty($type)){
            $query->where('type','like','%'.$type.'%');
        }
        $items = $query->paginate(5)->withQueryString();

        // 商品一覧画面を表示
        return view('/', compact('type','items'));
    }
}
