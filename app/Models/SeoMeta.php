<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'seo_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
