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
                        <h3 class="card-title">Companies Table</h3>
    
                        <div class="card-tools">
                                <a href="{{route('company.create')}}" role="button" class="btn btn-success pull-right" > Add New <i class="fas fa-building"></i></a>
                        </div>
                        
                    </div>
                    <!-- /.card-header -->
    
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                 <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Modify</th>
                                </tr>

                                 @foreach($companies as $company)
                                     <tr>
                                         <td>{{$company->id}}</td>
                                         <td>{{$company->name}}</td>
                                         <td>{{$company->email}}</td>
                                         <td>{{$company->website}}</td>
                                         <td>
                                             <div class="">
                                                 <img src="{{asset('storage/'.$company->logo)}}" class="img-fluid img-thumbnail table-images" alt="Company logo">
                                             </div>
                                         </td>
                                         <td>
                                             <div class="row">
                                                 <a href="{{route('company.edit',$company->id)}}" role="button" class="btn-link btn-sm btn">
                                                     <i class="fas fa-edit "></i></a>
                                                 <a href="{{route('company.show',$company->id)}}" role="button" class="btn-link btn-sm btn">
                                                     <i class="fas fa-eye"></i></a>

                                                 {!! Form::open(['action' => ['CompanyController@destroy',$company->id] ,'method' => 'POST' ])  !!}
                                                 {!! Form::hidden('_method','DELETE') !!}
                                                 {!! Form::button('<i class="fas fa-trash-alt text-danger"></i>',['type'=> 'submit', 'class' => 'btn-link btn-sm btn'])!!}
                                                 {!! Form::close() !!}
                                             </div>

                                         </td>
                                     </tr>
                                 @endforeach
                            </tbody>
                        </table>
    
                    </div>
    
                    <div class="card-footer clearfix">
                            {{$companies->links()}}
                     </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
