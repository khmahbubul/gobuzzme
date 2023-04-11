<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'package_id',
        'price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
