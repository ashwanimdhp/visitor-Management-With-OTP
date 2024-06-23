@extends('Frontend.master')
@section('title',' Visitor Registration')

@section('BodyContent')

<style type="text/css">
    /* #results { padding:20px;  border:1px solid; background:#ccc; } */
    #my_camera{
        width: 50px;
        height: 50px;
    }
    .outline-dark {
        border: 1px solid #343a40; /* Dark border color */
        color: #343a40; /* Dark text color */
    }
</style>


<style>
    
    #main
    {
        /* margin-top:10px; */

    }
    .registerform
    {
        margin-top: 10px;
        border: 2px solid rgb(244, 123, 123);
        border-radius: 5px;
        /* width: 450px; */
        height: 320px;
        /* margin-left: -90px; */
        background-color: rgb(188, 186, 186);
        opacity: 0.9;
    }

    #takeSnapshot {
    position: relative;
    left: 50%;
    transform: translateX(-50%);
}
.submitButton{
    display: block;
    margin: 0 auto;
}

</style>

<div class="container" id="main">
{{-- <h1 class="text-center">Online Visitor System</h1> --}}
<form method="POST" id="visitorForm" action="{{ route('front.VisitorStore') }}">
    @csrf
    <div class="row ">
        <div class="col-md-6 col-sm-12">
            <div id="hideRetakeImage">
            <div id="results" > </div>
        </div>
            <input type="button" value="Re-Take" onClick="take_snapshot()" id="showCameraRetake" style="display: none">
         <div  id="imageCaptureButtonHide" >
            <div id="my_camera"></div>

           
       
            <br/>
           
            <input type="button" class="btn btn-danger btn-lg" value="Take Image" onClick="take_snapshot()" id="takeSnapshot">
        
            <input type="hidden" name="image" class="image-tag" id="cameraImage" required>
        </div>
        </div>


        
     
      
     

       @php
                  $category= Session::get('category');
                 

       @endphp

        
<div class="col-md-6 col-sm-12 registerforms">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value=""  class="form-control form-control-lg outline-dark" placeholder="Enter your name" required>
            <label for="email">Mobile Number</label>
            <input type="number" name="Mobile" id="Mobile" value="{{ Session::get('mobileNo'); }}"  class="form-control form-control-lg outline-dark" placeholder="Enter your Mobile Number" readonly maxlength="10">
            <label for="message">Meeting with</label>
            <select name="message" id="message" class="form-control form-control-lg outline-dark" required>
               
                   
                  

               
                    <option value="">Select</option>
                    @if ($category)
                    @foreach ($category as $item)
                    <option value="Meeting with teacher">{{ $item->message }}</option>
                    @endforeach

                    @endif
                       
               
                <option value="" id="otherMessageShow">Other</option>
            </select>
            
            <div id="otherMessage" style="display: none">
                <br>
                <textarea name="Othermessage" id="otherMessageInput" cols="30" rows="3" class="form-control" placeholder="Write Your message..."></textarea>
            </div>
            <br>
            {{-- <button class="btn btn-success" onclick="take_snapshot()">Submit</button> --}}
            <button class="btn btn-success btn-lg submitButton">Submit</button> <br><br>

            {{-- <div id="results" width=>Your captured image </div> --}}
        </div>
       

      

        
        
        {{-- <div class="col-md-2">
        </div> --}}
        
       
    </div>
</form>
</div>


<script>
$(document).ready(function () {
    $('#message').change(function () {
        if ($(this).val() === '') {
            $('#otherMessage').show();
        } else {
            $('#otherMessage').hide();
        }
    });
});
</script>

<script>
document.getElementById("visitorForm").addEventListener("submit", function(event) {
    var imageInput = document.getElementById("cameraImage");
    if (imageInput.value.trim() === "") { // Check if the value is empty after trimming whitespace
        event.preventDefault(); // Prevent the form from submitting
        alert("Please select an image");
    }
});
</script>



<script language="JavaScript">
Webcam.set({
    width: 440,
    height: 350,
    image_format: 'jpeg',
    jpeg_quality: 90
});

Webcam.attach('#my_camera');



$(document).ready(function () {
$('#takeSnapshot').click(function (e) { 
          
          
            $('#showCameraRetake').show();
            $('#imageCaptureButtonHide').hide();
            $('#hideRetakeImage').show();
            
         }); 


         $("#showCameraRetake").click(function (e) { 
            
            // imageCaptureButtonHide
          
            $('#imageCaptureButtonHide').show();
              $('#hideRetakeImage').hide();
              
         });
});


function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        
        // Send the image data to your backend for image recognition
        recognizeImage(data_uri);
        // $('#showCameraRetake').show();
        
        

       
    });
}

function recognizeImage(imageData) {
// Prepare the data to be sent to the server
var requestData = {
    image: imageData // Pass the captured image data
};

// Send the image data to the server for processing
$.ajax({
    type: "POST",
    url: "your-server-endpoint-url",
    data: JSON.stringify(requestData),
    contentType: "application/json",
    success: function(response) {
        // Handle the response from the server
        if (response.success) {
            // If recognition was successful, update the UI or take further actions
            console.log("Image recognition successful!");
            console.log("Recognition result: " + response.result);
            // Example: Update UI with recognition result
            $('#recognitionResult').text(response.result);
        } else {
            // If recognition failed, handle the error
            console.error("Image recognition failed: " + response.error);
        }
    },
    error: function(xhr, status, error) {
        // Handle errors that occurred during the AJAX request
        console.error("Error occurred during image recognition request: " + error);
    }
});
}

</script>
@endsection