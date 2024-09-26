@extends('layouts.master')
@section('title')
عرض الملف الشخصي 
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">عرض الملف الشخصي</h4>
		</div>
	</div>

</div>
<!-- breadcrumb -->
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' الملف الشخصي') }}</div>

                <div class="card-body">
                    <!-- Display the user's profile picture -->
                    <div class="text-center mb-4">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('assets/img/faces/6.png') }}" class="rounded-circle" alt="Profile Image" width="150">
                    </div>

                    <!-- Display the user's information -->
                    <p><strong>الاسم:</strong> {{ $user->name }}</p>
                    <p><strong>البريد الالكتروني:</strong> {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection