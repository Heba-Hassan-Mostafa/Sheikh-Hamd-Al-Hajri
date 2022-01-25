<?php

namespace App\Http\Controllers\WebController\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fatwas;
use App\Models\Visitor;
use App\Models\Client;
use App\Models\Subscriber;

class ApiController extends Controller
{
    public function subscriber_chart()
    {
        $visitors = Visitor::orderBy('visitor_count', 'desc')->take(1)->pluck('visitor_count', 'visitor_count');


    $chart['labels'] = $visitors->keys()->toArray();
    $chart['datasets']['name'] = trans('admin/template/common.top_visitors');
    $chart['datasets']['values'] = $visitors->values()->toArray();
    

    return response()->json($chart);
       

    }

    public function question_chart()
    {
        $questions = Fatwas::select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count', 'month');

        $clients = Subscriber::select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count', 'month');

        foreach ($questions->keys() as $month_number) {
            $labels[] = date('F', mktime(0, 0, 0, $month_number, 1));
        }

        $chart['labels'] = $labels;
        $chart['datasets'][0]['name'] = trans('admin/template/common.fatwas');
        $chart['datasets'][0]['values'] = $questions->values()->toArray();
        $chart['datasets'][1]['name'] = trans('admin/template/common.top_subs');
        $chart['datasets'][1]['values'] = $clients->values()->toArray();

        return response()->json($chart);

    }
}