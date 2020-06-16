@extends('layouts.dashboard')

@section('breadcrumps')

    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Employees</a></li>
    <li class="breadcrumb-item active">New employee</li>

@endsection

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center mb-5">
            <div class="col-md-9 col-sm-10 col-xs-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="card-title">Add new Employee</h3>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['action' => 'EmployeeController@store','method' => 'post']) !!}

                                <div class="form-group">
                                    {{Form::label('firstname','First name')}}
                                    {{Form::text('firstname','',['class'=> !$errors->first('firstname') ? 'form-control' : 'form-control is-invalid' ,'placeholder' => 'Employee firstname' ,'id' => 'firstname'])}}
                                    @if ($errors->has('firstname'))
                                        <div class="error">{{ $errors->first('firstname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('lastname','Last name')}}
                                    {{Form::text('lastname','',['class'=> !$errors->first('lastname') ? 'form-control' : 'form-control is-invalid','placeholder' => 'Last name'])}}
                                    @if ($errors->has('lastname'))
                                        <div class="error">{{ $errors->first('lastname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('phone','Phone number')}}
                                    {{Form::text('phone','',['class'=> !$errors->first('phone') ? 'form-control' : 'form-control is-invalid','placeholder' => 'Phone number'])}}
                                    @if ($errors->has('phone'))
                                        <div class="error">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('email','Email Address')}}
                                    {{Form::email('email','',['class'=> !$errors->first('email') ? 'form-control' : 'form-control is-invalid','placeholder' => 'Email Address'])}}
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('company','Company')}}
                                    {{Form::select('company', $companies, null,['class'=> !$errors->first('company') ? 'form-control' : 'form-control is-invalid','placeholder' => 'Company']) }}
                                    @if ($errors->has('company'))
                                        <div class="error">{{ $errors->first('company') }}</div>
                                    @endif
                                </div>

                                {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
