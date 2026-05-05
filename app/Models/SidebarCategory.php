<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kategori',
        'slug',
        'urutan',
        'is_active'
    ];

    public function items()
    {
        return $this->hasMany(SidebarItem::class, 'category_id')
                    ->where('is_active', 1)
                    ->orderBy('urutan');
    }
}
