<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'category',
        'base_price',
        'description',
    ];

    const CATEGORY_SHIRT = 'shirt';
    const CATEGORY_CAP = 'cap';
    const CATEGORY_MUG = 'mug';

    public static function getCategories(): array
    {
        return [
            self::CATEGORY_SHIRT => 'Camisas',
            self::CATEGORY_CAP => 'Bonés',
            self::CATEGORY_MUG => 'Canecas',
        ];
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
