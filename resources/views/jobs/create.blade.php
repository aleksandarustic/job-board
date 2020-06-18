@extends('layouts.dashboard')

@section('breadcrumps')

<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('job.index')}}">Jobs</a></li>
<li class="breadcrumb-item active">New Job</li>

@endsection

@section('content')
<section class="section">
    <div class="card card--md card--centred">
        <div class="card-header">
            Create Job Offer
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('job.store')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="4" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md">
                        <button class="btn btn-success"> Create <i class="fas fa-plus-square"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection