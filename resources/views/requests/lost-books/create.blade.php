@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"> Lost Books </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Create Report </li>
        </ol>
    </nav>
   
    <form action="{{route('lost-books.save')}}" id="submitReport" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow m-2">
            <div class="card-header bg-white border-0">
                <strong> Create Incident Report </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Subject </small>
                            <input type="text" name="subject" id="subject" class="form-control border-custom" value="{{'Lost book - '.$requested_book->book->title.' - ISBN #'.$requested_book->book->isbn}}" {{$requested_book ? 'readonly' : null }} required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Date of incident </small>
                            <input type="date" name="date" id="date" class="form-control border-custom" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Description </small>
                    <textarea  name="description" id="description" class="form-control border-custom" rows="10" required> Write something... </textarea>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Attachment </small>
                    <input type="file" name="file" id="file" class="form-control border-custom">
                </div>
                <input type="hidden" name="requested_book_id" id="requested_book_id" value="{{$requested_book->id}}">
                <input type="hidden" name="book_id" id="book_id" value="{{$requested_book->book_id}}">
                <a href="{{route('request-book.index')}}" class="btn btn-white border-custom"> Cancel </a>
                <button type="button" class="btn btn-success border-custom" onclick="submitReportConfirmation()"> Submit Report </button>
            </div>
        </div>
    </form>

    <!-- Modal confirm submit -->
    <div class="modal fade" id="confirm-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Confirm Submission </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to submit this incident report? The reported book will be mark as lost.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary border-custom" id="btn-borrow" onclick="submitReport()"> Confirm </button>
                </div>
            </div>
        </div>
    </div>
  

    <script>
        function submitReportConfirmation(){
            $('#confirm-report').modal('show');
        }
        function submitReport(){
            document.getElementById("submitReport").submit();
        }
    </script>
@endsection

