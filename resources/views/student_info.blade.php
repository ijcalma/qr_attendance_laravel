<!DOCTYPE html>
<html>
  <head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="style.css" />    
  </head>
    <body style="font-family: sans-serif;">
        @include('navbar')
        <form action="{{ url()->current() }}" method="GET" class="form">
                <input type="text" name="search" class="search" required />
                <input type="submit" value="Search" style="background-color: grey; padding: 8px; border-radius: 10px; color: white; border: none;">
            </form>
        </ul>
    </nav>
        <div class="container">
            <button type="submit" class="add_student">
            <a href="{{ route('addstudent')}}"> Add New Student</a></button>
            <div class="time">
                <button type="submit" class="time_in">
                <a href="timein.php"> Time-in</a></button>
            
                <button type="submit" class="time_out">
                <a href="timeout.php">Time-out</a></button>
            </div>
            <table class="table" border="1">
                <center><h4>Students List</h4></center>
                    <thead>
                        <th>Student Id</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Block</th>
                        <th>Actions</th>
                        
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->lastname }}, {{ $record->firstname }}</td>
                    <td>{{ $record->course }}</td>
                    <td>{{ $record->year }}</td>
                    <td>{{ $record->block }}</td>
                    <td>
                    <form action="{{ route('delete_event', $record->id) }}" method="POST">
                        @csrf
                        @method('EDIT')
                        <button type="submit" class="time_in" style="margin-right:50px; margin-bottom: -250px;">Edit</button>
                    </form>
                    <form action="{{ route('delete_student', $record->id) }}" method="POST" style="margin-top:-19px">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="time_out" style="margin-left:80px;margin-top: -300px; margin-bottom:1px;">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach

                    </tbody>
            </table>
            <br>
            @for ($page = 1; $page <= $number_of_page; $page++)
            <a href="{{ route('student_info', ['page' => $page]) }}" style="margin-right: 5px; padding: 5px; color: black;">{{ $page }}</a>
                @endfor
        </div>
    </body>
</html>