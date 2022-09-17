@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Borrowed Books </li>
        </ol>
    </nav>

    <div class="row p-3">
        <a href="{{route('lost-books.index')}}" class="btn btn-warning border-custom ml-2"> <i class="fas fa-times-circle"></i> Lost Books </a>
    </div>
   
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
                            <option value="lost" {{$filter == 'lost' ? 'selected' : null}}> Lost Book Requests </option>
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
                @if ($requests->count() != 0)
                    <button class="btn btn-warning border-custom float-right" onclick="sendEmailNotifications()">
                        <i class="fas fa-envelope-open-text"></i> Send email notifications
                    </button>
                @endif
            @endif
            @if ($filter == 'unreturned')
                Unreturned Books
            @endif
            @if ($filter == 'pending')
                Pending Requests
            @endif
            @if ($filter == 'lost')
                Lost Book Requests
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
                            <th scope="col"></th>
                            <th scope="col">User</th>
                            <th scope="col">Book</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Returned Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td class="text-center">
                                    @if (Carbon\Carbon::now()->gt($request->end_date) && $request->returned_at == null && $request->lost_at == null)
                                        <i class="fas fa-exclamation-circle text-danger"></i> <br> <small class="text-danger"> Overdue </small>
                                    @elseif($request->returned_at == null && $request->lost_at == null && $request->approved_at)
                                        <i class="fas fa-check-circle text-success"> </i> <br> <small class="text-success"> Borrowed </small>
                                    @endif
                                </td>
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
                                            <span class="text-muted"> No </span>
                                            @if ($request->lost_at)
                                                <br>
                                                <small class="text-warning"> Lost </small>
                                            @endif
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

        <!-- Modal confirm request -->
    <form action="{{route('notification.send-email')}}" method="post">
        @csrf
        @method('POST')
        <div class="modal fade" id="email-notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Send Email Notifications </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <small class="text-muted"> Title (optional) </small>
                            <input type="text" name="title" id="email-subject" class="form-control border-custom">
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Body (optional) </small>
                            <textarea type="text" name="body" id="email-body" rows="8" class="form-control border-custom">  </textarea>
                        </div>
                        <small> The following users will be notified via emails. If you put an empty <strong>Subject & Body</strong>, It will send an auto generated message. </small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal"> Close </button>
                        <button type="submit" class="btn btn-primary border-custom" id="btn-borrow"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    

    <script>
        function sendEmailNotifications(){
 
                $('#email-notification').modal('show');
        }
    </script>
@endsection

