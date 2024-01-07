window.addEventListener("DOMContentLoaded", () => {


   // Login page starts here
   const userValidationOtp = async (fd) => {
    const loginButton = document.querySelector("#loginBtn");
   
    let obj = {};
    for (var key of fd.keys()) {
      obj[key] = fd.get(key);
    }
    console.log("checking for login", obj)

    if (obj.user === "") 
      document.getElementById("user_error").innerHTML = "Enter your username";
    else document.getElementById("user_error").innerHTML = "";

    if (obj.pass === "") 
       document.getElementById('pass_error').innerHTML = "Enter your password";
    else document.getElementById('pass_error').innerHTML = ''
    if (obj.user !== "" && obj.pass !== "") {
      loginButton.innerHTML = `<span class='spinal' style='display: block;'></span>`;
      loginButton.disabled = true;
      try {
        const res = await fetch("./process/check.php", {
          method: "POST",
          body: fd,
        });
        const data = await res.json();
        if (data.success) {
          localStorage.setItem("username", data.user);
          window.location.href = "../otp/auth";
        } else if (data.status === "invalid") {
          const pass_er = document.querySelector("#pass_error");
          pass_er.innerHTML = "Invalid Password or Username";
          loginButton.innerHTML = "GO";
          loginButton.disabled = false;
        } else if (data.status === "inactive_user") {
          alert(
            "Your internet banking has not been registered yet. Check back later"
          );
          loginButton.innerHTML = "GO";
          loginButton.disabled = false;
        } else if (data.status === "blocked") {
          alert("YOUR ACCOUNT HAS BEEN BLOCKED; KINDLY CONTACT SUPPORT");
          loginButton.innerHTML = "GO";
          loginButton.disabled = false;
        } else {
          loginButton.innerHTML = `<span class='spinal' style='display: block;'></span>`;
          loginButton.disabled = true;
          try {
            let formD = new FormData();
            formD.append("userInput", obj.user);
            formD.append("passInput", obj.pass);
            console.log("formD.append", formD);
            const res = await fetch("./process/process.php", {
              method: "POST",
              body: formD,
            });
            const data = await res.json();
            console.log(data);
            if (data.success) {
              window.location.href = "../cust/dashboard";
            } else if (data.status == "error1") {
              alert("YOUR ACCOUNT HAS BEEN BLOCKED; KINDLY CONTACT SUPPORT");
              window.location.reload();
            } else if (data.status == "error2") {
              pass_er.innerHTML = "";
              //$("#pass_error").html("");
              window.location.reload();
            }
          } catch (error) {}
        }
      } catch (error) {
        console.log("Error: ", error);
      }
    }

    
  };
  // Login page ends here
  if (window.location.href.includes("/login")) {
    let submitBtn = document.querySelector("#login-form");
    const submitEmailBtn = document.querySelector("#submit_email");
    let em_er = document.getElementById("email_er");
    // form submit and validation
    submitBtn.addEventListener("submit", (e) => {
      e.preventDefault();
      let username = submitBtn.user.value;
      let password = submitBtn.pass.value;
      let fd = new FormData();
      fd.append("user", username);
      fd.append("pass", password);
      userValidationOtp(fd);
    });
   

    // update password from login page starts here

    submitEmailBtn.addEventListener("click", (e) => {
      e.preventDefault();
      updatePassword(submitEmailBtn, em_er);
    });
  }

  // verifying login otp inputed starts here
  else if (window.location.href.includes("otp/auth")) {
    //sending login otp starts here
    const otpSubmitBtn = document.getElementById("submit-otp");
    otpSubmitBtn.addEventListener("submit", async (e) => {
      e.preventDefault();
      const otp_er = document.getElementById("otp_er");
      const spinner = document.querySelector(".spinner-background");
      let otp = otpSubmitBtn.otp.value;
      const username = localStorage.getItem("username");
      const fd = new FormData();
      fd.append("otp", otp);
      fd.append("user", username);
      if (otp === "") {
        otp_er.textContent = "This Field is required";
      } else {
        otp_er.textContent = "";
        spinner.style.display = "block";
      }
      try {
        const res = await fetch("./process/autheticate.php", {
          method: "POST",
          body: fd,
        });
        if (!res.ok) {
          throw new Error("Fetching autheticate failed");
        }
        const data = await res.json();
        if (data.success) {
          window.location.href = "../cust/dashboard";
        } else {
          spinner.style.display = "none";
          alert("Invalid OTP Code");
        }
      } catch (error) {
        console.log("Fetching autheticate", error);
      }
    });
    //   verifying login otp inputed  Ends here
  }

  // updating password starts here
  if (window.location.pathname.includes("/")) {
    let submitBtn = document.querySelector("#login_submit");
    const submitEmailBtn = document.querySelector("#submit_email");
    let em_er = document.getElementById("email_er");

    // login from index page starts here
    submitBtn.addEventListener("submit", (e) => {
      e.preventDefault();
      let username = submitBtn.username.value;
      let password = submitBtn.password.value;
      let fd = new FormData();
      fd.append("user", username);
      fd.append("pass", password);
      userValidationOtp(fd);
    });
  //  login from index page ends here

    submitEmailBtn.addEventListener("click", (e) => {
      e.preventDefault();
      updatePassword(submitEmailBtn, em_er);
    });
  }
});

async function updatePassword(submitEmailBtn, em_er) {
 
    let email = submitEmailBtn.email.value;
    let fd = new FormData();
    fd.append("email", email);
    if (email === "") em_er.textContent = "Please enter your email address";
    else {
      em_er.textContent = "";
      try {
        const res = await fetch("./otp/email_validate.php", {
          method: "POST",
          body: fd,
        });
        if (!res.ok) throw new Error("Couldn't fetch data");
        const data = await res.json();
        if (data.success) {
          localStorage.setItem("verified_email", email);
          em_er.textContent = "";
          window.location.href = "../otp/";
        } else {
          em_er.textContent = "Invalid email address supplied";
        }
      } catch (error) {
        console.log("error", error);
      }
    }
 
}

