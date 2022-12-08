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
                    <textarea type="text" name="description" id="description" rows="10" class="form-control border-custom description" required> {!! $module->description !!} </textarea>
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
                 <div class="form-group">
                    <small class="text-muted"> Grade Level </small>
                    <select name="grade_level" id="grade_level" class="form-control border-custom" required>
                        <option value="7" {{$module->grade_level == 7 ? 'Selected' : null}}> Grade 7 </option>
                        <option value="8" {{$module->grade_level == 8 ? 'Selected' : null}}> Grade 8 </option>
                        <option value="9" {{$module->grade_level == 9 ? 'Selected' : null}}> Grade 9 </option>
                        <option value="10" {{$module->grade_level == 10 ? 'Selected' : null}}> Grade 10 </option>
                        <option value="11" {{$module->grade_level == 11 ? 'Selected' : null}}> Grade 11 </option>
                        <option value="12" {{$module->grade_level == 12 ? 'Selected' : null}}> Grade 12 </option>
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
  
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
        $('.description').each( function () {
        // var editor =  CKEDITOR.replace( this.id  )
        var editor = CKEDITOR.replace( this.id, {
            language: 'en',
            extraPlugins: 'notification',
            toolbarGroups: [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'others', groups: [ 'others' ] },
            ]
        });

        editor.on( 'required', function( evt ) {
            editor.showNotification( 'This field is required.', 'warning' );
        evt.cancel();
        });
    });
</script>


@endsection

