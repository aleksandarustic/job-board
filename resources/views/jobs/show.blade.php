@extends('layouts.app')


@section('content')

<section class="section">

        <h2 class="text-center">{{$job->title}}</h2>


        <div class="card card--md card--centred mt-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Id: </strong>{{$job->id}}</li>
                <li class="list-group-item"><strong>Email: </strong>{{$job->email}}</li>
                <li class="list-group-item"><strong>Manager: </strong>{{$job->user->name}}</li>
                <li class="list-group-item"><strong>Status: </strong>{{$job->status}}</li>
            </ul>
            <div class="card-body">
                {{$job->description}}
            </div>
        </div>

</section>

@endsection