@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('reports.index')}}"> Reports </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Borrowed Books Report </li>
        </ol>
    </nav>
    <a href="{{route('reports.borrowed-book.export')}}" class="btn btn-info border-custom"> <i class="fas fa-download"></i> Export Excel </a>
    <div class="card shadow-sm border-custom mt-3">
        <div class="card-header">
            <strong> <i class="fas fa-chart-bar"></i> Bar Chart View </strong>
        </div>
        <div class="card-body bg-secondary">
            <center>
                <strong class="text-muted"> For the Year of {{$filter_year}} </strong> 
                <i class="fas fa-cog text-primary" style="cursor: pointer;" onclick="showYearFilterModal()"></i>
                <canvas id="myBarChart" class="bg-white mt-1 border border-custom p-2" width="350" height="100"></canvas> 
            </center>
        </div>
    </div>

    <div class="card shadow-sm border-custom mt-3">
        <div class="card-header">
            <strong> <i class="fas fa-table"></i> Table View </strong>
        </div>
        <div class="card-body bg-secondary">
            <table class="table align-items-center bg-white border-custom">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[1,$filter_year])}}"> Jan </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[2,$filter_year])}}"> Feb </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[3,$filter_year])}}"> Mar </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[4,$filter_year])}}"> Apr </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[5,$filter_year])}}"> May </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[6,$filter_year])}}"> Jun </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[7,$filter_year])}}"> Jul </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[8,$filter_year])}}"> Aug </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[9,$filter_year])}}"> Sep </a> </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[10,$filter_year])}}"> Oct </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[11,$filter_year])}}"> Nov </a>  </th>
                        <th scope="col"> <a href="{{route('reports.borrowed-book.index.monthly',[12,$filter_year])}}"> Dec </a> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong class="text-primary" style="text-decoration: underline;"> Total Books Requested  </strong></td>
                        @foreach ($arr_requested_books as $requested )
                            <td> {{$requested}} </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong class="text-success"> Approved </strong></td>
                        @foreach ($arr_approved as $approved )
                            <td> {{$approved}} </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong class="text-danger"> Lost </strong></td>
                        @foreach ($arr_lost as $lost )
                            <td> {{$lost}} </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm border-custom mt-3 mb-3">
        <div class="card-header">
            <strong> General Report </strong>
        </div>
        <div class="card-body bg-secondary">
            <div class="row p-5">
                <div class="col-sm-4">
                    <div class="mb-3"> <strong class="text-muted small"> Most Borrowed Books </strong> </div> 
                    <table class="table align-items-center bg-white border-custom">
                        <thead>
                            <tr>
                                <th scope="col"> Book Name </th>
                                <th scope="col"> Borrowed Qty </th>
                                <th scope="col"> Year </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td> <i class="fas fa-book"></i> {{$book->title}} </td>
                                    <td> <strong> {{$book->borrowed_qty}} </strong>  </td>
                                    <td> {{$filter_year}}  </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"> No records found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3"> <strong class="text-muted small"> Most Borrower By Grade Level</strong> </div> 
                    <table class="table align-items-center bg-white border-custom">
                        <thead>
                            <tr>
                                <th scope="col"> Grade Level </th>
                                <th scope="col"> Borrowed Qty </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grade_levels as $key => $qty)
                                <tr>
                                    <td class="text-capitalize"> <i class="fas fa-user"></i> 
                                        @if ($key == 0)
                                            Non Student Borrower
                                        @else
                                            Grade {{$key}} 
                                        @endif
                                    </td>
                                    <td> <strong> {{$qty}}  </strong> </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"> No records found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3"> <strong class="text-muted small"> Most Borrower By User </strong> </div> 
                    <table class="table align-items-center bg-white border-custom">
                        <thead>
                            <tr>
                                <th scope="col"> User </th>
                                <th scope="col"> Borrowed Qty </th>
                                <th scope="col"> Grade Level </th>
                                <th scope="col"> Year </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-capitalize"> <i class="fas fa-user"></i> {{$user->name}} </td>
                                    <td> <strong> {{$user->borrowed_qty}} </strong> </td>
                                    <td> 
                                        @if ($user->grade_level == 0)
                                            n/a
                                        @else
                                            {{$user->grade_level}} 
                                        @endif
                                    </td>
                                    <td> {{$filter_year}}  </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"> No records found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                            <br>
                            <small class="text-muted"> Select Month </small>
                            <select name="filter_month" id="filter_month" class="form-control">
                                <option value="0"> Month </option>
                               <option value="1"> January </option>
                               <option value="2"> February </option>
                               <option value="3"> March </option>
                               <option value="4"> April </option>
                               <option value="5"> May </option>
                               <option value="6"> June </option>
                               <option value="7"> July </option>
                               <option value="8"> August </option>
                               <option value="9"> September </option>
                               <option value="10"> October </option>
                               <option value="11"> November </option>
                               <option value="12"> December </option>
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

    
    {{-- all requested  --}}
    <input type="hidden" id="jan" value="{{$arr_requested_books[1] ?? 0}}">
    <input type="hidden" id="feb" value="{{$arr_requested_books[2] ?? 0}}">
    <input type="hidden" id="mar" value="{{$arr_requested_books[3] ?? 0}}">
    <input type="hidden" id="apr" value="{{$arr_requested_books[4] ?? 0}}">
    <input type="hidden" id="may" value="{{$arr_requested_books[5] ?? 0}}">
    <input type="hidden" id="jun" value="{{$arr_requested_books[6] ?? 0}}">
    <input type="hidden" id="jul" value="{{$arr_requested_books[7] ?? 0}}">
    <input type="hidden" id="aug" value="{{$arr_requested_books[8] ?? 0}}">
    <input type="hidden" id="sep" value="{{$arr_requested_books[9] ?? 0}}">
    <input type="hidden" id="oct" value="{{$arr_requested_books[10] ?? 0}}">
    <input type="hidden" id="nov" value="{{$arr_requested_books[11] ?? 0}}">
    <input type="hidden" id="dec" value="{{$arr_requested_books[12] ?? 0}}">

    {{-- approved books data  --}}
    <input type="hidden" id="jan_approved" value="{{$arr_approved[1] ?? 0}}">
    <input type="hidden" id="feb_approved" value="{{$arr_approved[2] ?? 0}}">
    <input type="hidden" id="mar_approved" value="{{$arr_approved[3] ?? 0}}">
    <input type="hidden" id="apr_approved" value="{{$arr_approved[4] ?? 0}}">
    <input type="hidden" id="may_approved" value="{{$arr_approved[5] ?? 0}}">
    <input type="hidden" id="jun_approved" value="{{$arr_approved[6] ?? 0}}">
    <input type="hidden" id="jul_approved" value="{{$arr_approved[7] ?? 0}}">
    <input type="hidden" id="aug_approved" value="{{$arr_approved[8] ?? 0}}">
    <input type="hidden" id="sep_approved" value="{{$arr_approved[9] ?? 0}}">
    <input type="hidden" id="oct_approved" value="{{$arr_approved[10] ?? 0}}">
    <input type="hidden" id="nov_approved" value="{{$arr_approved[11] ?? 0}}">
    <input type="hidden" id="dec_approved" value="{{$arr_approved[12] ?? 0}}">

    {{-- lost books data  --}}
    <input type="hidden" id="jan_lost" value="{{$arr_lost[1] ?? 0}}">
    <input type="hidden" id="feb_lost" value="{{$arr_lost[2] ?? 0}}">
    <input type="hidden" id="mar_lost" value="{{$arr_lost[3] ?? 0}}">
    <input type="hidden" id="apr_lost" value="{{$arr_lost[4] ?? 0}}">
    <input type="hidden" id="may_lost" value="{{$arr_lost[5] ?? 0}}">
    <input type="hidden" id="jun_lost" value="{{$arr_lost[6] ?? 0}}">
    <input type="hidden" id="jul_lost" value="{{$arr_lost[7] ?? 0}}">
    <input type="hidden" id="aug_lost" value="{{$arr_lost[8] ?? 0}}">
    <input type="hidden" id="sep_lost" value="{{$arr_lost[9] ?? 0}}">
    <input type="hidden" id="oct_lost" value="{{$arr_lost[10] ?? 0}}">
    <input type="hidden" id="nov_lost" value="{{$arr_lost[11] ?? 0}}">
    <input type="hidden" id="dec_lost" value="{{$arr_lost[12] ?? 0}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>

    <script>
        callBarChart()
        function callBarChart(){

            //all requested
            var january     = document.getElementById('jan').value ?? 0;
            var february    = document.getElementById('feb').value ?? 0;
            var march       = document.getElementById('mar').value ?? 0;
            var april       = document.getElementById('apr').value ?? 0;
            var may         = document.getElementById('may').value ?? 0;
            var june        = document.getElementById('jun').value ?? 0;
            var july        = document.getElementById('jul').value ?? 0;
            var august      = document.getElementById('aug').value ?? 0;
            var september   = document.getElementById('sep').value ?? 0;
            var october     = document.getElementById('oct').value ?? 0;
            var november    = document.getElementById('nov').value ?? 0;
            var december    = document.getElementById('dec').value ?? 0;

            //approved
            var january_approved     = document.getElementById('jan_approved').value ?? 0;
            var february_approved    = document.getElementById('feb_approved').value ?? 0;
            var march_approved       = document.getElementById('mar_approved').value ?? 0;
            var april_approved       = document.getElementById('apr_approved').value ?? 0;
            var may_approved         = document.getElementById('may_approved').value ?? 0;
            var june_approved        = document.getElementById('jun_approved').value ?? 0;
            var july_approved        = document.getElementById('jul_approved').value ?? 0;
            var august_approved      = document.getElementById('aug_approved').value ?? 0;
            var september_approved   = document.getElementById('sep_approved').value ?? 0;
            var october_approved     = document.getElementById('oct_approved').value ?? 0;
            var november_approved    = document.getElementById('nov_approved').value ?? 0;
            var december_approved    = document.getElementById('dec_approved').value ?? 0;

            //lost
            var january_lost     = document.getElementById('jan_lost').value ?? 0;
            var february_lost    = document.getElementById('feb_lost').value ?? 0;
            var march_lost       = document.getElementById('mar_lost').value ?? 0;
            var april_lost       = document.getElementById('apr_lost').value ?? 0;
            var may_lost         = document.getElementById('may_lost').value ?? 0;
            var june_lost        = document.getElementById('jun_lost').value ?? 0;
            var july_lost        = document.getElementById('jul_lost').value ?? 0;
            var august_lost      = document.getElementById('aug_lost').value ?? 0;
            var september_lost   = document.getElementById('sep_lost').value ?? 0;
            var october_lost     = document.getElementById('oct_lost').value ?? 0;
            var november_lost    = document.getElementById('nov_lost').value ?? 0;
            var december_lost    = document.getElementById('dec_lost').value ?? 0;

            var ctx = document.getElementById("myBarChart");
            new Chart(ctx, {
                type: 'bar',
                borderWidth: 2,
                data: {
                    labels: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                    datasets: [
                        { 
                            data: [january,february,march,april,may,june,july,august,september,october,november,december],
                            label: "Total Books Requested Per Month",
                            backgroundColor: ['rgba(63, 158, 237 , 0.2)'], 
                            borderColor:['rgb(0, 126, 225)']
                        },
                        { 
                            data: [january_approved,february_approved,march_approved,april_approved,may_approved,june_approved,july_approved,august_approved,september_approved,october_approved,november_approved,december_approved],
                            label: "Approved Books Per Month",
                            backgroundColor: ['rgba(71, 237, 63, 0.2)'], 
                            borderColor:['rgb(0, 126, 225)']
                        },
                        { 
                            data: [january_lost,february_lost,march_lost,april_lost,may_lost,june_lost,july_lost,august_lost,september_lost,october_lost,november_lost,december_lost],
                            label: "Lost Books Per Month",
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

    function showYearFilterModal(){
        $('#show-year-modal').modal('show');
    }
    </script>
@endsection

