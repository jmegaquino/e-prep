<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Virtual Lab: Tapas</title>
    
    <style>
      <?php include "../../css/styles.css" ?>
    </style>

</head>
<body>
    <div class="imgbox">
        <img id="mainImg" class="center-fit" src="media/Tapas 0.1.png" alt="Tapas 0.1">
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
                myImage.src="media/Tapas 0.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 0.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 0.2.png"
                backBtn.style.display = "none";
                homeBtn.style.display = "block";

            }
            else if(imgCtr==1){
                myImage.src="media/Tapas 0.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 0.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 0.3.png"
                backBtn.style.display = "block";

            }
            else if(imgCtr==2){
                myImage.src="media/Tapas 0.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 0.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 0.4.png"

            }
            else if(imgCtr==3){
                myImage.src="media/Tapas 1.1.png";
                document.getElementById("nextBtn").style = "top: 73%; left: 20.2%; width: 8.2%; height: 17%;";
                imgX="media/Tapas tip 1.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 1.1.png"

            }
            else if(imgCtr==4){
                myImage.src="media/Tapas 2.1.png";
                document.getElementById("nextBtn").style = "top: 52%; left: 31.3%; width: 30%; height: 40%;";
                imgX="media/Tapas tip 2.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 2.1.png"
                SFXAudio.src="../../sfx/salt.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==5){
                myImage.src="media/Tapas 2.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 2.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 2.2.png"
                SFXAudio.src="../../sfx/plate.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==6){
                myImage.src="media/Tapas 3.1.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 10.2%; width: 24.5%; height: 27%;";
                imgX="media/Tapas tip 3.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 3.1.png"
                SFXAudio.src=""

            }
            else if(imgCtr==7){
                myImage.src="media/Tapas 3.2.png";
                document.getElementById("nextBtn").style = "top: 10.5%; left: 33%; width: 32.5%; height: 46%;";
                imgX="media/Tapas tip 3.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 3.2.png"

            }
            else if(imgCtr==8){
                myImage.src="media/Tapas 3.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 3.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 3.3.png"
                SFXAudio.src="../../sfx/potato.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==9){
                myImage.src="media/Tapas 4.1.png";
                document.getElementById("nextBtn").style = "top: 70.8%; left: 10%; width: 10.2%; height: 19.5%;";
                imgX="media/Tapas tip 4.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 4.1.png"
                SFXAudio.src=""

            }
            else if(imgCtr==10){
                myImage.src="media/Tapas 4.2.png";
                document.getElementById("nextBtn").style = "top: 73%; left: 24%; width: 8.4%; height: 17%;";
                imgX="media/Tapas tip 4.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 4.2.png"
                SFXAudio.src="../../sfx/egg.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==11){
                myImage.src="media/Tapas 4.3.png";
                document.getElementById("nextBtn").style = "top: 50%; left: 67.5%; width: 12.5%; height: 37%;";
                imgX="media/Tapas tip 4.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 4.3.png"
                SFXAudio.src="../../sfx/salt.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==12){
                myImage.src="media/Tapas 4.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas 4.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 4.4.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==13){
                myImage.src="media/Tapas 5.1.png";
                document.getElementById("nextBtn").style = "top: 73%; left: 61%; width: 27%; height: 18.8%;";
                imgX="media/Tapas tip 5.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 5.1.png"
                SFXAudio.src=""

            }
            else if(imgCtr==14){
                myImage.src="media/Tapas 6.1.png";
                document.getElementById("nextBtn").style = "top: 66%; left: 34%; width: 20.3%; height: 30%;";
                imgX="media/Tapas tip 6.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 6.1.png"
                SFXAudio.src="../../sfx/dip.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==15){
                myImage.src="media/Tapas 6.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 6.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 6.2.png"
                SFXAudio.src=""

            }
            else if(imgCtr==16){
                myImage.src="media/Tapas 7.1.png";
                document.getElementById("nextBtn").style = "top: 56%; left: 77%; width: 11.3%; height: 34%;";
                imgX="media/Tapas tip 7.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 7.1.png"

            }
            else if(imgCtr==17){
                myImage.src="media/Tapas 7.2.png";
                document.getElementById("nextBtn").style = "top: 61%; left: 43.3%; width: 24.2%; height: 31.5%;";
                imgX="media/Tapas tip 7.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 7.2.png"
                SFXAudio.src="../../sfx/oil.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==18){
                myImage.src="media/Tapas 8.1.png";
                document.getElementById("nextBtn").style = "top: 72.3%; left: 11.3%; width: 26.8%; height: 18.5%;";
                imgX="media/Tapas tip 8.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 8.1.png"
                SFXAudio.src="../../sfx/fryer.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==19){
                myImage.src="media/Tapas 8.2.png";
                document.getElementById("nextBtn").style = "top: 23%; left: 44.2%; width: 22.5%; height: 16%;";
                imgX="media/Tapas tip 8.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 8.2.png"
                SFXAudio.src="../../sfx/metal.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==20){
                myImage.src="media/Tapas 8.3.png";
                document.getElementById("nextBtn").style = "top: 52%; left: 73.8%; width: 15.2%; height: 40.5%;";
                imgX="media/Tapas tip 8.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 8.3.png"
                SFXAudio.src="../../sfx/fry.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==21){
                myImage.src="media/Tapas 9.1.png";
                document.getElementById("nextBtn").style = "top: 55.5%; left: 43.2%; width: 25%; height: 37%;";
                imgX="media/Tapas tip 9.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 9.1.png"
                SFXAudio.src="../../sfx/tissue.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==22){
                myImage.src="media/Tapas 9.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 9.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 9.2.png"
                SFXAudio.src="../../sfx/fryer.mp3"
                SFXAudio.play();

            }
            else if(imgCtr==23){
                myImage.src="media/Tapas 9.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tapas tip 9.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 9.3.png"
                SFXAudio.src=""

            }
            else if(imgCtr==24){
                myImage.src="media/Tapas 9.4.png";
                document.getElementById("nextBtn").style = "top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;";
                imgX="media/Tapas tip 9.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tapas 9.4.png"
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