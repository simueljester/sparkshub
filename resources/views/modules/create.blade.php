@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('modules.index')}}"> Modules </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Add module </li>
        </ol>
    </nav>
           
    <form action="{{route('modules.save')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Add Module </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Title </small>
                    <input type="text" name="title" id="title" class="form-control border-custom" required>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Description </small>
                    <textarea type="text" name="description" id="description" rows="10" class="form-control border-custom description" required> Write something... </textarea>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Subject </small>
                    <select name="subject_id" id="subject_id" class="form-control border-custom">
                        @forelse ($subjects as $subject)
                            <option value="{{$subject->id}}"> {{$subject->name}} </option>
                        @empty
                            <option value=""> No subject. Please create a subject first </option>
                        @endforelse
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="downloadable" id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        Displayed & Downloadable by students
                    </label>
                </div>
                <hr>
                <button class="btn btn-success border-custom"> Save Module </button>
            </div>
        </div>
    </form>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
        $('.description').each( function () {
        // var editor =  CKEDITOR.replace( this.id  )
        var editor = CKEDITOR.replace( this.id, {
            language: 'en',
            extraPlugins: 'notification'
        });

        editor.on( 'required', function( evt ) {
            editor.showNotification( 'This field is required.', 'warning' );
        evt.cancel();
        });
    });
</script>
@endsection

