<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property mixed $record
 * @property int $count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @method static Builder|ProductAttribute newModelQuery()
 * @method static Builder|ProductAttribute newQuery()
 * @method static Builder|ProductAttribute query()
 * @method static Builder|ProductAttribute whereCount($value)
 * @method static Builder|ProductAttribute whereCreatedAt($value)
 * @method static Builder|ProductAttribute whereId($value)
 * @method static Builder|ProductAttribute whereProductId($value)
 * @method static Builder|ProductAttribute whereRecord($value)
 * @method static Builder|ProductAttribute whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductAttribute extends Model
{
    protected $guarded = [];

    public function getRecordAttribute($value)
    {
        return json_decode($value ?? '[]', true);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
