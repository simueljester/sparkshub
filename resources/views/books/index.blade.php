@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Books</li>
        </ol>
    </nav>
 
    <a href="{{route('books.create')}}" class="btn btn-warning btn-sm"> <i class="fas fa-plus-circle"></i> Add Book </a>
    <a href="{{route('books.categories.index')}}" class="btn btn-primary btn-sm"> <i class="fas fa-cog"></i> Manage Category </a>
    
    <div class="card bg-secondary shadow mt-3">
        <div class="card-header bg-white border-0">
            <strong> Index </strong>
        </div>
        <div class="card-body">
            
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush