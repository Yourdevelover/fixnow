<!DOCTYPE html>
<html>

<head>
<title>Technicians</title>
</head>

<body>

<h1>Technician List</h1>

<a href="/technicians/create">

Add Technician

</a>

<hr>

@foreach($technicians as $technician)

<h3>

{{$technician->user->name}}

</h3>

<p>

Specialist:
{{$technician->specialist}}

</p>

<p>

Experience:
{{$technician->experience}} Years

</p>

<p>

Rating:
{{$technician->rating}}

</p>

<p>

Status:
{{$technician->availability_status}}

</p>

<hr>

@endforeach

</body>
</html>