<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all=Invoices::count();
        if($all==0){
            $invoices=$all ;
            $unpaid=invoices::where('value_status', '2')->count() ;
            $paid=invoices::where('value_status', '1')->count() ;
            $partially=invoices::where('value_status', '3')->count() ;
        }
        else{
            $invoices=$all / $all *100;
            $unpaid=invoices::where('value_status', '2')->count() / $all *100;
            $paid=invoices::where('value_status', '1')->count() / $all *100;
            $partially=invoices::where('value_status', '3')->count() / $all *100;
        }
        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Invoices'])
        ->datasets([
            [
                "label" => "UnPaid Invoices",
                'backgroundColor' => ['#ec524b'],
                'data' => [$unpaid,100],
            ],
            [
                "label" => "Paid Invoices",
                'backgroundColor' => ['#3d8361'],
                'data'=>[$paid,100]
            ],
            [
                "label" => "Partially Paid Invoices",
                'backgroundColor' => ['#ff731d'],
                'data'=>[$partially,0],
            ],
        ])
        ->options([]);


        $chartjs1 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Unpaid', 'Paid' , 'Partially paid'])
        ->datasets([
            [
                'backgroundColor' => ['#ec524b', '#3d8361','#ff731d'],
                'hoverBackgroundColor' => ['#ec524b', '#3d8361','#ff731d'],
                'data' => [$unpaid,$paid,$partially]
            ]
        ])
        ->options([]);
        return view('home',compact('chartjs','chartjs1'));
    }
}
