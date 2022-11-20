@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('reports.index')}}"> Reports </a></li>
            <li class="breadcrumb-item"><a href="{{route('reports.module.index')}}"> Module Reports </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Module Reports Monthly </li>
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
                                            <th scope="col"> Module </th>
                                            <th scope="col"> Subject </th>
                                            <th scope="col"> Status </th>
                                            <th scope="col"> Verified by / Approver </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->data as $request_module)
                                           <tr>
                                                <td> 
                                                    {{$request_module->title}}
                                                </td>
                                                <td> {{$request_module->subject->name}} </td>
                                                <td>  
                                                    @if ($request_module->approved_at)
                                                        <span class="text-success"> Approved </span>
                                                    
                                                    @else
                                                        <span class="text-muted"> Pending </span>
                                                    @endif
                                                
                                                </td>
                                                <td>
                                                    @if ($request_module->approver_account)
                                                        {{$request_module->approver_account ? $request_module->approver_account->name : 'n/a'}}
                                                        <br> {{ Carbon\Carbon::parse($request_module->approved_at)->format('Y-m-d') }}
                                                    @else
                                                        --
                                                    @endif
                                        
                                                </td>
                                               
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

        daily.forEach((data) => {
            date.push(data.date)
            total.push(data.total_count)
            approved.push(data.approved_count)
        });


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
                            label: "Total Modules Created Per Day",
                            backgroundColor: ['rgba(63, 158, 237 , 0.2)'], 
                            borderColor:['rgb(0, 126, 225)']
                        },
                        { 
                            data: approved,
                            label: "Approved Modules Per Day",
                            backgroundColor: ['rgba(80, 174, 19)'], 
                            borderColor:['rgb(80, 174, 19)']
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
