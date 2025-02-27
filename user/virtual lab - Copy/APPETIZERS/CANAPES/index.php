<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Virtual Lab: Canapes</title>
    
    <style>
      <?php include "../../css/styles.css" ?>
    </style>

</head>
<body>
    <div class="imgbox">
        <img id="mainImg" class="center-fit" src="media/Canapes 0.1.png" alt="Canapes 0.1">
        <audio controls loop id="bgm" src="../../sfx/bgm.mp3"></audio>
        <audio id="buzzerSFX" src="../../sfx/buzzer.mp3"></audio>
        <button id="backBtn" onClick="showBackModal();" style="top: 1.8%; left: 83.85%; width: 4.4%; height: 8.4%;">
            <img src="media/back.png">
        </button> 
        <button id="homeBtn" onClick="showHomeModal();" style="top: 1.8%; left: 88.5%; width: 4.4%; height: 8.4%;">
            <img src="media/home.png">
        </button>
        <button id="buzzerBtn" onClick="playBuzzer();" style="top: 0%; left: 7%; width: 86%; height: 100%;"></button>
        <button id="nextBtn" onClick="changeImg();" style="top: 0%; left: 7%; width: 86%; height: 100%;"></button>
        <button id="closeBtn" data-chapter-id="3" style="top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;" onclick="window.location.href='../../../user/Desserts.php'; window.close();"></button>        
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
                myImage.src="media/Canapes 0.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 0.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 0.2.png"
                backBtn.style.display = "none";
                homeBtn.style.display = "block";

            }
            else if(imgCtr==1){
                myImage.src="media/Canapes 0.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 0.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 0.3.png"
                backBtn.style.display = "block";

            }
            else if(imgCtr==2){
                myImage.src="media/Canapes 1.1.png";
                document.getElementById("nextBtn").style = "top: 71.8%; left: 10.8%; width: 21.4%; height: 20%;";
                imgX="media/Canapes tip 1.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 1.1.png"

            }
            else if(imgCtr==3){
                myImage.src="media/Canapes 1.2.png";
                document.getElementById("nextBtn").style = "top: 12%; left: 66.7%; width: 19%; height: 57%;";
                imgX="media/Canapes tip 1.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 1.2.png"

            }
            else if(imgCtr==4){
                myImage.src="media/Canapes 2.1.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 2.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 2.1.png"
                SFXAudio.src="../../sfx/mixer.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==5){
                myImage.src="media/Canapes 2.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 2.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 2.2.png"
                SFXAudio.src=""

            }
            else if(imgCtr==6){
                myImage.src="media/Canapes 3.1.png";
                document.getElementById("nextBtn").style = "top: 77.2%; left: 12%; width: 14.5%; height: 15%;";
                imgX="media/Canapes tip 3.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 3.1.png"

            }
            else if(imgCtr==7){
                myImage.src="media/Canapes 3.2.png";
                document.getElementById("nextBtn").style = "top: 70%; left: 55.5%; width: 9.1%; height: 27%;";
                imgX="media/Canapes tip 3.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 3.2.png"
                SFXAudio.src="../../sfx/crostini.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==8){
                myImage.src="media/Canapes 3.3.png";
                document.getElementById("nextBtn").style = "top: 72.5%; left: 30%; width: 17%; height: 20%;";
                imgX="media/Canapes tip 3.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 3.3.png"
                SFXAudio.src="../../sfx/piping.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==9){
                myImage.src="media/Canapes 4.1.png";
                document.getElementById("nextBtn").style = "top: 77%; left: 73%; width: 13.2%; height: 14.5%;";
                imgX="media/Canapes tip 4.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 4.1.png"
                SFXAudio.src="../../sfx/lettuce.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==10){
                myImage.src="media/Canapes 4.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 4.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 4.2.png"
                SFXAudio.src=""

            }
            else if(imgCtr==11){
                myImage.src="media/Canapes 5.1.png";
                document.getElementById("nextBtn").style = "top: 58.5%; left: 17%; width: 4.6%; height: 32%;";
                imgX="media/Canapes tip 5.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 5.1.png"

            }
            else if(imgCtr==12){
                myImage.src="media/Canapes 6.1.png";
                document.getElementById("nextBtn").style = "top: 57%; left: 79%; width: 4.5%; height: 33.3%;";
                imgX="media/Canapes tip 6.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 6.1.png"
                imgY="media/Canapes 4.2.png"
                SFXAudio.src="../../sfx/balsamic.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==13){
                myImage.src="media/Canapes 6.2.png";
                document.getElementById("nextBtn").style = "top: 73%; left: 70%; width: 8.5%; height: 17%;";
                imgX="media/Canapes tip 6.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 6.2.png"
                SFXAudio.src="../../sfx/balsamic.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==14){
                myImage.src="media/Canapes 6.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 6.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 6.3.png"
                SFXAudio.src="../../sfx/salt.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==15){
                myImage.src="media/Canapes 7.1.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Canapes tip 7.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 7.1.png"
                SFXAudio.src=""

            }
            else if(imgCtr==16){
                myImage.src="media/Canapes 7.2.png";
                document.getElementById("nextBtn").style = "top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;";
                imgX="media/Canapes tip 7.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Canapes 7.2.png"
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
        var chapterId = vlabButton.getAttribute("data-chapter-id");

        function handleButtonClickVirtualLab(button) {
                // Send AJAX request to store progress in PHP database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../../../user/store_progress_vlab.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Handle response if needed
                        console.log(xhr.responseText);
                    }
                };

                // Send chapter_id in the request
                xhr.send("chapter_id=" + encodeURIComponent(chapterId));
        }

        // Add event listener to virtual lab button
        vlabButton.addEventListener("click", function() {
            handleButtonClickVirtualLab(vlabButton)
        });

        

        });

    </script>

</body>



</html>