<!DOCTYPE html>
<html>
  <head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />    
  </head>
  <body style="font-family: sans-serif;">
    @include('navbar')
    </nav>
    <div class="container">
      <form method="POST" action="{{ route('addevent') }}" class="addform">
        @csrf
        <b>Enter Events Name: <br></b>
        <input type="text" name="event_name"> <br><br>
        <b>Type:</b>
        <select id="type" name="type">
          <option value="none" selected disabled hidden>Type:</option>
          <option id="Whole Day" value="Whole Day">Whole Day</option>
          <option id="Half Day" value="Half Day">Half Day</option>
        </select>
        <br><br>
        <div id="type2-container" style="display:none;">
          <label for="type2"><b>Half Day Type:</b></label>
          <select id="type2" name="type2">
            <option value="none" selected disabled hidden>Choose...</option>
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>
          </select>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
          $(function() {
            $('#type').change(function(){
              if ($(this).val() == 'Half Day') {
                $('#type2-container').show();
              } else {
                $('#type2-container').hide();
              }
            });
          });
        </script>

        <br><br>
        <b>Event Date: <br></b>
        <input type="date" id="date" name="date">
        <br><br>
        <button type="submit" class="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
