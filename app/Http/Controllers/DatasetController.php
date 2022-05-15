<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\MongoDataset;
use App\Services\Actions\StoreDataset;
use App\Services\Actions\StoreDatasetInMongo;
use App\Services\CsvFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class DatasetController extends Controller
{
    final public function upload(Request $request)
    {
        $file = $request->file('dataset');

        if ($file === null) {
            return new Response('Missing file', 400);
        }

        $action = new StoreDataset();
        $result = $action($request->user(), $file);

        return new RedirectResponse('/create-chart');
    }

    private function readCsvLine(string $file): void
    {
        $stream = fopen($file, 'r+');
        fgetcsv($stream);
    }
}
