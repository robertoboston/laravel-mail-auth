<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','slug', 'category_id','cover_image'];    

    public static function generateSlug($title){
        return Str::slug($title,'-');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
