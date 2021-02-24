<?php

namespace App\Http\Controllers;

use App\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $documents = DB::table('documents')
            ->select(DB::raw('period, SUM(total) as total_amount, SUM(pending) as total_pending'))
            ->where('status', '2')
            ->orWhere('status', '4')
            ->groupBy('period')
            ->get();


        return $documents;
    }
}
