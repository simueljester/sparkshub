@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('reports.index')}}"> Reports </a></li>
            <li class="breadcrumb-item active" aria-current="page">User Reports</li>
        </ol>
    </nav>

   <div class="row p-2">
        <div class="col-sm-9">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                    <strong> <i class="fas fa-user-clock"></i> User Logs </strong>
                </div>
                <div class="card-body">
                    <form action="">
                          <div class="input-daterange datepicker row align-items-center">
                            <div class="col-sm-5">
                                <div class="form-group mt-4">
                                    <small class="text-muted"> Start Date </small>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control" name="start_date" placeholder="Start date" type="text" value="{{Carbon\Carbon::parse($start_date)->format('m/d/Y') ?? date('m/d/Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group mt-4">
                                    <small class="text-muted"> End Date </small>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control" name="end_date" placeholder="End date" type="text" value="{{Carbon\Carbon::parse($end_date)->format('m/d/Y') ?? date('m/d/Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary border-custom btn-block mt-4"> Filter Dates </button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <small> Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} records </small>
                        <table class="table align-items-center mt-2">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">User</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Student No</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Ip Address</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">User Agent</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr>
                                        <td> <img id="output" style="border-radius: 50%;" width="25" height="25" src="{{ $log->user->avatar ? '/images/'.$log->user->avatar : Avatar::create($log->user->name)->toBase64() }}" /> </td>
                                        <td> {{$log->user->name}} </td>
                                        <td> {{$log->created_at->format('Y-m-d H:i:s')}} </td>
                                        <td> {{$log->user->student_number ?? '--'}} </td>
                                        <td> {{$log->user->role}} </td>
                                        <td> {{$log->ip_address}} </td>
                                        <td> {{ gmdate("H:i:s", $log->created_at->diffInSeconds($log->last_activity)); }} </td>
                                        <td> 
                                            <?php 

                                                //First get the platform?
                                                if (preg_match('/linux/i', $log->user_agent)) {
                                                    $platform = 'Linux';
                                                }
                                                elseif (preg_match('/macintosh|mac os x/i', $log->user_agent)) {
                                                    $platform = 'Mac';
                                                }
                                                elseif (preg_match('/windows|win32/i', $log->user_agent)) {
                                                    $platform = 'Windows';
                                                }

                                                // Next get the name of the useragent yes seperately and for good reason
                                                if(preg_match('/MSIE/i',$log->user_agent) && !preg_match('/Opera/i',$login->user_agent))
                                                {
                                                    $bname = 'Internet Explorer';
                                                    $ub = "MSIE";
                                                }
                                                elseif(preg_match('/Firefox/i',$log->user_agent))
                                                {
                                                    $bname = 'Mozilla Firefox';
                                                    $ub = "Firefox";
                                                }
                                                elseif(preg_match('/Chrome/i',$log->user_agent))
                                                {
                                                    $bname = 'Google Chrome';
                                                    $ub = "Chrome";
                                                }
                                                elseif(preg_match('/Safari/i',$log->user_agent))
                                                {
                                                    $bname = 'Apple Safari';
                                                    $ub = "Safari";
                                                }
                                                elseif(preg_match('/Opera/i',$log->user_agent))
                                                {
                                                    $bname = 'Opera';
                                                    $ub = "Opera";
                                                }
                                                elseif(preg_match('/Netscape/i',$log->user_agent))
                                                {
                                                    $bname = 'Netscape';
                                                    $ub = "Netscape";
                                                }else{
                                                    $bname = 'Other Browser';
                                                    $ub = "Other Browser";
                                                }
                                            ?>
                                            <i class="fas fa-desktop"></i> {{$platform}} / <i class="fas fa-globe"></i> {{$bname}} 
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"> No records found </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$logs->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                <strong> <i class="fas fa-users"></i> Users Created </strong>
                </div>
                <div class="card-body">
                    <center> <canvas id="myChart" width="350"></canvas> </center>
                </div>
            </div>
        </div>
   </div>


    {{-- donut data  --}}
    <input type="hidden" name="librarian_count" id="librarian_count" value="{{$role_counts->librarians}}">
    <input type="hidden" name="student_count" id="student_count" value="{{$role_counts->students}}">
    <input type="hidden" name="teacher_count" id="teacher_count" value="{{$role_counts->teachers}}">
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
<script>
    callDonutChart()
    function callDonutChart(){
        var librarians = document.getElementById('librarian_count').value;
        var students = document.getElementById('student_count').value;
        var teachers = document.getElementById('teacher_count').value;
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Librarians','Student', 'Teachers'],
                datasets: [{
                    data: [librarians,students,teachers],
                    backgroundColor: [
                        'rgb(254, 160, 23)',
                        'rgb(254, 201, 110)',
                        'rgb(212, 126, 3 )'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                 legend: {
              display: false
            },
                //cutoutPercentage: 40,
                responsive: true,
                

            }
        });
    }
</script>
@endsection

