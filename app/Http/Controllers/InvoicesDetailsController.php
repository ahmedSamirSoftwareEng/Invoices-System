<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicesAttachments;
use App\Models\InvoicesDetails;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = InvoicesDetails::where('id_Invoice',$id)->get();
        $attachments  = InvoicesAttachments::where('invoice_id',$id)->get();

        return view('invoices.show', compact('details','invoices','attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_file(Request $request)
    {
        $invoices = InvoicesAttachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }


public function get_file($invoice_number, $file_name)
{
    // Define the path relative to the root of your custom disk
    $path = $invoice_number . '/' . $file_name;

    // Check if the file exists
    if (Storage::disk('public_uploads')->exists($path)) {
        // Get the full file path
        $fullPath = Storage::disk('public_uploads')->path($path);

        // Return the file as a downloadable response
        return response()->download($fullPath);
    } else {
        // Return a 404 error if the file doesn't exist
        return response()->json(['message' => 'File not found'], 404);
    }
}





    public function open_file($invoice_number, $file_name)
    {
        // Define the path relative to the root of your custom disk
        $path = $invoice_number . '/' . $file_name;
    
        // Check if the file exists
        if (Storage::disk('public_uploads')->exists($path)) {
            // Get the file's full path on the server
            $fullPath = Storage::disk('public_uploads')->path($path);
    
            // Return the file as a response
            return response()->file($fullPath);
        } else {
            // Return a 404 response if the file doesn't exist
            return response()->json(['message' => 'File not found'], 404);
        }
    }
    
}
