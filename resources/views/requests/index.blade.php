@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Borrowed Books </li>
        </ol>
    </nav>
   
    <div class="card bg-secondary shadow m-2">
         <div class="card-header bg-white border-0">
            <strong> <i class="fas fa-clipboard-list"></i> Borrowed Books </strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Book</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Returned Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td> <i class="fas fa-user"></i> {{$request->user->name}}  <br> <small class="text-capitalize"> {{$request->user->role}} </small> </td>
                                <td> <i class="fas fa-book"></i> {{$request->book->title}} <br> <small class="text-capitalize"> {{$request->book->category->name}} </small> </td>
                                <td> {{$request->created_at->format('Y-m-d')}} </td>
                                <td> {{$request->end_date->format('Y-m-d')}} </td>
                                <td>
                                    @if ($request->approved_at == null)
                                        <span class="text-muted"> Pending </span>
                                    @else
                                        <span class="text-success"> Approved </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($request->returned_at == null)
                                        <span class="text-warning"> No </span>
                                    @else
                                        <span class="text-primary"> Yes </span>
                                        @if ($request->returned_at > $request->end_date)
                                            <br>
                                            <small class="text-warning"> Overdue </small>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                     <a href="{{route('request-book.show',$request)}}"> <i class="fas fa-eye"></i> View more </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> No record found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 


    <script>
      
    </script>
@endsection

