<?php
declare(strict_types=1);

namespace App\Services\Actions;

use App\Models\MongoDataset;
use App\Models\User;
use App\Services\CsvFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class StoreDatasetInMongo
{
    final public function __invoke(User $user, UploadedFile $file): void
    {
        if (!str_contains($file->getMimeType(), 'csv')) {
            throw new \InvalidArgumentException('Only CSV format currently supported');
        }

        $csv = CsvFile::fromFile($file);
        $collectionName = Str::uuid()->toString();
        $bulk = [];

        while (!empty($line = $csv->readLine())) {
            $bulk[] = $line;
        }

        $mongo = new MongoDataset();
        $mongo->setCollection($collectionName);
        $result = $mongo->newQuery()->insert($bulk);

        dd($result);

    }
}
