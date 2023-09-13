<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $table = 'comments';
    protected $fillable = ['content', 'user_id', 'product_id', 'status_comment_id'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function reply(){
        return $this->hasMany(Reply_comment::class);
    }

    function status_comment(){
        return $this->belongsTo(Status_comment::class, 'status_comment_id');
    }
    

}
