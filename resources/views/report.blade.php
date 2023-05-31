<!DOCTYPE html>
<html>
  <head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />    
  </head>
  <body style="font-family: sans-serif;">
    @include('navbar')
    <form action="{{ url()->current() }}" method="GET" class="form">
      <input type="text" name="search" class="search" required />
      <input type="submit" value="Search" style="background-color: grey; padding: 8px; border-radius: 10px; color: white; border: none;">
    </form>
    </nav>
    <div class="container">
      <table class="table" border="1">
        <center><h4>OVERALL STUDENT ATTENDANCE</h4></center>
        <thead>
          <th>Student Id</th>
          <th>Name</th>
          <th>Total Time-in:</th>
          <th>Total Time-out:</th>
          <th>Total Absents:</th>
        </thead>
        <tbody>
          @foreach ($records as $record)
          <tr>
            <td>{{ $record->studentid }}</td>
            <td>{{ $record->lastname }}, {{ $record->firstname }}</td>
            <td>{{ $record->totaltimedin }}</td>
            <td>{{ $record->totaltimedout }}</td>
            <td>{{ $record->totalabsents }}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      @for ($page = 1; $page <= $number_of_page; $page++)
        <a href="{{ url()->current() }}?page={{ $page }}" style="margin-right: 5px; padding: 5px; color: black;">{{ $page }}</a>
      @endfor
    </div>
  </body>
</html>
