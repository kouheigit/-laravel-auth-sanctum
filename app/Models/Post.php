<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 🔑 マスアサインメントの許可
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // 👤 投稿の所有者（User）とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
