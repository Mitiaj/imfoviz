<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Actions\StoreDataset;
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

        // store dataset
        $action = new StoreDataset();
        $dataset = $action($request->user(), $file);


        return $dataset;
    }
}
