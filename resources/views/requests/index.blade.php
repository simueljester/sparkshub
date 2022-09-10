@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Borrowed Books </li>
        </ol>
    </nav>
   
    <div class="card bg-secondary shadow m-2">
        <div class="card-body border-0">
            <form action="">
                 <div class="row">
                    <div class="col-sm-9">
                        <small class="text-muted"> Filter </small>
                        <select name="filter" id="filter" class="form-control border-custom">
                            <option value=""> All </option>
                            <option value="due_dates" {{$filter == 'due_dates' ? 'selected' : null}}> Upcoming Due Dates </option>
                            <option value="unreturned" {{$filter == 'unreturned' ? 'selected' : null}}> Unreturned Books </option>
                            <option value="pending" {{$filter == 'pending' ? 'selected' : null}}> Pending Requests </option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        @if ($filter)
                             <a href="{{route('request-book.index')}}" class="btn btn-secondary mt-4"> Clear </a>
                        @endif
                        <button class="btn btn-primary mt-4"> Apply Filter </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card bg-secondary shadow m-2">
         <div class="card-header bg-white border-0">
            <strong> <i class="fas fa-clipboard-list"></i> Requests to Borrow Books </strong> - 
            @if ($filter == 'due_dates')
                Upcoming Due Dates
            @endif
            @if ($filter == 'unreturned')
                Unreturned Books
            @endif
            @if ($filter == 'pending')
                Pending Requests
            @endif
            @if ($filter == null)
                All
            @endif
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <small> Showing {{ $requests->firstItem() }} to {{ $requests->lastItem() }} of {{ $requests->total() }} records </small>
                <table class="table align-items-center mt-1">
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
                                <td> {{$request->start_date->format('Y-m-d')}} </td>
                                <td>
                                    @if ($filter == 'due_dates') 
                                        <strong> {{$request->end_date->format('Y-m-d')}}  </strong>
                                    @else
                                        {{$request->end_date->format('Y-m-d')}} 
                                    @endif
                                </td>
                                <td>
                                    @if ($request->approved_at == null)
                                        <span class="text-muted"> Pending </span>
                                    @else
                                        <span class="text-success"> Approved </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($request->approved_at)
                                        @if ($request->returned_at == null)
                                            <span class="text-warning"> No </span>
                                        @else
                                            <span class="text-primary"> Yes </span>
                                            @if ($request->returned_at > $request->end_date)
                                                <br>
                                                <small class="text-warning"> Overdue </small>
                                            @endif
                                        @endif
                                    @else
                                        <span class="text-dark"> -- </span>
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
                <br>
                {{$requests->links()}}
            </div>
        </div>
    </div>

    <script>
      
    </script>
@endsection

