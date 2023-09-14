<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'item_name',
        'name',
        'type',
        'detail',
        'quantity',
        'minquantity',
        'price',
        'image',
    ];

    public function updateItem($request, $item)
    {
        $result = $item->fill([
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'quantity' => $request->quantity,
            'minquantity' => $request->minquantity,
            'price' => $request->price,
            'image' => $request->image
        ])->save();

        return $result;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
