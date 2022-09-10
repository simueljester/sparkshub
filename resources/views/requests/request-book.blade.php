@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('library.index')}}">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Request to Borrow </li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-sm-4">
              <div class="card bg-secondary shadow m-2">
                <div class="card-header bg-white border-0">
                    <strong> <i class="fas fa-book"></i> Book Information </strong>
                </div>
                <div class="card-body text-center">
                    <div> <i class="fas fa-book fa-5x text-warning"></i> </div>
                    <br>
                    <div class="mt-2"> <strong class="text-warning text-capitalize" style="font-size:22px;" id="book-title"> {{$book->title}} </strong> </div>
                    <div class="mt-1 text-muted"> By <span class="text-muted" id="book-author"> {{$book->author}} </span> </div>
                    <br>
                    <small> Additional Information </small>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mt-1 text-muted"> 
                                <br>
                                <span id="copies" class="text-dark"> {{$book->copies}} </span> <br>
                                <small> Copies Available: </small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-1 text-muted"> 
                                <br>
                                <span id="category" class="text-dark"> {{$book->category->name}} </span> <br>
                                <small> Category: </small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-1 text-muted"> 
                                <br>
                                <span id="publication-date" class="text-dark"> {{Carbon\Carbon::parse($book->publication_date)->format('Y-m-d')}} </span> <br>
                                <small> Publication Date: </small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-1 text-muted"> 
                                <br>
                                <span id="isbn" class="text-dark"> {{$book->isbn}} </span> <br>
                                <small> ISBN: </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card bg-secondary shadow m-2">
                <div class="card-header bg-white border-0">
                    <strong> <i class="fas fa-user-edit"></i> Request Form </strong>
                </div>
                <div class="card-body">
                    <small class="text-dark"> Requestor Information </small>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> First Name </small>
                                <input type="text" id="fname" class="form-control border-custom" value="{{Auth::user()->fname}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> Last Name </small>
                                <input type="text" id="lname" class="form-control border-custom" value="{{Auth::user()->lname}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <small class="text-muted"> Student No. </small>
                        <input type="text" id="student_no" class="form-control border-custom" value="{{Auth::user()->student_number ?? 'n/a'}}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> Email Address </small>
                                <input type="text" id="email" class="form-control border-custom" value="{{Auth::user()->email}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> Role </small>
                                <input type="text" id="role" class="form-control border-custom" value="{{Auth::user()->role}}" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <small class="text-dark"> Fill up Information </small>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> Start Date </small>
                                <input type="text" id="start_date" class="form-control border-custom" value="<?php echo date('m/d/Y'); ?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-muted"> End Date </small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control datepicker" placeholder="Select date" type="text" id="end_date" value="<?php echo date('m/d/Y'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <small class="text-muted"> Request Message (optional) </small>
                        <textarea name="message" id="message" cols="30" rows="5" class="form-control border-custom"></textarea>
                    </div>
                    <a href="{{route('library.index')}}" class="btn btn-outline-secondary border-custom"> Cancel </a>
                    <button onclick="showBorrowConfirmation()" class="btn btn-success border-custom" id="btn-request-borrow"> Request to Borrow </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Required Field dates  --}}
    <div class="modal fade" id="required-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Error </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="text-muted" id="required-message"> Unable to request. Please fill up required fields </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary border-custom" data-dismiss="modal"> Got it! </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirm request -->
    <form action="{{route('request-book.save-request')}}" method="post">
        @csrf
        @method('POST')
        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Confirm Book Request </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <span> Are you sure you want to request this book? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="book_id" id="confirm_book_id" value="{{$book->id}}">
                        <input type="hidden" name="user_id" id="confirm_user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="end_date" id="confirm_end_date">
                        <textarea hidden name="message" id="confirm_message" cols="30" rows="10"></textarea>
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal"> Close </button>
                        <button type="submit" class="btn btn-primary border-custom" id="btn-borrow"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
 
    <script>
        function showBorrowConfirmation(){
            var start = new Date($('#start_date').val());
            var end =   new Date($('#end_date').val()); 
            var now =   new Date();
            now.setHours(0,0,0,0);
            if(isNaN(start) || isNaN(end)){
                $('#required-modal').modal('show');
                $('#required-message').html('Please fill up all necessary fields');
            }else if((start > end)) {
                $('#required-modal').modal('show');
                $('#required-message').html('End date must be greater than start date');
            }
            else if((start < now)) {
                $('#required-modal').modal('show');
                $('#required-message').html('Past date is prohibited');
            }
            else{
                $('#confirm_end_date').val(end.toDateString());
                var msg = $('#message').val();
                 $('#confirm_message').val(msg);
                
                $('#confirm-modal').modal('show');
                
            }
      
        }
    </script>
@endsection

