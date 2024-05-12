<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
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
        'category_id',
        'image'
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getParentName()
    {
        return is_null($this->parent) ? 'ندارد' : $this->parent->name;
    }

    public static function getCategories(): array
    {
        $array = [];
        $categories = self::query()->with('children')->where('parent_id')->get();
        foreach ($categories as $category1){
            $array[$category1->id]=$category1->title;
            foreach ($category1->children as $category2){
                $array[$category2->id]= ' - ' . $category2->title;
                foreach ($category2->children as $category3){
                    $array[$category3->id]= ' - - ' . $category3->title;
                }
            }
        }

        return $array;
    }

    public function getCreateAtShamsi(): Verta
    {
        return new Verta($this->created_at);
    }
}

