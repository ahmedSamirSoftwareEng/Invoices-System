<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;



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
        $totalInvoices = Invoice::count();
        $paidCount = Invoice::where('status', 'مدفوعة')->count();
        $unpaidCount = Invoice::where('status', 'غير مدفوعة')->count();
        $partialPaidCount = Invoice::where('status', 'مدفوعة جزئيا')->count();
    
        $paidPercentage = ($totalInvoices > 0) ? ($paidCount / $totalInvoices) * 100 : 0;
        $unpaidPercentage = ($totalInvoices > 0) ? ($unpaidCount / $totalInvoices) * 100 : 0;
        $partialPaidPercentage = ($totalInvoices > 0) ? ($partialPaidCount / $totalInvoices) * 100 : 0;
    
        $labels = ['مدفوعة', 'غير مدفوعة', 'مدفوعة جزئيا'];
        $data = [$paidCount, $unpaidCount, $partialPaidCount];
        $percentages = [$paidPercentage, $unpaidPercentage, $partialPaidPercentage];
    
        return view('home', compact('labels', 'data', 'percentages'));
    }
        
    
}
