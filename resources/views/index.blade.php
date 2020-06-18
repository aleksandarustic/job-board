@extends('layouts.app')

@section('content')

<div class="container app-wrapper">


    @include('include.messages')


    <section class="section">

        @if(count($jobs) > 0)

        <h2 class="text-center mb-4">Approved Job Offers</h2>

        @foreach($jobs as $job)

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="text-primary">{{$job->title}}</h5>
                    <div >{{$job->user->name}}</div>
                </div>
                <div>{{$job->email}}</div>
                <div>{{$job->description}}</div>
            </div>
        </div>

        @endforeach


        {{$jobs->links()}}


        @else
        <div class="title text-center">
            Welcome to Job Board
        </div>

        @endif
    </section>


</div>


@endsection