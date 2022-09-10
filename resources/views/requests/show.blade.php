@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('request-book.index')}}">Borrowed Books</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Show </li>
        </ol>
    </nav>
 
    <div class="card bg-secondary shadow mt-3">
        <div class="card-header bg-white border-0">
            <strong> Show Request </strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <small class="text-dark"> <i class="fas fa-user"></i> User Information </small>
                    <hr>
                    <div class="mt-1"> <strong> First Name: </strong> {{$requested_book->user->fname}} </div>
                    <div class="mt-1"> <strong> Last Name: </strong> {{$requested_book->user->lname}} </div>
                    <div class="mt-1"> <strong> Student No: </strong> {{$requested_book->user->student_number ?? 'n/a'}} </div>
                    <div class="mt-1"> <strong> Role: </strong> {{$requested_book->user->role}} </div>
                    <div class="mt-1"> <strong> Email: </strong> {{$requested_book->user->email}} </div>
                </div>
                <div class="col-sm-6">
                    <small class="text-dark"> <i class="fas fa-book"></i> Book Information </small>
                    <hr>
                    <div class="mt-1"> <strong> Title: </strong> {{$requested_book->book->title}} </div>
                    <div class="mt-1"> <strong> Category: </strong> {{$requested_book->book->category->name}} </div>
                    <div class="mt-1"> <strong> ISBN: </strong> {{$requested_book->book->isbn}} </div>
                    <div class="mt-1"> <strong> Author: </strong> {{$requested_book->book->author}} </div>
                    <div class="mt-1"> <strong> Copies Available: </strong> {{$requested_book->book->copies}} </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <small class="text-dark"> <i class="fas fa-clipboard-list"></i> Request Information </small>
                    <hr>
                    <div class="mt-1"> <strong> Message: </strong> {{$requested_book->message ?? 'No message indicated'}} </div>
                    <div class="mt-1"> <strong> Start Date: </strong> {{$requested_book->start_date->format('F d, Y - h:i A')}} </div>
                    <div class="mt-1"> <strong> End Date: </strong> {{$requested_book->end_date->format('F d, Y - h:i A')}} </div>
                    <div class="mt-1"> <strong> Approve Date: </strong> <span class="{{$requested_book->approved_at ? 'text-primary' : 'text-danger'}}"> {{$requested_book->approved_at ? $requested_book->approved_at->format('F d, Y - h:i A')  : 'pending'}} </span> </div>
                    <div class="mt-1"> <strong> Approver: </strong> <span class="{{$requested_book->approver ? 'text-primary' : 'text-danger'}}">  {{$requested_book->approver ? $requested_book->approverAccount->name.' - '.$requested_book->approverAccount->role   : 'pending'}} </span> </div>
                    <div class="mt-1"> <strong> Returned Date: </strong> <span class="{{$requested_book->returned_at ? 'text-primary' : 'text-danger'}}">  {{$requested_book->returned_at ? $requested_book->returned_at->format('F d, Y  h:i A') : 'pending'}} </span> </div>
                    <div class="mt-1"> <strong> Borrowed Duration: </strong> <span class="{{$requested_book->duration ? 'text-primary' : 'text-danger'}}">  {{$requested_book->duration ? Carbon\CarbonInterval::seconds($requested_book->duration)->cascade()->forHumans() : 'pending'}} </span> </div>
                </div>
                @if (Auth::user()->role == 'librarian')
                    <div class="col-sm-6">
                        <small class="text-dark"> <i class="fas fa-clipboard-list"></i> Action </small>
                        <hr>
                        @if ($requested_book->approved_at)
                            <div class="mt-1">
                                <span class="text-success" style="font-size:30px;font-weight:bold"> Approved </span>
                                <span class="ml-3" style="font-size:22px;font-weight:bold"> <i class="fas fa-arrow-alt-circle-right"></i> </span>
                                @if ($requested_book->returned_at)
                                    <span class="text-primary ml-3" style="font-size:30px;font-weight:bold"> Returned </span> 
                                    @if ($requested_book->returned_at > $requested_book->end_date)
                                        <small class="text-danger"> Overdue</small>
                                    @endif
                                   
                                @else
                                    <span class="text-muted ml-3" style="font-size:30px;font-weight:bold"> Unreturned </span>
                                    <div class="mt-5">
                                        <button type="button" onclick="showReturnedConfirmation()" class="btn btn-success border-custom"> Mark as Returned </button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mt-1">
                                <span class="text-muted" style="font-size:30px;font-weight:bold"> Pending </span>
                            </div>
                            <div class="mt-5">
                                <button type="button" onclick="showApproveConfirmation()" class="btn btn-success border-custom"> Approve </button>
                            </div>  
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal confirm approve -->
    <form action="{{route('request-book.approve')}}" method="post">
        @csrf
        @method('POST')
        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Confirm Approval </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <small class="text-muted"> Select date of approval </small>
                            <input type="datetime-local" class="form-control" name="approval_date" id="approval_date" value="<?php echo Date('Y-m-d\TH:i',time()) ?>">
                        </div>
                        <span> Are you sure you want to approve this request? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="requested_book" id="requested_book" value="{{$requested_book->id}}">
                        <button type="submit" class="btn btn-primary border-custom" id="btn-borrow"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal confirm returned -->
    <form action="{{route('request-book.returned')}}" method="post">
        @csrf
        @method('POST')
        <div class="modal fade" id="confirm-returned-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Confirm Returned </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <small class="text-muted"> Select date of return </small>
                            <input type="datetime-local" class="form-control" name="returned_date" id="returned_date" value="<?php echo Date('Y-m-d\TH:i',time()) ?>">
                        </div>
                        <span> Are you sure you want to mark this request as returned? </span>
                    
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="requested_book" id="requested_book" value="{{$requested_book->id}}">
                        <button type="submit" class="btn btn-primary border-custom" id="btn-borrow"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showApproveConfirmation(){
            $('#confirm-modal').modal('show');
        }
        function showReturnedConfirmation(){
            $('#confirm-returned-modal').modal('show');
        }
    </script>

@endsection

@push('js')
    
@endpush