<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Requested Books </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="10"> <span> <strong> Book Requested </strong></td>
        </tr>
        <tr>
            <td width="20" class="text-left"> <strong> Book </strong> </td>
            <td width="20" class="text-left"> <strong> Category </strong> </td>
            <td width="20" class="text-left"> <strong> User </strong> </td>
            <td width="20" class="text-left"> <strong> Start Date </strong> </td>
            <td width="20" class="text-left"> <strong> End Date </strong> </td>
            <td width="20" class="text-left"> <strong> Approved Date </strong> </td>
            <td width="20" class="text-left"> <strong> Approver </strong> </td>
            <td width="20" class="text-left"> <strong> Returned Date </strong> </td>
            <td width="20" class="text-left"> <strong> Duration </strong> </td>
            <td width="20" class="text-left"> <strong> Lost Date </strong> </td>
            <td width="20" class="text-left"> <strong> Creation Date </strong> </td>
            <td width="20" class="text-left"> <strong> Current Status </strong> </td>
        </tr>
        @foreach ($data as $requested_book)
            <tr>
                <td class="text-left"> {{$requested_book->book->title}} </td>
                <td class="text-left"> {{$requested_book->book->category->name}} </td>
                <td class="text-left"> {{$requested_book->user->name}} </td>
                <td class="text-left"> {{$requested_book->start_date}} </td>
                <td class="text-left"> {{$requested_book->end_date}} </td>
                <td class="text-left"> {{$requested_book->approved_at}} </td>
                <td class="text-left"> {{$requested_book->approverAccount ? $requested_book->approverAccount->name : 'n/a'}} </td>
                <td class="text-left"> {{$requested_book->returned_at}} </td>
                <td class="text-left"> {{$requested_book->duration}} </td>
                <td class="text-left"> {{$requested_book->lost_at}} </td>
                <td class="text-left"> {{$requested_book->created_at}} </td>
                <td class="text-left"> 
                    @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($requested_book->end_date)) && $requested_book->returned_at == null && $requested_book->lost_at == null)
                        <span class="text-danger"> Overdue </span>
                    @elseif($requested_book->returned_at == null && $requested_book->lost_at == null && $requested_book->approved_at)
                        <span class="text-success"> Borrowed </span>
                    @elseif($requested_book->returned_at && $requested_book->approved_at)
                        <span class="text-success"> Returned </span>
                    @elseif($requested_book->lost_at && $requested_book->approved_at )
                        <span class="text-success"> Lost </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>