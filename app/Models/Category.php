<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'en_title',
        'slug',
        'parent_id',
        'image',
    ];

    public function parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')
            ->withTrashed()
            ->withDefault(['title'=>"---"]);
    }

    public function childCategory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public static function getCategories(): array
    {
        $array = [];
        $categories = self::query()->with('childCategory')->where('parent_id',0)->get();
        foreach ($categories as $category1){
            $array[$category1->id]=$category1->title;
            foreach ($category1->childCategory as $category2){
                $array[$category2->id]= ' - ' . $category2->title;
                foreach ($category2->childCategory as $category3){
                    $array[$category3->id]= ' - - ' . $category3->title;
                }
            }
        }

        return $array;
    }

}

