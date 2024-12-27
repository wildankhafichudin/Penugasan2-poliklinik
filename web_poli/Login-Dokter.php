<!DOCTYPE html>
<html>
<head>
  <title>Login Dokter</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <script>
    function validateForm() {
      var nama = document.forms["loginFormDokter"]["nama"].value;
      var passwordPasien = document.forms["loginFormDokter"]["passwordDokter"].value;
      
      if (nama == "" || passwordDokter == "") {
        alert("Harap isi formulir yang masih kosong!");
        return false;
      }
      
      return true;
    }

    function togglePassword() {
      var passwordField = document.getElementById("passwordField");
      var eyeIcon = document.getElementById("eyeIcon");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.textContent = "visibility_off"; // Mata tertutup
      } else {
        passwordField.type = "password";
        eyeIcon.textContent = "visibility"; // Mata terbuka
      }
    }
  </script>
</head>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #003873;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.header {
  font-family: 'Montserrat', sans-serif;
  color: white;
  font-size: 35px;
  text-align: center;
  margin-bottom: 20px;
}

.caption {
  font-family: 'Montserrat', sans-serif;
  color: white;
  font-size: 15px;
  text-align: center;
  margin-bottom: 20px; 
}

.login-container {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  width: 400px;
}

input[type="text"] {
  width: 90%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
}

input[type="password"] {
  width: 90%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
}

button {
  background-color: #4CAF50; /* Hijau */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.material-icons, .fas {
  font-size: 20px;
  color: #333;
}
</style>
<body>
  <div class="header">
    <h2>Login Dokter</h2>
  </div>
  <div class="login-container">
    <form name="loginFormDokter" onsubmit="return validateForm()" action="ConfigLGN-Dokter.php" method="POST">
      <input type="text" name="nama" placeholder="Username Dokter" required>
        <div style="position: relative; width: 82%; margin-bottom: 10px;">
          <input type="password" name="passwordDokter" placeholder="Password Dokter" id="passwordField" style="width: 100%; padding-right: 40px;" required>
          <span onclick="togglePassword()" style="position: absolute; top: 50%; transform: translateY(-60%); cursor: pointer; left: 350px;">
            <span id="eyeIcon" class="material-icons">visibility</span>
          </span>
        </div>
      <button type="submit" name="login" value="Login">Login</button>
    </form>
  </div>
  <div class="caption">
    <p>Harap isi semua Formulir diatas sesuai dengan data Anda!</p>
  </div>
</body>
</html>
