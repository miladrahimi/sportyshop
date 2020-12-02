<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderAddress
 *
 * @property int $id
 * @property int $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $cellphone
 * @property string $city
 * @property string $province
 * @property string $code
 * @property string $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @method static Builder|OrderAddress newModelQuery()
 * @method static Builder|OrderAddress newQuery()
 * @method static Builder|OrderAddress query()
 * @method static Builder|OrderAddress whereCellphone($value)
 * @method static Builder|OrderAddress whereCity($value)
 * @method static Builder|OrderAddress whereCode($value)
 * @method static Builder|OrderAddress whereCreatedAt($value)
 * @method static Builder|OrderAddress whereDetails($value)
 * @method static Builder|OrderAddress whereFirstName($value)
 * @method static Builder|OrderAddress whereId($value)
 * @method static Builder|OrderAddress whereLastName($value)
 * @method static Builder|OrderAddress whereOrderId($value)
 * @method static Builder|OrderAddress whereProvince($value)
 * @method static Builder|OrderAddress whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderAddress extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
