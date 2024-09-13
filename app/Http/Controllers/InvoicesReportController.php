<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoicesReportController extends Controller
{
    public function index()
    {
        
        return view('reports.index');
    }
    public function Search_invoices(Request $request){
        $rdio = $request->rdio;


        // في حالة البحث بنوع الفاتورة
           
           if ($rdio == 1) {
              
            //    في حالة تحديد جميع الفواتير
               if ($request->type == 'جميع الفواتير' && $request->start_at =='' && $request->end_at =='') {
                   
                   $invoices = Invoice::select('*')->get();
                   $type = 'جميع الفواتير';
                   return view('reports.index',compact('type'))->with('details',$invoices);
               }
        // في حالة عدم تحديد تاريخ
               if ($request->type && $request->start_at =='' && $request->end_at =='') {
                   
                  $invoices = Invoice::select('*')->where('Status','=',$request->type)->get();
                  $type = $request->type;
                  return view('reports.index',compact('type'))->with('details',$invoices);
               }
               
               // في حالة تحديد تاريخ استحقاق
               else {
                  
                 $start_at = date($request->start_at);
                 $end_at = date($request->end_at);
                 $type = $request->type;
                //  في حالة تحديد جميع الفواتير
                 if ($request->type == 'جميع الفواتير') {
                     
                     $invoices = Invoice::select('*')->whereBetween('invoice_Date',[$start_at,$end_at])->get();
                     return view('reports.index',compact('type','start_at','end_at'))->with('details',$invoices);
                 }
                 
                 $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                 return view('reports.index',compact('type','start_at','end_at'))->with('details',$invoices);
                 
               }
       
        
               
           } 
           
       //====================================================================
           
       // في البحث برقم الفاتورة
           else {
               
               $invoices = Invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
               return view('reports.index')->with('details', $invoices);
               
           }
       
           
            
           
    }
}
