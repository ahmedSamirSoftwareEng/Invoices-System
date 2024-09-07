@extends('layouts.master')
@section('title')
قائمة الفواتير
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير </span>
		</div>
	</div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')



<!-- row -->
<div class="row row-sm">

	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
				<div class="d-flex justify-content-between">

				<a href="invoices/create" class="modal-effect btn btn-outline-primary btn-block"
				 data-bs-effect="effect-scale" data-bs-toggle="modal"> <i class="fas fa-plus"></i>&nbsp; اضافة فاتورة </a>
				
				</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">رقم الفاتورة</th>
								<th class="border-bottom-0">تاريخ الفاتورة</th>
								<th class="border-bottom-0">تاريخ الإستحقاق</th>
								<th class="border-bottom-0">المنتج</th>
								<th class="border-bottom-0">القسم</th>
								<th class="border-bottom-0">الخصم</th>
								<th class="border-bottom-0">نسبة الضريبة</th>
								<th class="border-bottom-0">قيمة الضريبة</th>
								<th class="border-bottom-0">الاجمالى</th>
								<th class="border-bottom-0">الحالة</th>
								<th class="border-bottom-0">ملاحظات</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($invoices as $invoice)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$invoice->invoice_number}}</td>
								<td>{{$invoice->invoice_Date}}</td>
								<td>{{$invoice->due_date}}</td>
								<td>{{$invoice->product}}</td>
								<td>{{$invoice->section_id}}</td>
								<td>{{$invoice->discount}}</td>
								<td>{{$invoice->rate_vat}}</td>
								<td>{{$invoice->value_vat}}</td>	

							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>


@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection