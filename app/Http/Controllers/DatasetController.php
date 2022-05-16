<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Repositories\DatasetRepository;
use App\Services\Actions\StoreDataset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class DatasetController extends Controller
{
    private DatasetRepository $repository;

    final public function __construct(DatasetRepository $repository)
    {
        $this->repository = $repository;
    }

    final public function upload(Request $request)
    {
        $file = $request->file('dataset');

        if ($file === null) {
            return new Response('Missing file', 400);
        }

        // store dataset
        $action = new StoreDataset();
        $dataset = $action($request->user(), $file);


        return $dataset;
    }

    final public function query(Dataset $dataset, Request $request)
    {
        $aggregation = $request->input('aggregation');
        $aggragationField = $request->input('aggregation_field');
        $groupBy = $request->input('group_by_field');

        $collection = $this->repository->query($dataset, $aggregation, $aggragationField, $groupBy);
        $response = [];

        foreach ($collection as $row) {
            $response[$row[$groupBy]]['name'] = $row[$groupBy];
            $response[$row[$groupBy]]['data'][] = $row['aggregate'];
        }

        return array_values($response);
    }
}
