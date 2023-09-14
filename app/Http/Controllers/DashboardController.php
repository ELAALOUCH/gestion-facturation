<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $customersWithTotalTVA = Customer::select('customers.nom', DB::raw('SUM(invoices.total_tva) as total_tva_sum'))
        ->leftJoin('invoices', 'customers.id', '=', 'invoices.customer_id')
        ->groupBy('customers.nom')
        ->orderByDesc('total_tva_sum')
        ->limit(5)
        ->get();

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
        $chart2 = new LaravelChart($chart_options2);


            $topProducts = DB::table('orders')
            ->select('product_id', 'service_id', DB::raw('SUM(quantite) as total_quantite'))
            ->groupBy('product_id', 'service_id')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();

            $topProducts = DB::table('orders')
            ->select('product_id', DB::raw('SUM(quantite) as total_quantite'))
            ->whereNotNull('product_id')
            ->groupBy('product_id')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();

        $topProductIds = $topProducts->pluck('product_id')->toArray();

        $topProductDetails = Product::whereIn('id', $topProductIds)->get();


        $topServices = DB::table('orders')
        ->select('service_id', DB::raw('SUM(quantite) as total_quantite'))
        ->whereNotNull('service_id') // Assurez-vous de sélectionner uniquement les services, pas les produits
        ->groupBy('service_id')
        ->orderByDesc('total_quantite')
        ->limit(5)
        ->get();

        $topServiceIds = $topServices->pluck('service_id')->toArray();

        $topServiceDetails = Service::whereIn('id', $topServiceIds)->get();

        return view('dashboard',compact('chart1','chart2','customersWithTotalTVA','topProductDetails','topProducts','topServices','topServiceDetails'));
    }
}
