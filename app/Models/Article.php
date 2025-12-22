<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // 允许批量赋值的字段
    protected $fillable = [
        'title',
        'content',
         'user_id',
    ];

    // 关联用户（一篇文章属于一个用户）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}