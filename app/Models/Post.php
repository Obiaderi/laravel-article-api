<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //    protected $hidden = [
    //        'title'
    //    ];

    protected $fillable = [
        'title',
        'body',
    ];

    //    protected $guarded = [
    //        'title'
    //    ];

    protected $casts = [
        'body' => 'array'
    ];

    // Appending attributes to the model
    //    protected $appends = [
    //        'title_upper_case'
    //    ];

    // Accessors start with get and end with Attribute
    // This will convert the title to uppercase when it is retrieved
    // This is how u get  Post.find(1).title_upper_case
    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
    }

    // Mutators start with set and end with Attribute
    // This will convert the title to lowercase when it is set
    // This is how u set Post.find(1).title = 'hello world'
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}