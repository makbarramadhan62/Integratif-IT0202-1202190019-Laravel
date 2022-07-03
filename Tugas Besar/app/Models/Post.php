<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = ['tittle', 'excerpt', 'body']; //tabel yang boleh diisi, sisanya ga boleh
    protected $guarded = ['id']; //tabel yang ga boleh diisi, sisanya boleh
    // protected $with = ['category', 'source'];
    protected $with = ['source'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when(
            $filters['source'] ?? false,
            fn ($query, $source) =>
            $query->whereHas(
                'source',
                fn ($query) =>
                $query->where('username', $source)
            )
        );
    }

    public function source()
    {
        return $this->belongsTo(Rss::class, 'rss_id');
    }
    
    public function image()
    {
        return $this->belongsTo(Image::class, 'id');
    }
}
