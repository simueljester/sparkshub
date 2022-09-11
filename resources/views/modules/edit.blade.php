@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('modules.index')}}"> Modules </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit module </li>
        </ol>
    </nav>
           
    <form action="{{route('modules.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Edit Module </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Title </small>
                    <input type="text" name="title" id="title" class="form-control border-custom" value="{{$module->title}}" required>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Description </small>
                    <textarea type="text" name="description" id="description" rows="10" class="form-control border-custom" required> {{$module->description}} </textarea>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Subject </small>
                    <select name="subject_id" id="subject_id" class="form-control border-custom">
                        @forelse ($subjects as $subject)
                            <option value="{{$subject->id}}" {{$module->subject_id == $subject->id ? 'selected' : null}} > {{$subject->name}} </option>
                        @empty
                            <option value=""> No subject. Please create a subject first </option>
                        @endforelse
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="downloadable" id="flexCheckDefault" {{$module->downloadable == 1 ? 'checked' : null }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Displayed & Downloadable by students
                    </label>
                </div>
                <hr>
                <input type="hidden" name="module_id" id="module_id" value="{{$module->id}}">
                <button class="btn btn-success border-custom"> Save Changes </button>
            </div>
        </div>
    </form>
  


@endsection

