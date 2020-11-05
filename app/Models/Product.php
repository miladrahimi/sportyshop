<?php

namespace App\Models;

use App\Enums\FileTypes;
use App\Services\FileManager;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read int|null $photos_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereContent($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos(): array
    {
       return (new FileManager())->files(FileTypes::PRODUCT_PHOTO, $this->id);
    }
}
