@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Notifications</a></li>
        </ol>
    </nav>

    @forelse ($all_notifications as $my_notification)
    <div class="card bg-secondary shadow mt-2 border-custom">
        <div class="card-body">
            <a href="{{$my_notification->url}}" class="{{$my_notification->read_at ? 'text-muted' : 'text-primary'}}"> 
                <img id="output" style="border-radius: 50%;" width="45" height="45" src="{{ $my_notification->notifiedBy->avatar ? '/images/'.$my_notification->notifiedBy->avatar : Avatar::create($my_notification->notifiedBy->name)->toBase64() }}" /> {{$my_notification->notifiedBy->name}}  {{$my_notification->description}} 
            </a>
        </div>
    </div>
    @empty
        <div class="p-3">
            <strong class="text-muted"> You have no notifications </strong>
        </div>
    @endforelse




    <script>
    
    </script>
@endsection

