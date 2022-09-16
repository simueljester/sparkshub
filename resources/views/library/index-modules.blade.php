@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('library.index')}}">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Uploaded Modules </li>
        </ol>
    </nav>

  <div class="card bg-secondary shadow m-2">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <small class="text-muted">  Module Title </small>
                            <input type="text" name="keyword" id="keyword" class="form-control border-custom" value="{{$keyword}}" placeholder="keyword...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small class="text-muted"> Subjects</small>
                            <select name="subject_filter" id="subject_filter" class="form-control border-custom">
                                <option value="0"> All Subject </option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}" {{$subject_filter == $subject->id ? 'selected' : null}}> {{$subject->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary border-custom"> Search </button>
                @if ($keyword || $subject_filter != 0 || $subject_filter)
                    <a href="{{route('library.modules')}}" class="btn btn-outline-secondary border-custom"> Clear Keyword </a>
                @endif
            </form>
        </div>
    </div>

    <div class="row p-2">
        @forelse ($modules as $module)
    
             <div class="col-sm-3">
                <a href="{{route('library.show-modules',$module)}}">
                    <div class="card text-center bg-secondary shadow border-custom mt-3 book-library" onclick="viewModule({{$module}})">
                        <div class="card-body">
                            <i class="far fa-file-alt fa-5x text-primary"></i>
                        </div>
                        <div class="card-footer">
                            <strong class="text-capitalize"> {{$module->title}}</strong> <br>
                            <small class="text-muted"> {{$module->user ? $module->user->name : 'No uploader indicated'}} </small>
                            <br>
                            <span class="badge badge-pill badge-warning">{{$module->subject->name}}</span>
                        </div>
                    </div>
                </a>
            </div>

           
        @empty
            <div class="p-3"> No modules available </div>
        @endforelse
    </div>

 


 
@endsection

