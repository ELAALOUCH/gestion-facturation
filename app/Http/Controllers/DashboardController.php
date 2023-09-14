<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {

        $chart_options = [
            'chart_title' => 'Factures par état de paiement',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Invoice',
            'group_by_field' => 'etat_paiement',
            'chart_type' => 'pie',

        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options2 = [
            'chart_title' => 'Nombre des Factures par mois',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Invoice',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '0,0,255',
        ];


        // Créer le graphique pour le chiffre d'affaires par mois
        $chart2 = new LaravelChart($chart_options2);
        return view('dashboard',compact('chart1','chart2'));
    }
}
