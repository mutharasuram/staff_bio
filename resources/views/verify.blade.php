<?php error_reporting("0");
session_start();
if($_SESSION["userName"]==""){

  ?>
 <script> window.location.href='/';</script>
  <?php
}

?>
<!DOCTYPE html>
<html lang="en"> 

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="biojs/jquery-1.8.2.js"></script>
    <script src="biojs/mfs100.js"></script>
    <script language="javascript" type="text/javascript">


        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )
		var nooffinger = '1';
        function GetInfo() {
            document.getElementById('tdSerial').innerHTML = "";
            document.getElementById('tdCertification').innerHTML = "";
            document.getElementById('tdMake').innerHTML = "";
            document.getElementById('tdModel').innerHTML = "";
            document.getElementById('tdWidth').innerHTML = "";
            document.getElementById('tdHeight').innerHTML = "";
            document.getElementById('tdLocalMac').innerHTML = "";
            document.getElementById('tdLocalIP').innerHTML = "";
            document.getElementById('tdSystemID').innerHTML = "";
            document.getElementById('tdPublicIP').innerHTML = "";


            var key = document.getElementById('txtKey').value;
            var res;
            if (key.length == 0) {
                res = GetMFS100Info();
            }
            else {
                //alert("GetMFS100KeyInfo");
                res = GetMFS100KeyInfo(key);
            }

            if (res.httpStaus) {

                document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                if (res.data.ErrorCode == "0") {
                    document.getElementById('tdSerial').innerHTML = res.data.DeviceInfo.SerialNo;
                    document.getElementById('tdCertification').innerHTML = res.data.DeviceInfo.Certificate;
                    document.getElementById('tdMake').innerHTML = res.data.DeviceInfo.Make;
                    document.getElementById('tdModel').innerHTML = res.data.DeviceInfo.Model;
                    document.getElementById('tdWidth').innerHTML = res.data.DeviceInfo.Width;
                    document.getElementById('tdHeight').innerHTML = res.data.DeviceInfo.Height;
                    document.getElementById('tdLocalMac').innerHTML = res.data.DeviceInfo.LocalMac;
                    document.getElementById('tdLocalIP').innerHTML = res.data.DeviceInfo.LocalIP;
                    document.getElementById('tdSystemID').innerHTML = res.data.DeviceInfo.SystemID;
                    document.getElementById('tdPublicIP').innerHTML = res.data.DeviceInfo.PublicIP;
                }
            }
            else {
                alert(res.err);
            }
            return false;
        }
		
		 //Devyang Multi Finger Capture
        function MultiFingerCapture() {
            try {
                  document.getElementById('txtStatus').value = "";
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";
                document.getElementById('txtIsoTemplate').value = "";
                document.getElementById('txtAnsiTemplate').value = "";
                document.getElementById('txtIsoImage').value = "";
                document.getElementById('txtRawData').value = "";
                document.getElementById('txtWsqData').value = "";

                nooffinger = document.getElementById('txtNoOfFinger').value;

                var res = CaptureMultiFinger(quality, timeout, nooffinger);
              
                if (res.httpStaus) {

                    document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                    if (res.data.ErrorCode == "0") {
                        //document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        //document.getElementById('txtQuality').value = res.data.Quality;
                        //document.getElementById('txtNFIQ').value = res.data.Nfiq;
                        document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                       // document.getElementById('txtAnsiTemplate').value = res.data.AnsiTemplate;
                        //document.getElementById('txtIsoImage').value = res.data.IsoImage;
                        //document.getElementById('txtRawData').value = res.data.RawData;
                        //document.getElementById('txtWsqData').value = res.data.WsqImage;
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }

        //

        function Capture() {
            try {
                document.getElementById('txtStatus').value = "";
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";
                document.getElementById('txtIsoTemplate').value = "";
                document.getElementById('txtAnsiTemplate').value = "";
                document.getElementById('txtIsoImage').value = "";
                document.getElementById('txtRawData').value = "";
                document.getElementById('txtWsqData').value = "";

                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) {

                    document.getElementById('txtStatus').value = res.data.ErrorDescription;
                    if (res.data.ErrorCode == "-1140") {
                        alert("Timeout!");
                    }
                    if (res.data.ErrorCode == "0") {
                        document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        document.getElementById('demo').value = "data:image/bmp;base64," + res.data.BitmapData;
                        var imageinfo = "Quality: " + res.data.Quality + " Nfiq: " + res.data.Nfiq + " W(in): " + res.data.InWidth + " H(in): " + res.data.InHeight + " area(in): " + res.data.InArea + " Resolution: " + res.data.Resolution + " GrayScale: " + res.data.GrayScale + " Bpp: " + res.data.Bpp + " WSQCompressRatio: " + res.data.WSQCompressRatio + " WSQInfo: " + res.data.WSQInfo;
                        document.getElementById('txtImageInfo').value = imageinfo;
                        document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                        document.getElementById('txtAnsiTemplate').value = res.data.AnsiTemplate;
                        document.getElementById('txtIsoImage').value = res.data.IsoImage;
                        document.getElementById('txtRawData').value = res.data.RawData;
                        document.getElementById('txtWsqData').value = res.data.WsqImage;
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }

        function Verify() {
            try {
                var isotemplate = document.getElementById('txtIsoTemplate').value;
                var res = VerifyFinger(isotemplate, isotemplate);

                if (res.httpStaus) {
                    if (res.data.Status) {
                        alert("Finger matched");
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                            alert("Finger not matched");
                        }
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;

        }


        function Match() {
            try {
                var isotemplate = document.getElementById('txtIsoTemplate').value;

                var res = MatchFinger(quality, timeout, isotemplate);
                console.log(res);
                console.log(document.getElementById('txtIsoTemplate').value);
                if (res.httpStaus) {
                    if (res.data.Status) {
                        alert("Finger matched");
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                            alert("Finger not matched");
                        }
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;

        }

        function GetPid() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array(); // You can add here multiple FMR value
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "UNKNOWN", "", "");

                var res = GetPidData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.PidData.Pid
                        document.getElementById('txtSessionKey').value = res.data.PidData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.PidData.Hmac
                        document.getElementById('txtCi').value = res.data.PidData.Ci
                        document.getElementById('txtPidTs').value = res.data.PidData.PidTs
                    }
                }
                else {
                    alert(res.err);
                }

            }
            catch (e) {
                alert(e);
            }
            return false;
        }
        function GetProtoPid() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array(); // You can add here multiple FMR value
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "UNKNOWN", "", "");

                var res = GetProtoPidData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.PidData.Pid
                        document.getElementById('txtSessionKey').value = res.data.PidData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.PidData.Hmac
                        document.getElementById('txtCi').value = res.data.PidData.Ci
                        document.getElementById('txtPidTs').value = res.data.PidData.PidTs
                    }
                }
                else {
                    alert(res.err);
                }

            }
            catch (e) {
                alert(e);
            }
            return false;
        }
        function GetRbd() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array();
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "LEFT_INDEX", 2, 1);
                Biometrics["1"] = new Biometric("FMR", isoTemplateFMR, "LEFT_MIDDLE", 2, 1);
                // Here you can pass upto 10 different-different biometric object.


                var res = GetRbdData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.RbdData.Rbd
                        document.getElementById('txtSessionKey').value = res.data.RbdData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.RbdData.Hmac
                        document.getElementById('txtCi').value = res.data.RbdData.Ci
                        document.getElementById('txtPidTs').value = res.data.RbdData.RbdTs
                    }
                }
                else {
                    alert(res.err);
                }

            }
            catch (e) {
                alert(e);
            }
            return false;
        }

        function GetProtoRbd() {
            try {
                var isoTemplateFMR = document.getElementById('txtIsoTemplate').value;
                var isoImageFIR = document.getElementById('txtIsoImage').value;

                var Biometrics = Array();
                Biometrics["0"] = new Biometric("FMR", isoTemplateFMR, "LEFT_INDEX", 2, 1);
                Biometrics["1"] = new Biometric("FMR", isoTemplateFMR, "LEFT_MIDDLE", 2, 1);
                // Here you can pass upto 10 different-different biometric object.


                var res = GetProtoRbdData(Biometrics);
                if (res.httpStaus) {
                    if (res.data.ErrorCode != "0") {
                        alert(res.data.ErrorDescription);
                    }
                    else {
                        document.getElementById('txtPid').value = res.data.RbdData.Rbd
                        document.getElementById('txtSessionKey').value = res.data.RbdData.Sessionkey
                        document.getElementById('txtHmac').value = res.data.RbdData.Hmac
                        document.getElementById('txtCi').value = res.data.RbdData.Ci
                        document.getElementById('txtPidTs').value = res.data.RbdData.RbdTs
                    }
                }
                else {
                    alert(res.err);
                }

            }
            catch (e) {
                alert(e);
            }
            return false;
        }
    </script>
