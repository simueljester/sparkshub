@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('modules.index')}}"> Modules </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Subjects </li>
        </ol>
    </nav>
           
    <a href="{{route('modules.subjects.create')}}" class="btn btn-info border-custom ml-2"> <i class="fas fa-plus"></i> Add Subject </a>
    <div class="card bg-secondary shadow mt-2">
        <div class="card-header bg-white border-0">
            <strong> Subject List </strong>
        </div>
        <div class="card-body">
             <table class="table align-items-center">
                 <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr>
                            <td> {{$subject->name}} </td>
                            <td> 
                                <a href="{{route('modules.subjects.edit',$subject)}}" class="text-primary"> <i class="fas fa-edit"></i> Edit </a>   
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"> No subject found. </td>
                        </tr>
                    @endforelse
                </tbody>
             </table>
        </div>
    </div>


@endsection

