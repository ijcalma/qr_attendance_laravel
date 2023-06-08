<!DOCTYPE html>
<html>
<head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />    
</head>
<body style="font-family: sans-serif;">
    @include('navbar')
    </nav>
    <div class="container">
        <form method="POST" action="{{ route('update.student', ['id' => $student->id]) }}" class="addform">
            @csrf
            @method('PUT')
            <input type="hidden" name="_method" value="PUT">
            <b>Enter Student ID Number:</b><br>
            <input type="text" name="idnum" value="{{ $student['id'] }}"><br><br>
            <b> Enter student First name: <br></b>
            <input type ="text" name="firstname" value="{{ $student['firstname'] }}"> <br><br>
            <b> Enter student Last name: <br></b>
            <input type ="text" name="lastname" value="{{ $student['lastname'] }}"> <br><br>
            <b> Enter student middle name: <br></b>
            <input type ="text" name="middlename" value="{{ $student['middlename'] }}"> <br><br>
            <b> Enter student extension name: <br></b>
            <input type ="text" name="extname" value="{{ $student['extname'] }}"> <br><br>

            <b>Course:<br></b>
            <select id="course" name="course">
                <option value="none" selected disabled hidden>Select Course:</option>
                <option id="bsit" value="BSIT" {{ $student['course'] == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                <option id="bscs" value="BSCS" {{ $student['course'] == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                <option id="bsmedbio" value="BSMedBio" {{ $student['course'] == 'BSMedBio' ? 'selected' : '' }}>BSMedBio</option>
                <option id="bsessa" value="BSES" {{ $student['course'] == 'BSES' ? 'selected' : '' }}>BSES</option>
                <option id="bsmarbio" value="BSMarBio" {{ $student['course'] == 'BSMarBio' ? 'selected' : '' }}>BSMarBio</option>
            </select>
            <br>
            <br>
            <b>Year:<br></b>
            <select id="year" name="year">
                <option value="none" selected disabled hidden>Select Year Level:</option>
                <option id="1" value="First Year" {{ $student['year'] == 'First Year' ? 'selected' : '' }}>First Year</option>
                <option id="2" value="Second Year" {{ $student['year'] == 'Second Year' ? 'selected' : '' }}>Second Year</option>
                <option id="3" value="Third Year" {{ $student['year'] == 'Third Year' ? 'selected' : '' }}>Third Year</option>
                <option id="4" value="Fourth Year" {{ $student['year'] == 'Fourth Year' ? 'selected' : '' }}>Fourth Year</option>
            </select>
            <br>
            <br>
            <b>Block:<br></b>
            <select id="block" name="block">
                <option value="none" selected disabled hidden>Select Block:</option>
                <option id="b1" value="Block 1" {{ $student['block'] == 'Block 1' ? 'selected' : '' }}>Block 1</option>
                <option id="b2" value="Block 2" {{ $student['block'] == 'Block 2' ? 'selected' : '' }}>Block 2</option>
                <option id="b3" value="Block 3" {{ $student['block'] == 'Block 3' ? 'selected' : '' }}>Block 3</option>
                <option id="b4" value="Block 4" {{ $student['block'] == 'Block 4' ? 'selected' : '' }}>Block 4</option>
                <option id="b5" value="Block 5" {{ $student['block'] == 'Block 5' ? 'selected' : '' }}>Block 5</option>
            </select>
            <button name="submit" id="submits" value="submit" class="submit">Submit</button>
        </form>
    </div>
</body>
</html>
