<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class ChartController extends Controller
{
    final public function showForm(Dashboard $dashboard, Request $request): Responsable
    {
        return Inertia::render('Dashboard/CreateChart', [
            'dashboard' => $dashboard,
            'dataset' => $dashboard->dataset
        ]);
    }
}
