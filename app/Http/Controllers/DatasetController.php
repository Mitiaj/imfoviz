<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Repositories\DatasetRepository;
use App\Services\Actions\StoreDataset;
use App\Services\FieldName;
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
        $aggregation = (string)$request->input('aggregation', '');
        $aggragationField = (string)$request->input('aggregation_field', '');
        $groupBy = (string)$request->input('group_by_field', '');
        $groupByAggregation = (string)$request->input('group_by_field_aggregation', '');

        $collection = $this->repository->query(
            $dataset,
            $aggregation,
            $aggragationField,
            $groupBy,
            $groupByAggregation
        );
        $response = [];

        $groupByField = (string)new FieldName($groupByAggregation, $groupBy);
        $aggregatedValue = (string)new FieldName($aggregation, $aggragationField);

        foreach ($collection as $row) {
            $response[$row[$groupByField]]['name'] = $row[$groupByField];
            $response[$row[$groupByField]]['data'][] = $row[$aggregatedValue];
        }

        return [
            'series' => array_values($response),
            'start' => $this->repository->start($dataset, $groupBy, $groupByAggregation)
        ];
    }
}
