@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('lost-books.index')}}"> Lost Books </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Show Report </li>
        </ol>
    </nav>
   
    <form action="#" id="submitReport" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow m-2">
            <div class="card-header bg-white border-0">
                <strong> Incident Report </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 h-100">
                        <small class="text-dark"> <i class="fas fa-user"></i> Incident Information </small>
                        <hr>
                        <div class="mt-1"> <strong> Subject: </strong> {{$lost_book->subject}} </div>
                        <div class="mt-1"> <strong> Description: </strong> <br> {{$lost_book->description}} </div>
                        <div class="mt-1"> <strong> Date of Incident: </strong> {{$lost_book->date_of_incident->format('F d, Y')}} </div>
                        <div class="mt-1"> <strong> Attachment: </strong> 
                            @if ($lost_book->file)
                                 <a target="_blank" href="{{route('lost-books.download-attachment',$lost_book)}}"> <i class="fas fa-paperclip"></i> {{$lost_book->file}} </a>
                            @else
                                No attachment
                            @endif
                        </div>
                        <div class="mt-1"> <strong> Reported at: </strong> {{$lost_book->created_at->format('F d, Y')}} </div>
                        <div class="mt-1"> <strong> Status: </strong>
                            @if ($lost_book->approved_at)
                                <span class="text-success"> Approved </span>
                            @else
                                <span class="text-muted"> Pending </span>
                            @endif
                        </div>
                        @if (Auth::user()->role == 'librarian' || Auth::user()->role == 'admin')
                            <br>
                            @if ($lost_book->approved_at == null)
                                <a href="{{route('lost-books.approve',$lost_book)}}" class="btn btn-success border-custom"> Approve </a>
                            @endif
                            <br>
                            <hr>
                            <span class="text-muted"> This user ({{$lost_book->user->name}}) has <strong class="text-danger">{{$lost_book->user->filedReports->count()}}</strong> filed lost books. You may contact the administrator for temporarily deactivation of this account. </span>
                        @endif

                    </div>
                    <div class="col-sm-6 h-100">
                        <small class="text-dark"> <i class="fas fa-clipboard-list"></i> Request Information </small>
                        <hr>
                        <div class="mt-1"> <strong> Message: </strong> {{$lost_book->requestedBook->message ?? 'No message indicated'}} </div>
                        <div class="mt-1"> <strong> Start Date: </strong> {{$lost_book->requestedBook->start_date->format('F d, Y - h:i A')}} </div>
                        <div class="mt-1"> <strong> End Date: </strong> {{$lost_book->requestedBook->end_date->format('F d, Y - h:i A')}} </div>
                        <div class="mt-1"> <strong> Approve Date: </strong> <span class="{{$lost_book->requestedBook->approved_at ? 'text-primary' : 'text-danger'}}"> {{$lost_book->requestedBook->approved_at ? $lost_book->requestedBook->approved_at->format('F d, Y - h:i A')  : 'pending'}} </span> </div>
                        <div class="mt-1"> <strong> Approver: </strong> <span class="{{$lost_book->requestedBook->approver ? 'text-primary' : 'text-danger'}}">  {{$lost_book->requestedBook->approver ? $lost_book->requestedBook->approverAccount->name.' - '.$lost_book->requestedBook->approverAccount->role   : 'pending'}} </span> </div>
                        <br>
                        <br>
                        <small class="text-dark"> <i class="fas fa-book"></i> Book Information </small>
                        <hr>
                        <div class="mt-1"> <strong> Title: </strong> {{$lost_book->book->title}} </div>
                        <div class="mt-1"> <strong> Category: </strong> {{$lost_book->book->category->name}} </div>
                        <div class="mt-1"> <strong> ISBN: </strong> {{$lost_book->book->isbn}} </div>
                        <div class="mt-1"> <strong> Author: </strong> {{$lost_book->book->author}} </div>
                        <div class="mt-1"> <strong> Remaining Copies: </strong> {{$lost_book->book->copies}} </div>
                        <div class="mt-1"> <strong> Original Copies: </strong> {{$lost_book->book->copies + 1}} </div>
                        <br>
                        <br>
                        <small class="text-dark"> <i class="fas fa-user"></i> User Information </small>
                        <hr>
                        <div class="mt-1"> <strong> First Name: </strong> {{$lost_book->user->fname}} </div>
                        <div class="mt-1"> <strong> Last Name: </strong> {{$lost_book->user->lname}} </div>
                        <div class="mt-1"> <strong> Student No: </strong> {{$lost_book->user->student_number ?? 'n/a'}} </div>
                        <div class="mt-1"> <strong> Role: </strong> {{$lost_book->user->role}} </div>
                        <div class="mt-1"> <strong> Email: </strong> {{$lost_book->user->email}} </div>
                    </div>
                </div>
                <br>
                <br>
                {{-- <button type="button" class="btn btn-success border-custom" onclick="submitReportConfirmation()"> Submit Report </button> --}}
            </div>
        </div>
    </form>

    <!-- Modal confirm submit -->
    {{-- <div class="modal fade" id="confirm-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Confirm Submission </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to submit this incident report?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary border-custom" id="btn-borrow" onclick="submitReport()"> Confirm </button>
                </div>
            </div>
        </div>
    </div> --}}
  

    <script>
   
    </script>
@endsection

