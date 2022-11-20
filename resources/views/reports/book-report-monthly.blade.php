@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('reports.index')}}"> Reports </a></li>
            <li class="breadcrumb-item"><a href="{{route('reports.borrowed-book.index')}}"> Borrowed Books Report </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Borrowed Books Report Monthly </li>
        </ol>
    </nav>

    <div class="mt-3">
        <div class="card  shadow-sm border-custom mt-3">
            <div class="card-header">
                <strong> Monthly Data - Chart</strong> 
            </div>
            <div class="card-body bg-secondary">
                <textarea id='dailyJson' hidden> {{$daily}} </textarea>
                <div class="mt-3 mb-3">
                     <canvas id="myBarChart" class="bg-white mt-1 border border-custom p-2" width="350" height="100"></canvas> 
                </div>
                {{-- <table class="table align-items-center bg-white border-custom">
                    <thead>
                        <tr>
                            <th scope="col"> Book </th>
                            <th scope="col"> Borrower </th>
                            <th scope="col"> Status </th>
                            <th scope="col"> Verified By / Approver </th>
                            <th scope="col"> Start - End </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_requested_data as $request_book)
                            <tr>
                                <td> 
                                    <i class="fas fa-book"></i> {{$request_book->book->title}} 
                                    <br>
                                    ISBN# {{$request_book->book->isbn}}
                                </td>
                                <td> <i class="fas fa-user"></i> {{$request_book->user->name}} </td>
                                <td>  
                                    @if ($request_book->approved_at)
                                        <span class="text-success"> Approved </span>
                                          -
                                        @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($request_book->end_date)) && $request_book->returned_at == null && $request_book->lost_at == null)
                                            <span class="text-danger"> Overdue </span>
                                        @elseif($request_book->returned_at == null && $request_book->lost_at == null && $request_book->approved_at)
                                            <span class="text-info"> Borrowed </span>
                                        @elseif($request_book->returned_at && $request_book->approved_at)
                                            <span class="text-primary"> Returned </span>
                                        @elseif($request_book->lost_at && $request_book->approved_at )
                                            <span class="text-danger"> Lost </span>
                                        @endif
                                    @else
                                        <span class="text-muted"> Pending </span>
                                    @endif
                                  
                                </td>
                                <td>
                                    @if ($request_book->approverAccount)
                                        {{$request_book->approverAccount ? $request_book->approverAccount->name : 'n/a'}}
                                        <br> {{ $request_book->approved_at->format('Y-m-d') }}
                                    @else
                                        --
                                    @endif
                           
                                </td>
                                <td> {{ $request_book->start_date->format('Y-m-d') }} <strong class="ml-3 mr-3"> <i class="fas fa-caret-right"></i> </strong> {{ $request_book->end_date->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> No records found in this month </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table> --}}
            </div>
        </div>
        <div class="card  shadow-sm border-custom mt-3">
            <div class="card-header">
                <strong> Monthly Data - Table</strong> 
            </div>
            <div class="card-body bg-secondary">
                @foreach (json_decode($daily) as $data)
                    <div class="mt-2">
                        <div class="card border-custom">
                            <div class="card-body">
                                <strong class="text-muted"> <i class="fas fa-calendar-alt"></i> {{$data->date}} </strong>
                                @if (!empty($data->data))
                                <table class="table table-sm mt-3 align-items-center bg-white border-custom">
                                   <thead>
                                        <tr>
                                            <th scope="col"> Book </th>
                                            <th scope="col"> Borrower </th>
                                            <th scope="col"> Status </th>
                                            <th scope="col"> Verified By / Approver </th>
                                            <th scope="col"> Start - End </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->data as $request_book)
                                           <tr>
                                                <td> 
                                                    <i class="fas fa-book"></i> {{$request_book->book->title}} 
                                                    <br>
                                                    ISBN# {{$request_book->book->isbn}}
                                                </td>
                                                <td> <i class="fas fa-user"></i> {{$request_book->user->name}} </td>
                                                <td>  
                                                    @if ($request_book->approved_at)
                                                        <span class="text-success"> Approved </span>
                                                        -
                                                        @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($request_book->end_date)) && $request_book->returned_at == null && $request_book->lost_at == null)
                                                            <span class="text-danger"> Overdue </span>
                                                        @elseif($request_book->returned_at == null && $request_book->lost_at == null && $request_book->approved_at)
                                                            <span class="text-info"> Borrowed </span>
                                                        @elseif($request_book->returned_at && $request_book->approved_at)
                                                            <span class="text-primary"> Returned </span>
                                                        @elseif($request_book->lost_at && $request_book->approved_at )
                                                            <span class="text-danger"> Lost </span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted"> Pending </span>
                                                    @endif
                                                
                                                </td>
                                                <td>
                                                    @if ($request_book->approver_account)
                                                        {{$request_book->approver_account ? $request_book->approver_account->name : 'n/a'}}
                                                        <br> {{ Carbon\Carbon::parse($request_book->approved_at)->format('Y-m-d') }}
                                                    @else
                                                        --
                                                    @endif
                                        
                                                </td>
                                                <td> {{ Carbon\Carbon::parse($request_book->start_date)->format('Y-m-d') }} <strong class="ml-3 mr-3"> <i class="fas fa-caret-right"></i> </strong> {{ Carbon\Carbon::parse($request_book->end_date)->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                  
                                   
                               
                                @else
                                    No data
                                @endif
                            </div>
                        </div>
                  
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>

    <script>

        var daily = JSON.parse(document.getElementById("dailyJson").value);

        var date = []
        var total = []
        var approved = []
        var lost = []

        daily.forEach((data) => {
            date.push(data.date)
            total.push(data.total_count)
            approved.push(data.approved_count)
            lost.push(data.lost_count)
        });

        console.log(date);
        console.log(total);
        console.log(approved);
        console.log(lost);


        callChart()
        function callChart(){
            var ctx = document.getElementById("myBarChart");
            new Chart(ctx, {
                type: 'line',
                borderWidth: 2,
                data: {
                    labels: date,
                    datasets: [
                        { 
                            data: total,
                            label: "Total Books Requested Per Day",
                            backgroundColor: ['rgba(63, 158, 237 , 0.2)'], 
                            borderColor:['rgb(0, 126, 225)']
                        },
                        { 
                            data: approved,
                            label: "Approved Books Per Day",
                            backgroundColor: ['rgba(80, 174, 19)'], 
                            borderColor:['rgb(80, 174, 19)']
                        },
                        { 
                            data: lost,
                            label: "Lost Books Per Day",
                            backgroundColor: ["rgba(255, 99, 132, 0.2)"], 
                            borderColor:["rgb(255, 99, 132)"]
                        }
                    ]
                },
                options: {
                    title: {
                    display: true,
                        text: 'No. of Borrowed Books'
                    },
                    scales: {
                        x: {
                            grid: {
                            display: false
                            }
                        },
                      
                    }
                }
            });
        }
    </script>
@endsection
