<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Virtual Lab: Fruit Tart</title>
    
    <style>
      <?php include "../../css/styles.css" ?>
    </style>

</head>
<body>
    <div class="imgbox">
        <img id="mainImg" class="center-fit" src="media/Tart 0.1.png" alt="Tart 0.1">
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
        <button id="closeBtn" data-chapter-id="5" style="top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;" onclick="window.location.href='../../../user/Desserts.php'; window.close();"></button>
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
                myImage.src="media/Tart 0.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 0.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 0.2.png"
                backBtn.style.display = "none";
                homeBtn.style.display = "block";

            }
            else if(imgCtr==1){
                myImage.src="media/Tart 0.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 0.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 0.3.png"
                backBtn.style.display = "block";

            }
            else if(imgCtr==2){
                myImage.src="media/Tart 0.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 0.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 0.4.png"

            }
            else if(imgCtr==3){
                myImage.src="media/Tart 0.5.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 0.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 0.5.png"

            }
            else if(imgCtr==4){
                myImage.src="media/Tart 0.6.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 0.6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 0.6.png"

            }
            else if(imgCtr==5){
                myImage.src="media/Tart 1.1.png";
                document.getElementById("nextBtn").style = "top: 57%; left: 8.5%; width: 16%; height: 32%;";
                imgX="media/Tart tip 1.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.1.png"

            }
            else if(imgCtr==6){
                myImage.src="media/Tart 1.2.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 25.6%; width: 8.3%; height: 18%;";
                imgX="media/Tart tip 1.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.2.png"
                SFXAudio.src="../../sfx/slice.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==7){
                myImage.src="media/Tart 1.3.png";
                document.getElementById("nextBtn").style = "top: 50%; left: 78%; width: 13%; height: 37%;";
                imgX="media/Tart tip 1.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.3.png"
                SFXAudio.src="../../sfx/bakingpowder.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==8){
                myImage.src="media/Tart 1.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 1.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.4.png"
                SFXAudio.src="../../sfx/whisk2.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==9){
                myImage.src="media/Tart 1.5.png";
                document.getElementById("nextBtn").style = "top: 59.5%; left: 69%; width: 7.8%; height: 26.8%;";
                imgX="media/Tart tip 1.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.5.png"
                SFXAudio.src=""
            }
            else if(imgCtr==10){
                myImage.src="media/Tart 1.6.png";
                document.getElementById("nextBtn").style = "top: 17%; left: 31.7%; width: 18.8%; height: 26.8%;";
                imgX="media/Tart tip 1.6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.6.png"
                SFXAudio.src="../../sfx/clank.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==11){
                myImage.src="media/Tart 1.7.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 36.5%; width: 3.5%; height: 17%;";
                imgX="media/Tart tip 1.7.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.7.png"
                SFXAudio.src="../../sfx/whisk2.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==12){
                myImage.src="media/Tart 1.8.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 1.8.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 1.8.png"
                SFXAudio.src="../../sfx/salt.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==13){
                myImage.src="media/Tart 2.1.png";
                document.getElementById("nextBtn").style = "top: 74.5%; left: 9%; width: 10%; height: 19%;";
                imgX="media/Tart tip 2.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==14){
                myImage.src="media/Tart 2.2.png";
                document.getElementById("nextBtn").style = "top: 77%; left: 19%; width: 5.5%; height: 16.5%;";
                imgX="media/Tart tip 2.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.2.png"
                SFXAudio.src="../../sfx/egg.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==15){
                myImage.src="media/Tart 2.3.png";
                document.getElementById("nextBtn").style = "top: 42%; left: 65%; width: 8%; height: 53%;";
                imgX="media/Tart tip 2.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.3.png"
                SFXAudio.src="../../sfx/waterdrop.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==16){
                myImage.src="media/Tart 2.4.png";
                document.getElementById("nextBtn").style = "top: 74.5%; left: 25.8%; width: 16.2%; height: 19%;";
                imgX="media/Tart tip 2.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.4.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==17){
                myImage.src="media/Tart 2.5.png";
                document.getElementById("nextBtn").style = "top: 55.5%; left: 74.5%; width: 17.8%; height: 41%;";
                imgX="media/Tart tip 2.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.5.png"
                SFXAudio.src="../../sfx/crostini.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==18){
                myImage.src="media/Tart 2.6.png";
                document.getElementById("nextBtn").style = "top: 42%; left: 65%; width: 8%; height: 53%;";
                imgX="media/Tart tip 2.6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.6.png"
                SFXAudio.src="../../sfx/flour.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==19){
                myImage.src="media/Tart 2.7.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 2.7.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 2.7.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==20){
                myImage.src="media/Tart 3.1.png";
                document.getElementById("nextBtn").style = "top: 55%; left: 36.4%; width: 25.2%; height: 31.8%;";
                imgX="media/Tart tip 3.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 3.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==21){
                myImage.src="media/Tart 3.2.png";
                document.getElementById("nextBtn").style = "top: 55.5%; left: 32.8%; width: 32.5%; height: 35.8%;";
                imgX="media/Tart tip 3.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 3.2.png"
                SFXAudio.src="../../sfx/knead.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==22){
                myImage.src="media/Tart 3.3.png";
                document.getElementById("nextBtn").style = "top: 62%; left: 11.5%; width: 4.2%; height: 33%;";
                imgX="media/Tart tip 3.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 3.3.png"
                SFXAudio.src="../../sfx/plate.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==23){
                myImage.src="media/Tart 3.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 3.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 3.4.png"
                SFXAudio.src="../../sfx/plastic.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==24){
                myImage.src="media/Tart 4.1.png";
                document.getElementById("nextBtn").style = "top: 52%; left: 43.5%; width: 18.5%; height: 30%;";
                imgX="media/Tart tip 4.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 4.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==25){
                myImage.src="media/Tart 4.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 4.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 4.2.png"
                SFXAudio.src="../../sfx/ovenflickon.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==26){
                myImage.src="media/Tart 4.3.png";
                document.getElementById("nextBtn").style = "top: 77%; left: 14%; width: 19.5%; height: 17%;";
                imgX="media/Tart tip 4.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 4.3.png"
                SFXAudio.src=""
            }
            else if(imgCtr==27){
                myImage.src="media/Tart 4.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 4.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 4.4.png"
                SFXAudio.src="../../sfx/brush.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==28){
                myImage.src="media/Tart 5.1.png";
                document.getElementById("nextBtn").style = "top: 53%; left: 10%; width: 18%; height: 41%;";
                imgX="media/Tart tip 5.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 5.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==29){
                myImage.src="media/Tart 5.2.png";
                document.getElementById("nextBtn").style = "top: 64%; left: 68.5%; width: 21.2%; height: 32%;";
                imgX="media/Tart tip 5.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 5.2.png"
                SFXAudio.src="../../sfx/flour.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==30){
                myImage.src="media/Tart 5.3.png";
                document.getElementById("nextBtn").style = "top: 20%; left: 39.5%; width: 21.2%; height: 43%;";
                imgX="media/Tart tip 5.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 5.3.png"
                SFXAudio.src="../../sfx/dough.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==31){
                myImage.src="media/Tart 6.1.png";
                document.getElementById("nextBtn").style = "top: 18%; left: 26.5%; width: 4.5%; height: 53.5%;";
                imgX="media/Tart tip 6.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 6.1.png"
                SFXAudio.src="../../sfx/metal.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==32){
                myImage.src="media/Tart 6.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 6.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 6.2.png"
                SFXAudio.src="../../sfx/slice.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==33){
                myImage.src="media/Tart 7.1.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 7.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 7.1.png"
                SFXAudio.src="../../sfx/metalovenflickon.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==34){
                myImage.src="media/Tart 8.1.png";
                document.getElementById("nextBtn").style = "top: 55.8%; left: 11.8%; width: 9.75%; height: 34%;";
                imgX="media/Tart tip 8.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 8.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==35){
                myImage.src="media/Tart 8.2.png";
                document.getElementById("nextBtn").style = "top: 65.8%; left: 22.5%; width: 6%; height: 25%;";
                imgX="media/Tart tip 8.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 8.2.png"
                SFXAudio.src="../../sfx/balsamic.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==36){
                myImage.src="media/Tart 8.3.png";
                document.getElementById("nextBtn").style = "top: 75%; left: 31%; width: 4.5%; height: 17%;";
                imgX="media/Tart tip 8.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 8.3.png"
                SFXAudio.src="../../sfx/piping.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==37){
                myImage.src="media/Tart 8.4.png";
                document.getElementById("nextBtn").style = "top: 58%; left: 48%; width: 21.5%; height: 38%;";
                imgX="media/Tart tip 8.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 8.4.png"
                SFXAudio.src="../../sfx/waterdrop.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==38){
                myImage.src="media/Tart 8.5.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 8.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 8.5.png"
                SFXAudio.src="../../sfx/fryer.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==39){
                myImage.src="media/Tart 9.1.png";
                document.getElementById("nextBtn").style = "top: 75%; left: 23.2%; width: 10%; height:19%;";
                imgX="media/Tart tip 9.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==40){
                myImage.src="media/Tart 9.2.png";
                document.getElementById("nextBtn").style = "top: 77%; left: 35.2%; width: 8.2%; height:17.2%;";
                imgX="media/Tart tip 9.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.2.png"
                SFXAudio.src="../../sfx/egg.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==41){
                myImage.src="media/Tart 9.3.png";
                document.getElementById("nextBtn").style = "top: 56%; left: 77.8%; width: 11.8%; height:37.5%;";
                imgX="media/Tart tip 9.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.3.png"
                SFXAudio.src="../../sfx/bakingpowder.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==42){
                myImage.src="media/Tart 9.4.png";
                document.getElementById("nextBtn").style = "top: 66%; left: 9.5%; width: 12.5%; height:29%;";
                imgX="media/Tart tip 9.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.4.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==43){
                myImage.src="media/Tart 9.5.png";
                document.getElementById("nextBtn").style = "top: 30%; left: 53.3%; width: 18%; height:25%;";
                imgX="media/Tart tip 9.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.5.png"
                SFXAudio.src="../../sfx/flour.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==44){
                myImage.src="media/Tart 9.6.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 9.6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 9.6.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==45){
                myImage.src="media/Tart 10.1.png";
                document.getElementById("nextBtn").style = "top: 65%; left: 11.2%; width: 20%; height:25%;";
                imgX="media/Tart tip 10.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 10.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==46){
                myImage.src="media/Tart 10.2.png";
                document.getElementById("nextBtn").style = "top: 21%; left: 19.8%; width: 20.5%; height:33.8%;";
                imgX="media/Tart tip 10.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 10.2.png"
                SFXAudio.src="../../sfx/balsamic.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==47){
                myImage.src="media/Tart 10.3.png";
                document.getElementById("nextBtn").style = "top: 30%; left: 19%; width: 21.5%; height:28%;";
                imgX="media/Tart tip 10.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 10.3.png"
                SFXAudio.src="../../sfx/whisk.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==48){
                myImage.src="media/Tart 10.4.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 10.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 10.4.png"
                SFXAudio.src="../../sfx/balsamic.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==49){
                myImage.src="media/Tart 11.1.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 72.5%; width: 16.2%; height:26.2%;";
                imgX="media/Tart tip 11.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==50){
                myImage.src="media/Tart 11.2.png";
                document.getElementById("nextBtn").style = "top: 63%; left: 12%; width: 23%; height:26.2%;";
                imgX="media/Tart tip 11.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.2.png"
                SFXAudio.src="../../sfx/clank.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==51){
                myImage.src="media/Tart 11.3.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 11.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.3.png"
                SFXAudio.src="../../sfx/pour.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==52){
                myImage.src="media/Tart 11.4.png";
                document.getElementById("nextBtn").style = "top: 58%; left: 48%; width: 21.5%; height: 38%;";
                imgX="media/Tart tip 11.4.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.4.png"
                SFXAudio.src=""
            }
            else if(imgCtr==53){
                myImage.src="media/Tart 11.5.png";
                document.getElementById("nextBtn").style = "top: 50%; left: 14.2%; width: 6.8%; height: 40%;";
                imgX="media/Tart tip 11.5.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.5.png"
                SFXAudio.src="../../sfx/fryer.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==54){
                myImage.src="media/Tart 11.6.png";
                document.getElementById("nextBtn").style = "top: 55.5%; left: 21.5%; width: 21.2%; height: 39%;";
                imgX="media/Tart tip 11.6.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 11.6.png"
                SFXAudio.src="../../sfx/mix.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==55){
                myImage.src="media/Tart 12.1.png";
                document.getElementById("nextBtn").style = "top: 55.5%; left: 21.5%; width: 21.2%; height: 39%;";
                imgX="media/Tart tip 12.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 12.1.png"
                SFXAudio.src="../../sfx/clank.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==56){
                myImage.src="media/Tart 12.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 12.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 12.2.png"
                SFXAudio.src="../../sfx/crostini.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==57){
                myImage.src="media/Tart 13.1.png";
                document.getElementById("nextBtn").style = "top: 72%; left: 16.2%; width: 7.5%; height: 20%;";
                imgX="media/Tart tip 13.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 13.1.png"
                SFXAudio.src=""
            }
            else if(imgCtr==58){
                myImage.src="media/Tart 14.1.png";
                document.getElementById("nextBtn").style = "top: 63%; left: 27%; width: 19.5%; height: 28.5%;";
                imgX="media/Tart tip 14.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 14.1.png"
                SFXAudio.src="../../sfx/brush.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==59){
                myImage.src="media/Tart 14.2.png";
                document.getElementById("nextBtn").style = "top: 65%; left: 64%; width: 23.3%; height: 27%;";
                imgX="media/Tart tip 14.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 14.2.png"
                SFXAudio.src="../../sfx/dip.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==60){
                myImage.src="media/Tart 15.1.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 15.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 15.1.png"
                SFXAudio.src="../../sfx/slice.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==61){
                myImage.src="media/Tart 15.2.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 11.2%; width: 13%; height: 23%;";
                imgX="media/Tart tip 15.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 15.2.png"
                SFXAudio.src=""
            }
            else if(imgCtr==62){
                myImage.src="media/Tart 16.1.png";
                document.getElementById("nextBtn").style = "top: 68%; left: 28.2%; width: 11.8%; height: 20%;";
                imgX="media/Tart tip 16.1.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 16.1.png"
                SFXAudio.src="../../sfx/peach.mp3"
                SFXAudio.play();

            }else if(imgCtr==63){
                myImage.src="media/Tart 16.2.png";
                document.getElementById("nextBtn").style = "top: 84%; left: 77.5%; width: 11.5%; height: 13%;";
                imgX="media/Tart tip 16.2.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 16.2.png"
                SFXAudio.src="../../sfx/brush.mp3"
                SFXAudio.play();
            }
            else if(imgCtr==64){
                myImage.src="media/Tart 16.3.png";
                document.getElementById("nextBtn").style = "top: 3.5%; left: 85.2%; width: 6%; height: 12.8%;";
                imgX="media/Tart tip 16.3.png";
                threshold=Date.now();
                imgXCtr=imgCtr+1;
                imgY="media/Tart 16.3.png"
                homeBtn.style.display = "none";
                backBtn.style.display = "none";
                closeBtn.style.display = "block";
                SFXAudio.src=""
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