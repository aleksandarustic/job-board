
@extends('layouts.dashboard')


@section('breadcrumps')
		<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')


	<div class="container">
	    <div class="row justify-content-center">
		<div class="col-md-10">
		    <div class="card">
			<div class="card-header">Welcome to Admin Panel</div>

			<div class="card-body">
			    <div class="row">
			        <div class="col-md-6 text-center">
			            <a href="{{ route('company.index') }}" role="button" class="btn btn-primary">
			                Companies
			            </a>
			        </div>
			        <div class="col-md-6 text-center">
			            <a href="{{ route('employee.index') }}" role="button" class="btn btn-primary">
			                Empleyees
			            </a>
			        </div>
			    </div>

			</div>
		    </div>
		</div>

    </div>
    <!-- /.content -->
  </div>

@endsection

