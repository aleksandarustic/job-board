
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible">
        {{ session()->get('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        {{session('error')}}
    </div>
@endif