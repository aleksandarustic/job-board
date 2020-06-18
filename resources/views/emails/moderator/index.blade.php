
@component('mail::message')
Dear, {{$user->name}}

Job Offer has been posted for the first time by {{$job->user->name}}


## {{$job->title}}

**{{$job->email}}**

{{$job->description}}

Please Approve or Reject this submission


@component('mail::button', ['url' => route('job.approve',$job->token),'color' => 'primary'])
Approve
@endcomponent

@component('mail::button', ['url' => route('job.reject',$job->token),'color' => 'red'])
Reject
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
