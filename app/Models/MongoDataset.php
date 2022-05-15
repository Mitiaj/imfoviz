<?php
declare(strict_types=1);

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

final class MongoDataset extends Model
{
    protected $connection = 'mongodb';
    protected $collection = null;
    protected $guarded = [];

    public function setCollection(string $collection): void
    {
        $this->collection = $collection;
    }
}
