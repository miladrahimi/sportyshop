<?php

namespace App\Models;

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
 * @property-read Collection|ProductAttribute[] $attributes
 * @property-read int|null $attributes_count
 */
class Product extends Model
{
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function photos(): array
    {
        /** @var FileManager $fm */
        $fm = app(FileManager::class);
        return $fm->files($this->photosDir());
    }

    public function storePhoto(string $tempPath)
    {
        $dir = $this->photosDir();

        /** @var FileManager $fm */
        $fm = app(FileManager::class);

        $i = 1;
        do {
            $name = $i++ . '.jpg';
        } while ($fm->exists("$dir/$name"));

        $fm->store($tempPath, $dir, $name);
    }

    public function deletePhoto(string $name)
    {
        $dir = $this->photosDir();

        /** @var FileManager $fm */
        $fm = app(FileManager::class);
        $fm->delete("$dir/$name");
    }

    private function photosDir(): string
    {
        return 'products/photos/' . $this->id % 2000 . '/' . $this->id;
    }
}
