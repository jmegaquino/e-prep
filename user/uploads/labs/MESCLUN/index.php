<?php

session_start();
require_once "../../../../config.php";


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='../../../../login.php';" . "</script>";
  exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Virtual Lab: Mesclun Salad</title>
    
    <style>
      <?php include "./css/styles.css" ?>
    </style>
</head>

<body>
    <div class="imgbox">
        <img id="mainImg" class="center-fit" src="media/Mesclun 1.png" alt="Mesclun 1">
        <audio controls loop id="bgm" src="./sfx/bgm.mp3"></audio>
        <audio id="buzzerSFX" src="./sfx/buzzer.mp3"></audio>
        <button id="backBtn" onClick="showBackModal();" style="top: 1.8%; left: 83.85%; width: 4.4%; height: 8.4%;">
            <img src="media/back.png">
        </button> 
        <button id="homeBtn" onClick="showHomeModal();" style="top: 1.8%; left: 88.5%; width: 4.4%; height: 8.4%;">
            <img src="media/home.png">
        </button>
        <button id="buzzerBtn" onClick="playBuzzer();" style="top: 0%; left: 7%; width: 86%; height: 100%;"></button>
        <button id="nextBtn" onClick="changeImg();" style="top: 0%; left: 7%; width: 86%; height: 100%;"></button>
        <button id="closeBtn" data-chapter-id="54" style="top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;"></button> 
        <button class="bgmBtn" onclick="bgmPlay()" style="top: 0%; left: 7%; width: 6%; height: 15%;"> 
            <img id="bgmImage" src="media/mute.png">
        </button> 

        <div id="back-modal">
            <span class="modal-close" onclick="hideModal();">&times;</span>
            <p>Are you sure you would like to return to the previous page?</p>
            <button id="confirm-back" class="confirm-button" onClick="back();">Confirm</button>
        </div>

        <div id="home-modal">
            <span class="modal-close" onclick="hideModal();">&times;</span>
            <p>If you proceed, all your progress in this virtual lab session will be lost. Are you sure you would like to return to the home page?</p>
            <button id="confirm-home" class="confirm-button" onClick="location.reload()">Confirm</button>
        </div>
    </div>

    <audio id="imgSFX"></audio>

    <script>
        var myImage = document.querySelector("#mainImg");
        let imgCtr = 0;

        var myBgmImage = document.querySelector("#bgmImage");
        let bgmCtr = 0;

        var imgX;
        var imgY;
        const requiredTime = 8000;
        let threshold = null;
        let imgXCtr = null;
        let imgYCtr = 0;

        var buzzerAudio = document.getElementById("buzzerSFX");
        var SFXAudio = document.getElementById("imgSFX");

        function playBuzzer() {
            buzzerAudio.play();
        }

        function changeImgTimer(){
            if(imgXCtr == imgCtr && threshold + requiredTime < Date.now()){
                    myImage.src=imgX;
                    imgYCtr++;

                if(imgYCtr>1){
                    myImage.src=imgY;
                    imgYCtr=0;
                }
            }
        }

        document.addEventListener('mouseup', function(e) {
            var container = document.getElementById('back-modal');
            if (!container.contains(e.target)) {
                container.style.display = 'none';
            }
        });

        document.addEventListener('mouseup', function(e) {
            var container = document.getElementById('home-modal');
            if (!container.contains(e.target)) {
                container.style.display = 'none';
            }
        });

        function showBackModal(){
            document.getElementById("back-modal").style.display="block";
        }

        function showHomeModal(){
            document.getElementById("home-modal").style.display="block";
        }

        function hideModal(){
            document.getElementById("back-modal").style.display="none";
            document.getElementById("home-modal").style.display="none";
        }

        function back(){
            imgCtr=imgCtr-2;
            changeImg();
            document.getElementById("back-modal").style.display="none";
        }

        function changeImg(){
            if(imgCtr==0){
                setInterval(changeImgTimer, 1000);
                myImage.src="media/Mesclun 2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Mesclun tip 2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 2.png"
                backBtn.style.display = "none";
                homeBtn.style.display = "block";
            }
            else if(imgCtr==1){
                myImage.src="media/Mesclun 3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Mesclun tip 3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 3.png"
                backBtn.style.display = "block";

            }
            else if(imgCtr==2){
                myImage.src="media/Mesclun 4.png";
                document.getElementById("nextBtn").style = "top: 74%; left: 11.5%; width: 14.5%; height: 16.5%;";
                imgX="media/Mesclun tip 4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 4.png"

            }
            else if(imgCtr==3){
                myImage.src="media/Mesclun 5.png";
                document.getElementById("nextBtn").style = "top: 67.5%; left: 25.4%; width: 18.5%; height: 26%;";
                imgX="media/Mesclun tip 5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 5.png"
                SFXAudio.src="./sfx/saladtoss.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==4){
                myImage.src="media/Mesclun 6.png";
                document.getElementById("nextBtn").style = "top: 74.5%; left: 45.8%; width: 11.8%; height: 17%;";
                imgX="media/Mesclun tip 6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 6.png"
                SFXAudio.src="./sfx/saladtoss1.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==5){
                myImage.src="media/Mesclun 7.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Mesclun tip 7.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 7.png"
                SFXAudio.src="./sfx/saladtoss.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==6){
                myImage.src="media/Mesclun 8.png";
                document.getElementById("nextBtn").style = "top: 79%; left: 23%; width: 17.4%; height: 11.4%;";
                imgX="media/Mesclun tip 8.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 8.png"
                SFXAudio.src=""

            }
            else if(imgCtr==7){
                myImage.src="media/Mesclun 9.png";
                document.getElementById("nextBtn").style = "top: 53%; left: 76.4%; width: 3.8%; height: 33%;";
                imgX="media/Mesclun tip 9.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 9.png"
                SFXAudio.src="./sfx/tomato.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==8){
                myImage.src="media/Mesclun 10.png";
                document.getElementById("nextBtn").style = "top: 60.3%; left: 53.5%; width: 21.5%; height: 30%;";
                imgX="media/Mesclun tip 10.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 10.png"
                SFXAudio.src="./sfx/balsamic.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==9){
                myImage.src="media/Mesclun 11.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Mesclun tip 11.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 11.png"
                SFXAudio.src="./sfx/saladmix.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==10){
                myImage.src="media/Mesclun 12.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Mesclun tip 12.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 12.png"
                SFXAudio.src=""
            }
            else if(imgCtr==11){
                myImage.src="media/Mesclun 13.png";
                document.getElementById("nextBtn").style = "top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;";
                imgX="media/Mesclun tip 13.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Mesclun 13.png"
                homeBtn.style.display = "none";
                backBtn.style.display = "none";
                closeBtn.style.display = "block";
            }


            imgCtr++
                       
        }

        

        function bgmPlay(){
            if(bgmCtr==1){
                document.getElementById('bgm').pause()
                myBgmImage.src="media/mute.png";
                bgmCtr=0;
            }
            else if(bgmCtr==0){
                document.getElementById('bgm').play()
                myBgmImage.src="media/unmute.png";
                bgmCtr=1;
            }
        }
    
        document.addEventListener("DOMContentLoaded", function() {
            var vlabButton = document.getElementById("closeBtn");

            function handleButtonClickVirtualLab(button) {
                // Get the chapter_id dynamically from the button's data attribute
                var chapterId = button.getAttribute("data-chapter-id");

                // Send AJAX request to store progress in PHP database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../store_progress_vlab.php", true); // Adjusted path here
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Check the response from the PHP script
                            var response = xhr.responseText.trim();

                            if (response === "success") {
                                // Redirect to dashboard after success
                                window.location.href = "/eprep_revise/user/dashboard.php"; // Redirect here after success
                            } else {
                                // Handle errors returned from the PHP script
                                console.error("Error: " + response);
                            }
                        } else {
                            // Handle any AJAX request errors
                            console.error("Error storing progress: " + xhr.status);
                        }
                    }
                };

                // Send chapter_id in the request
                xhr.send("chapter_id=" + encodeURIComponent(chapterId));
            }

            // Add event listener to the button
            vlabButton.addEventListener("click", function() {
                handleButtonClickVirtualLab(vlabButton);
            });
        });

    </script>

</body>



</html>