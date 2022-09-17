@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('library.index')}}">Library</a></li>
            <li class="breadcrumb-item"><a href="{{route('library.modules')}}">Uploaded Modules</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Show Module </li>
        </ol>
    </nav>

    <div class="card bg-white shadow m-2">
        <div class="card-body">
            <strong style="font-size: 22px;"> <i class="far fa-file-alt"></i> {{$module->title}} </strong>
            <p class="mt-1"> {!! $module->description !!} </p>
        </div>
    </div>

    @if ($module->downloadable == 1)
        <div class="row p-2">
            @forelse($module->files as $file)
                <div class="col-sm-6">
                    <div class="card shadow border-custom">
                        <div class="card-body">
                            <a href="{{route('modules.file.download-content',$file)}}" target="_blank" >
                                <i class="fas fa-download"></i> {{$file->file}}
                            </a>
                            @if (Auth::user()->id == $module->user_id)
                                <a href="{{route('modules.file.remove-file',$file)}}">
                                    <span class="badge badge-pill badge-danger ml-1"><i class="fas fa-times"></i></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-sm-12">
                    No uploaded content
                </div>
            @endforelse
        </div>
    @endif

 
@endsection