</head>

<body>
@include('layouts.includes.header') 
  <!-- ======= Header ======= -->
  <!-- End Header -->

<!-- End Sidebar-->

  <main id="" class="container-fluid">

    <div class="pagetitle">
      <h1></h1>
      <nav>
        
      </nav>
    </div><!-- End Page Title -->
    <br><br><br><br>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
        @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
@if (session('alert1'))
    <div class="alert alert-danger">
        {{ session('alert1') }}
    </div>
@endif

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$name}}<br>{{$regno}}</h5>

       

      

        
                           
				
              
            
                
            

      
                    <input id="txtStatus" type="text"class="form-control" hidden/>
              
                    <input type="text" value="" id="txtImageInfo" class="form-control" hidden/>
             
           
           
                  
               
                
                    <textarea id="txtAnsiTemplate" style="width: 100%; height:50px;" class="form-control"hidden> </textarea>
           
                    <textarea id="txtIsoImage" style="width: 100%; height:50px;" class="form-control"hidden> </textarea>
           
            
                    <textarea id="txtRawData" style="width: 100%; height:50px;" class="form-control"hidden> </textarea>
               
                    <textarea id="txtWsqData" style="width: 100%; height:50px;" class="form-control"hidden> </textarea>
             
           
           <form class="row g-3  needs-validation"action="insbio"method="post" novalidate>
            @csrf
            <input name="name"value="{{$name}}"hidden>
            <input name="regno"value="{{$regno}}"hidden>
            <input name="section"value="{{$section}}"hidden>
           <div class="col-md-12">
               
               <textarea class="form-control" name="iso" id="txtIsoTemplate" required hidden></textarea>
               <div class="invalid-feedback">
                 


                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>##Please Capture the Finger.</strong>
                        
                       
                        </button>
                        </div>
               </div>
             </div>
             <div class="col-md-12">
               
               <textarea class="form-control" name="cropped-image" id="cropped-image-input" hidden required ></textarea>
               <div class="invalid-feedback">
                 


                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>##Please Crop the image.</strong>
                        
                       
                        </button>
                        </div>
               </div>
             </div>


           
           <div class="col-md-4">
               
               <select class="form-select" name="finger" id="validationCustom04" required>
                 <option selected disabled value="">Choose Finger...</option>
                 <option>Left Thumb</option>

                
               </select>
               <div class="invalid-feedback">
                 Please select a Finger.
               </div>
             </div>

             <div class="col-md-8" >
    <img id="imgFinger" width="150px" height="150px"  style="border:black solid 1px;float:right"/>

    <input id="demo"name="fingerprint"hidden required>


             </div>
            

            
             <div class="col-md-6">
             <video id="video-preview"width="100%" ></video>
             </div>

             <div class="col-md-6">
             <img id="captured-image" style="float:right" >
             <canvas id="canvas"  style="display: none;"></canvas>
             </div>
            

            



             <div class="col-12">
             <button  id="btnCapture"  class="btn btn-primary btn-100" onclick="return Capture()" >Capture Finger</button>
             <button class="btn btn-primary btn-100" id="start-capture-button">Start Capture</button>  
             <button class="btn btn-primary btn-100" id="capture-button" disabled>Capture Image</button>
             <button class="btn btn-primary btn-100"id="crop-button" disabled>Crop Image</button>
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
    </form>
     

              
            </div>
          </div>

        </div>

        
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <!-- End Footer -->

 
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>



