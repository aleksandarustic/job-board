@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-1">
                @include('include.messages')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employess Table</h3>

                    <div class="card-tools">
                        <a href="{{route('employee.create')}}" role="button" class="btn btn-success pull-right">
                            Add New <i class="fas fa-user-plus"></i></a>
                    </div>
                    
                </div>
                <!-- /.card-header -->


                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Company</th>
                                <th scope="col">Modify</th>
                            </tr>


                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->firstname}}</td>
                                <td>{{$employee->lastname}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->employee_company->name}}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{route('employee.edit',$employee->id)}}" role="button" class="btn-link btn-sm btn">
                                            <i class="fas fa-edit "></i></a>
                                        <a href="{{route('employee.show',$employee->id)}}" role="button" class="btn-link btn-sm btn">
                                            <i class="fas fa-eye"></i></a>

                                        {!! Form::open(['action' => ['EmployeeController@destroy',$employee->id]
                                        ,'method' => 'POST' ]) !!}
                                        {!! Form::hidden('_method','DELETE') !!}
                                        {!! Form::button('<i class="fas fa-trash-alt text-danger"></i>',['type'=> 'submit', 'class' => 'btn-link btn-sm btn'])
                                        !!}

                                        {!! Form::close() !!}
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="card-footer clearfix">
                        {{$employees->links()}}
                 </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection