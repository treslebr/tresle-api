<?php

namespace Tresle\Product\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ["name", "status", "price", "product_category_id"];

    /**
     * @var string
     */
    protected $table = "product";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function additionals(){
        return $this->belongsToMany(
            "Tresle\Product\Model\Additional\Additional",
            "product_additional_relation",
            "product_id",
            "product_additional_id"
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(
            "Tresle\Product\Model\Product\Category",
            "product_category_id"
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(){
        return $this->hasMany(
            "\Tresle\Product\Model\Product\Image",
            "product_id"
        );
    }
}
