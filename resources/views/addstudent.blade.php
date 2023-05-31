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
        <form method="POST" action="{{ route('addstudent') }}" class="addform">
            @csrf
            <b> Enter Student ID Number: <br></b>
            <input type="text" name="idnum"> <br><br>
            <b> Enter student last name: <br></b>
            <input type="text" name="lastname"> <br><br>
            <b> Enter student first name: <br></b>
            <input type="text" name="firstname"> <br><br>
            <b> Enter student middle name: <br></b>
            <input type="text" name="middlename"> <br><br>
            <b> Enter student extension name: <br></b>
            <input type="text" name="extname"> <br><br>
            <b>Course:<br></b>
            <select id="course" name="course">
                <option value="none" selected disabled hidden>Select Course:</option>
                <option id="bsit" value="BSIT">BSIT</option>
                <option id="bscs" value="BSCS"> BSCS </option>
                <option id="bsmedbio" value="BSMedBio"> BSMedBio </option>
                <option id="bsessa" value="BSES"> BSES </option>
                <option id="bsmarbio" value="BSMarBio"> BSMarBio </option><br><br>
            </select><br><br>
            <b>Year:<br></b>
            <select id="year" name="year">
                <option value="none" selected disabled hidden>Select Year Level:</option>
                <option id="1" value="First Year">First Year</option>
                <option id="2" value="Second Year"> Second Year </option>
                <option id="3" value="Third Year"> Third Year </option>
                <option id="4" value="Fourth Year"> Fourth Year </option><br><br>
            </select><br><br>
            <b>Block:<br></b>
            <select id="block" name="block">
                <option value="none" selected disabled hidden>Select Block:</option>
                <option id="b1" value="Block 1">Block 1</option>
                <option id="b2" value="Block 2">Block 2</option>
                <option id="b3" value="Block 3">Block 3</option>
                <option id="b4" value="Block 4">Block 4</option>
                <option id="b5" value="Block 5">Block 5</option><br><br>
            </select><br><br>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>
</body>
</html>