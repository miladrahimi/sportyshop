<?php

namespace App\Models;

use App\Enums\OrderStateTypes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderState
 *
 * @property int $id
 * @property int $order_id
 * @property int $type
 * @property mixed $information
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @method static Builder|OrderState newModelQuery()
 * @method static Builder|OrderState newQuery()
 * @method static Builder|OrderState query()
 * @method static Builder|OrderState whereCreatedAt($value)
 * @method static Builder|OrderState whereId($value)
 * @method static Builder|OrderState whereInformation($value)
 * @method static Builder|OrderState whereOrderId($value)
 * @method static Builder|OrderState whereType($value)
 * @method static Builder|OrderState whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderState extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function isCancellable()
    {
        return OrderStateTypes::isCancellable($this->type);
    }
}