<!DOCTYPE html>
<html>
<head>
  

</head>
<body>
  

  
  
  
  
  
  

  <!-- Add an HTML input element -->


  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const videoPreview = document.getElementById('video-preview');
      const startCaptureButton = document.getElementById('start-capture-button');
      const captureButton = document.getElementById('capture-button');
      const capturedImage = document.getElementById('captured-image');
      const canvas = document.getElementById('canvas');
      const cropButton = document.getElementById('crop-button');
      const croppedImageInput = document.getElementById('cropped-image-input'); // Get the input element
      let stream;
      let capturedData;
      let cropData;

      // Access the camera and start the video stream
      function startVideoStream() {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then((mediaStream) => {
            videoPreview.srcObject = mediaStream;
            videoPreview.play();
            stream = mediaStream;
            captureButton.disabled = false;
          })
          .catch((error) => {
            console.error('Error accessing camera:', error);
          });
      }

      startCaptureButton.addEventListener('click', () => {
        startCaptureButton.disabled = true;
        startVideoStream();
      });

      captureButton.addEventListener('click', captureImage);
      cropButton.addEventListener('click', enableCropMode);

      function captureImage() {
        // Create a canvas element
        const context = canvas.getContext('2d');

        // Set the canvas dimensions to match the video stream
        canvas.width = videoPreview.videoWidth;
        canvas.height = videoPreview.videoHeight;

        // Draw the current video frame onto the canvas
        context.drawImage(videoPreview, 0, 0, canvas.width, canvas.height);

        // Convert the canvas image to a data URL
        capturedData = canvas.toDataURL('image/png');

        // Display the captured image
        capturedImage.src = capturedData;
        capturedImage.style.display = 'inline';

        // Disable the "Capture Image" button and enable the "Crop Image" button
        captureButton.disabled = true;
        cropButton.disabled = false;

        // Stop the video stream
        videoPreview.pause();
        stream.getTracks().forEach((track) => {
          track.stop();
        });

        // Enable the "Start Capture" button
        startCaptureButton.disabled = false;
      }

      function enableCropMode() {
        // Hide the captured image and display the canvas
        capturedImage.style.display = 'none';
        canvas.style.display = 'inline';

        // Add event listeners for mouse down and up events on the canvas
        canvas.addEventListener('mousedown', handleMouseDown);
        canvas.addEventListener('mouseup', handleMouseUp);
      }

      function handleMouseDown(event) {
        // Save the starting mouse coordinates
        const startX = event.offsetX;
        const startY = event.offsetY;

        // Add event listener for mouse move event on the canvas
        canvas.addEventListener('mousemove', handleMouseMove);

        // Add event listener for mouse up event on the document
        document.addEventListener('mouseup', handleMouseUp);

        // Draw a rectangle on the canvas starting from the initial mouse coordinates
        const context = canvas.getContext('2d');
        context.strokeStyle = 'red';
        context.lineWidth = 2;
        context.beginPath();
        context.moveTo(startX, startY);
        context.rect(startX, startY, 1, 1);
        context.stroke();

        // Update the cropData with the initial mouse coordinates
        cropData = {
          startX,
          startY,
          endX: startX,
          endY: startY
        };
      }

      function handleMouseMove(event) {
        // Update the cropData with the current mouse coordinates
        cropData.endX = event.offsetX;
        cropData.endY = event.offsetY;

        // Redraw the rectangle on the canvas with the updated coordinates
        const context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(capturedImage, 0, 0, canvas.width, canvas.height);
        context.strokeStyle = 'red';
        context.lineWidth = 2;
        context.beginPath();
        context.moveTo(cropData.startX, cropData.startY);
        context.rect(
          cropData.startX,
          cropData.startY,
          cropData.endX - cropData.startX,
          cropData.endY - cropData.startY
        );
        context.stroke();
      }

      function handleMouseUp() {
        // Remove the mouse move event listener on the canvas
        canvas.removeEventListener('mousemove', handleMouseMove);

        // Remove the mouse up event listener on the document
        document.removeEventListener('mouseup', handleMouseUp);

        // Disable the crop mode and enable the "Capture Image" button
        canvas.style.display = 'none';
        cropButton.disabled = true;
        captureButton.disabled = false;

        // Crop the captured image based on the cropData coordinates
        const cropCanvas = document.createElement('canvas');
        const cropContext = cropCanvas.getContext('2d');
        cropCanvas.width = cropData.endX - cropData.startX;
        cropCanvas.height = cropData.endY - cropData.startY;
        cropContext.drawImage(
          capturedImage,
          cropData.startX,
          cropData.startY,
          cropCanvas.width,
          cropCanvas.height,
          0,
          0,
          cropCanvas.width,
          cropCanvas.height
        );

        // Convert the cropped canvas image to a data URL
        const croppedData = cropCanvas.toDataURL('image/png');

        // Display the cropped image
        capturedImage.src = croppedData;
        capturedImage.style.display = 'inline';

        // Set the value of the input element to the cropped image data URL
        croppedImageInput.value = croppedData;
      }
    });
  </script>
</body>
</html>



