<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />     
  </head>
  <body style="font-family: sans-serif;">
  <nav>
  @include('navbar')
  </nav>
    <br>
    <div class="container2" style="margin-left: 340px;">
      <video id="preview" style="width: 400px; height: 300px; border-radius: 50px;"></video>
      <button type="submit" class="time_in" style="margin-left: 100px; margin-top: -250px;">
        <a href="{{ route('timein') }}"> Time-in</a>
      </button>
      <button type="submit" class="time_out" style="margin-left: 5px; margin-top: -250px;">
        <a href="{{ route('timeout') }}">Time-out</a>
      </button>
      
      <form method="post" action="{{ route('getTimein') }}" style="margin-top: 100px; margin-left: -165px;">
      @csrf
      @method('POST')
      <label> ATTENDANCE TIME-IN:</label><br><br>
      <input type="text" name="text" id="text" placeholder="Scan QR Code" class="form-control" style="padding: 15px; width: 150px">
      <br><br>
      <b>Event:<br></b><br>
      <select id="event" name="event" style="padding: 5px">
          <option value="none" selected disabled hidden>Type:</option>
          @foreach ($events as $event)
              <option value="{{ $event['event_id'] }}">{{ $event['event_name'] }}</option>
          @endforeach
      </select>
      <br><br>
      <input type="submit" name="submit" id="submit" value="Submit" style="padding: 15px">
  </form>

@if(session('error'))
    <script>alert('An existing record with the same student ID and event ID already has a time-in entry.');</script>
@elseif(session('error2'))
    <script>alert('An existing record with the same student ID and event ID already has a time-out entry.');</script>
@elseif(session('success'))
    <script>alert('Successfully timed-in.');</script>
@elseif(session('success2'))
    <script>alert('Successfully timed-out.');</script>
@endif

      <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
          if(cameras.length > 0 ){
            scanner.start(cameras[0]);
          }
          else {
            alert('No cameras found');
          }
        }).catch(function(e){
          console.error(e);
        });

        scanner.addListener('scan', function(c){
          document.getElementById('text').value=c;
        });
      </script>
    </div>
  </body>
</html>
