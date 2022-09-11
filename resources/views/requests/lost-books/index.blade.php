@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Lost Books </li>
        </ol>
    </nav>
   
    <div class="card bg-secondary shadow m-2">
         <div class="card-header bg-white border-0">
            <strong> Lost Book Report Index </strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <small> Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} records </small>
                <table class="table align-items-center mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Date</th>
                            <th scope="col">Reported at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($reports as $report)
                           <tr>
                                <td> {{$report->subject}} </td>
                                <td> {{$report->date_of_incident->format('Y-m-d')}} </td>
                                <td> {{$report->created_at->format('Y-m-d H:i A')}} </td>
                                <td>
                                    @if ($report->approved_at)
                                        <span class="text-success"> Approved </span>
                                    @else
                                        <span class="text-muted"> Pending </span>
                                    @endif
                                </td>
                                <td> <a href="{{route('lost-books.show',$report)}}"> <i class="fas fa-eye"></i> View more </a></td>
                           </tr>
                       @empty
                           <tr>
                                <td colspan="2"> No record found </td>
                           </tr>
                       @endforelse
                    </tbody>
                </table>
                <br>
                {{$reports->links()}}
            </div>
        </div>
    </div>

    <script>
      
    </script>
@endsection

