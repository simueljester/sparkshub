<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Modules Created </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="10"> <span> <strong> Modules Created </strong></td>
        </tr>
        <tr>
            <td width="20" class="text-left"> <strong> Subject </strong> </td>
            <td width="20" class="text-left"> <strong> Title </strong> </td>
            <td width="20" class="text-left"> <strong> Creator </strong> </td>
            <td width="20" class="text-left"> <strong> Is Downloadable </strong> </td>
            <td width="25" class="text-left"> <strong> Content Uploaded Count </strong> </td>
            <td width="20" class="text-left"> <strong> Approved Date </strong> </td>
            <td width="20" class="text-left"> <strong> Approver </strong> </td>
        </tr>
        @foreach ($data as $module)
            <tr>
                <td class="text-left"> {{$module->subject->name}} </td>
                <td class="text-left"> {{$module->title}} </td>
                <td class="text-left"> {{$module->user->name}} </td>
                <td class="text-left"> {{$module->downloadable}} </td>
                <td class="text-left"> {{$module->files_count}} </td>
                <td class="text-left"> {{$module->approved_at}} </td>
                <td class="text-left"> {{$module->approverAccount ? $module->approverAccount->name : 'n/a'}} </td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>