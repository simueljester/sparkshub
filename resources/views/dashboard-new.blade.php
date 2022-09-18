@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row">

        <div class="col-sm-4">
            <a href="{{route('books.index')}}">
                <div class="card border-custom shadow-sm text-center text-white mt-3 bg-gradient-primary">
                    <div class="card-body">
                        <strong style="font-size:25px;"> {{$counts->books}} </strong>
                        <br>
                        <i class="fas fa-book"></i> Total Books
                    </div>
                </div>
            </a>

        </div>
        <div class="col-sm-4">
            <a href="{{route('modules.index')}}">
                <div class="card border-custom shadow-sm text-center text-white mt-3 bg-gradient-primary">
                    <div class="card-body">
                        <strong style="font-size:25px;"> {{$counts->modules}} </strong>
                        <br>
                        <i class="far fa-file-alt"></i> Total Modules
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('users.index')}}">
                <div class="card border-custom shadow-sm text-center text-white mt-3 bg-gradient-primary">
                    <div class="card-body">
                        <strong style="font-size:25px;"> {{$counts->users}} </strong>
                        <br>
                        <i class="fas fa-users"></i> Total Users
                    </div>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow-sm border-custom mt-3">
                <div class="card-body">
                    <center>
                        <strong class="text-muted"> For the Year of {{$filter_year}} </strong> 
                        <i class="fas fa-cog text-warning" style="cursor: pointer;" onclick="showYearFilterModal()"></i>
                        <canvas id="myLineChart" width="350""></canvas> 
                    </center>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-sm border-custom mt-3">
                <div class="card-body">
                     <center> <canvas id="myChart" width="350"></canvas> </center>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Filter Year  --}}
    <form action="">
        <div class="modal fade" id="show-year-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Filter Year </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <small class="text-muted"> Select Year </small>
                            <select name="filter_year" id="filter_year" class="form-control">
                                {{ $last= date('Y')-120 }}
                                {{ $now = date('Y') }}
                                @for ($i = $now; $i >= $last; $i--)
                                    <option value="{{ $i }}" {{$filter_year == $i ? 'selected' : null}}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary border-custom"> Filter </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

  
    {{-- donut data  --}}
    <input type="hidden" name="librarian_count" id="librarian_count" value="{{$role_counts->librarians}}">
    <input type="hidden" name="student_count" id="student_count" value="{{$role_counts->students}}">
    <input type="hidden" name="teacher_count" id="teacher_count" value="{{$role_counts->teachers}}">

    {{-- line graph data  --}}
    <input type="hidden" name="jan" id="jan" value="{{$requested_books[1] ?? 0}}">
    <input type="hidden" name="feb" id="feb" value="{{$requested_books[2] ?? 0}}">
    <input type="hidden" name="mar" id="mar" value="{{$requested_books[3] ?? 0}}">
    <input type="hidden" name="apr" id="apr" value="{{$requested_books[4] ?? 0}}">
    <input type="hidden" name="may" id="may" value="{{$requested_books[5] ?? 0}}">
    <input type="hidden" name="jun" id="jun" value="{{$requested_books[6] ?? 0}}">
    <input type="hidden" name="jul" id="jul" value="{{$requested_books[7] ?? 0}}">
    <input type="hidden" name="aug" id="aug" value="{{$requested_books[8] ?? 0}}">
    <input type="hidden" name="sep" id="sep" value="{{$requested_books[9] ?? 0}}">
    <input type="hidden" name="oct" id="oct" value="{{$requested_books[10] ?? 0}}">
    <input type="hidden" name="nov" id="nov" value="{{$requested_books[11] ?? 0}}">
    <input type="hidden" name="dec" id="dec" value="{{$requested_books[12] ?? 0}}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>

<script>
    callDonutChart()
    callLineChart()

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

    function callLineChart(){
        var january     = JSON.parse(document.getElementById('jan').value).data ?? 0;
        var february    = JSON.parse(document.getElementById('feb').value).data ?? 0;
        var march       = JSON.parse(document.getElementById('mar').value).data ?? 0;
        var april       = JSON.parse(document.getElementById('apr').value).data ?? 0;
        var may         = JSON.parse(document.getElementById('may').value).data ?? 0;
        var june        = JSON.parse(document.getElementById('jun').value).data ?? 0;
        var july        = JSON.parse(document.getElementById('jul').value).data ?? 0;
        var august      = JSON.parse(document.getElementById('aug').value).data ?? 0;
        var september   = JSON.parse(document.getElementById('sep').value).data ?? 0;
        var october     = JSON.parse(document.getElementById('oct').value).data ?? 0;
        var november    = JSON.parse(document.getElementById('nov').value).data ?? 0;
        var december    = JSON.parse(document.getElementById('dec').value).data ?? 0;

        var ctx = document.getElementById("myLineChart");
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January','February','March','April','May','June','July','August','September','October','November','December'],
            datasets: [
                { 
                    data: [january,february,march,april,may,june,july,august,september,october,november,december],
                    label: "Books borrowed per month",
                    borderColor: "#3e95cd",
                    fill: false
                }
            ]
        },
        options: {
            title: {
            display: true,
                text: 'No. of Borrowed Books'
            }
        }
        });
    }

    function showYearFilterModal(){
        $('#show-year-modal').modal('show');
    }



</script>

@endsection

