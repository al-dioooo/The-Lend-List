<?php

namespace App\Http\Controllers;

use App\Exports\DataListExport;
use App\Models\DataList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index() {
        $list = DataList::reportFilter(request()->only('search', 'month', 'year'))->with('borrower', 'items')->latest()->paginate(20)->withQueryString();
        $yearQuery = DataList::select(DB::raw('YEAR(created_at) year'))->groupby('year')->get();
        $monthQuery = DataList::select(DB::raw('MONTH(created_at) month'))->groupby('month')->get();
        $month = [];
        $year = [];

        foreach($monthQuery as $row) {
            array_push($month, [
                Carbon::createFromDate(2021, $row->month, 1)->format('F'),
                Carbon::createFromDate(2021, $row->month, 1)->format('m')
            ]);
        }

        foreach($yearQuery as $row) {
            array_push($year, Carbon::createFromDate($row->year, 01, 1)->format('Y'));
        }

        $data = [
            'datasheet' => $list,
            'year' => $year,
            'month' => $month,
            'result' => $list->count()
        ];

        return Inertia::render('Report/Index', $data);
    }

    public function export() {
        $data = DataList::reportFilter(request()->only('search', 'month', 'year'))->pluck('id');

        return Excel::download(new DataListExport($data), 'Data ' . Carbon::now() . '.xlsx');
    }
}
