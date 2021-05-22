
<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Excel</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
<form method="POST" action="{{route('form-submit')}}" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div><input type="file" name="file"> </div><br/>
    <div><button type="submit">Upload </button></div>

</form>

    @yield('js')
</body>
</html>
