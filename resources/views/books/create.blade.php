@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Book</li>
        </ol>
    </nav>
 
   <a href="{{route('books.index')}}" class="text-muted"> Cancel </a>
    <div class="card bg-secondary shadow mt-3">
        <div class="card-header bg-white border-0">
            <strong> Create </strong>
        </div>
        <div class="card-body">
            
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush