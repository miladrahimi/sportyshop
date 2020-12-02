<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $order_id
 * @property string $unique_id
 * @property string $track_id
 * @property int $price
 * @property mixed|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereDetails($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereOrderId($value)
 * @method static Builder|Transaction wherePrice($value)
 * @method static Builder|Transaction whereTrackId($value)
 * @method static Builder|Transaction whereUniqueId($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Transaction extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
