<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.index', ['topics'=>Topic::all(),]);
    }
}
