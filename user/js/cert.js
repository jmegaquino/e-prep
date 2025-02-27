let fname = document.getElementById("fname");
let lname = document.getElementById("lname");
let form = document.getElementById("form");
let container = document.querySelector(".container");

let generate = document.getElementById("Generate");
generate.addEventListener("click", (e) => {
  let first_name = fname.value;
  let last_name = lname.value;
  e.preventDefault();
  fname.value = "";
  lname.value = "";

  form.style.display = "none";
  container.style.backgroundColor = "white";

  //Random Digits
  a = 1; //Min value
  b = 9; //Max Value
  let rand = a + (b - 1) * Math.random(); //Main Formula
  let rand2 = Math.round(rand);
  c = 1; //Min value
  d = 9; //Max Value
  let rand3 = c + (d - 1) * Math.random(); //Main Formula
  let rand4 = Math.round(rand3);

  let certificate = document.getElementById("certificate");
  certificate.style.display = "block";
  certificate.innerHTML = `<div class="outer">
  <div class="light-br">
      <div class="dark-br">
          <div class="main-content">
              <div class="left-side">
                  <img src="img/left.png" alt="">
              </div>
              <div class="right-content">
                  <div class="logo">
                      <img id="logo" src="img/Learning.png" alt="">
                  </div>
                  <div class="congrats">
                      <h2>Certificate of Completion</h2>
                      <h3>Congratulations, ${first_name} ${last_name}</h3>
                  </div>
                  <div class="course-name">
                      <h1>E-Prep</h1>
                      <div class="completion">
                          <h3>This is to certify that ${first_name} ${last_name} has completed the E-Prep course.</h3>
                      </div>
                  </div>
                  <div class="para">
                      <h2>By continuing to learn, you have expanded your perspective, sharpened your
                          skills, and made yourself even more in demand.</h2>
                  </div>
                  <div class="authority">
                      <div class="part-1">
                          <img id="sign" src="img/Sign.png" alt="">
                          <img id="sign" src="img/Sign2.png" alt="">
                      </div>
                  </div>
                  <div class="logos">
                    <div class="logo1">
                        &emsp; <img id="sign" src="img/school-logo.jpg" alt="" style="width:120px;height:120px;">
                        <br><br><br>
                        &emsp; &emsp; Certificate Id: AU${rand4}IZ${rand2}a${rand2}rPeUmO_IE${rand4}R${rand4}0L${rand4}ac${rand2}sN
                    </div>
                  </div>
                  <div class="certificate-id"></div>
              </div>
          </div>
      </div>
  </div>
  </div>`;
  document.getElementById("download").style.display = "block";
});

//Download PDF

let download = document.getElementById("download");
download.addEventListener("click", () => {
  var opt = {
    margin: 1,
    filename: "EPREP-certificate.pdf",
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "px", format: "a2", orientation: "landscape" },
  };

  html2pdf().set(opt).from(certificate).save();
});
