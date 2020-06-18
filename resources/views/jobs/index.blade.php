@extends('layouts.app')

@section('content')
<div class="container app-wrapper">

    <section class="section">

        @include('include.messages')

        @if (count($jobs) > 0)

        <h2 class="text-center">Job Offers</h2>

        <div class="card mt-4 border-0">

            <table class="table table-bordered m-0">
                <tbody>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Email</th>
                        <th scope="col">Description</th>
                        <th scope="col">Hr Manager</th>
                        <th scope="col">Status</th>
                    </tr>


                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{$job->title}}</td>
                        <td>{{$job->email}}</td>
                        <td>{{$job->description}}</td>
                        <td>{{$job->user->name}}</td>
                        <td>{{$job->status}}</td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

            {{$jobs->links()}}
            <!-- /.card-body -->
        </div>

        @else


        <h1 class="text-center">There is no Job Offers</h1>

        @endif

        <!-- /.card -->


    </section>
</div>

@endsection