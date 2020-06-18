@extends('layouts.app')

@section('content')

<div class="container app-wrapper">


   <section class="section">

        @if(isset($message))
            <div class="title title--md text-center text-success">
                {{ $message }}
            </div>
        @endif

        @if(isset($error))
             <div class="title title--md text-center text-danger">
                {{ $error }}
            </div>
        @endif

    </section>


</div>


@endsection