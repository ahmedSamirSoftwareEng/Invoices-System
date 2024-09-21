@extends('layouts.master')
@section('title')
لوحة التحكم
@stop
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="left-content">
		<div>
			<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> مرحبا بكم مرة أخرى!</h2>
			<p class="mg-b-0"> في برنامج الفواتير</p>
		</div>
	</div>

</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">اجمالى الفواتير</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">
								EGP
								{{number_format(\App\Models\Invoice::sum('total'), 2)}}
							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								عدد الفواتير
								{{\App\Models\Invoice::count()}}
							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
							<span class="text-white op-7">100%</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">
								EGP
								{{number_format(\App\Models\Invoice::where('value_status', 2)->sum('total'), 2)}}
							</h4>
							<p class="mb-0 tx-12 text-white op-7">عدد الفواتير الغير مدفوعة {{\App\Models\Invoice::where('value_status', 2)->count()}}</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
							<span class="text-white op-7">
								{{ floor((\App\Models\Invoice::where('value_status', 2)->count()) / \App\Models\Invoice::count() * 100) }}%

							</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">
								EGP
								{{number_format(\App\Models\Invoice::where('value_status', 1)->sum('total'), 2)}}
							</h4>
							<p class="mb-0 tx-12 text-white op-7">عدد الفواتير المدفوعة {{\App\Models\Invoice::where('value_status', 1)->count()}}</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
							<span class="text-white op-7">
								{{ floor((\App\Models\Invoice::where('value_status', 1)->count()) / \App\Models\Invoice::count() * 100) }}%
							</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">
								EGP
								{{number_format(\App\Models\Invoice::where('value_status', 3)->sum('total'), 2)}}
							</h4>
							<p class="mb-0 tx-12 text-white op-7">
								عدد الفواتير المدفوعة جزئيا {{\App\Models\Invoice::where('value_status', 3)->count()}}
							</p>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
							<span class="text-white op-7"> {{ floor((\App\Models\Invoice::where('value_status', 3)->count()) / \App\Models\Invoice::count() * 100) }}%</span>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
		</div>
	</div>
</div>
<!-- row closed -->

<!-- row opened -->
<div class="row row-sm d-flex">
	<div class="col-md-12 col-lg-12 col-xl-8 d-flex">
		<div class="card w-100">
			<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mb-0">حالة الفواتير</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				<p class="tx-12 text-muted mb-0">نسبة الفواتير المدفوعة والغير مدفوعة والمدفوعة جزئيا</p>
			</div>
			<div class="card-body" >
				<canvas id="invoiceChart"></canvas>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-xl-4 d-flex">
		<div class="card card-dashboard-map-one w-100">
			<label class="main-content-label">جميع الفواتير</label>
			<span class="d-block mg-b-20 text-muted tx-12">اجمالي الفواتير {{\App\Models\Invoice::count()}}</span>
			<canvas id="invoiceChart2"></canvas>
		</div>
	</div>
</div>
	
<!-- row closed -->


<!-- /row -->
</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	var ctx = document.getElementById('invoiceChart').getContext('2d');
	var invoiceChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: @json($labels),
			datasets: [{
				label: 'حالة الفواتير',
				data: @json($percentages),
				backgroundColor: [
					'rgba(75, 192, 192, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(75, 192, 192, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
				tooltip: {
					callbacks: {
						label: function(context) {
							let label = context.label || '';
							let value = context.raw || 0;
							return `${label}: ${value.toFixed(2)}%`;
						}
					}
				}
			}
		}
	});
</script>

<script>
	var ctx = document.getElementById('invoiceChart2').getContext('2d');
	var invoiceChart = new Chart(ctx, {
		type: 'pie', // or 'bar', 'doughnut'
		data: {
			labels: @json($labels),
			datasets: [{
				label: 'حالة الفواتير',
				data: @json($percentages),
				backgroundColor: [
					'rgba(75, 192, 192, 0.2)',
					'rgba(255, 99, 132, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(75, 192, 192, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
				tooltip: {
					callbacks: {
						label: function(context) {
							let label = context.label || '';
							let value = context.raw || 0;
							return `${label}: ${value.toFixed(2)}%`;
						}
					}
				}
			}
		}
	});
</script>

@endsection