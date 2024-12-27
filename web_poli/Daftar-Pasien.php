<!DOCTYPE html>
<html>
<head>
  <title>Daftar Pasien</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <script>
    function validateForm() {
      var nama = document.forms["loginForm"]["nama"].value;
      var alamat = document.forms["loginForm"]["alamat"].value;
      var noKtp = document.forms["loginForm"]["no_ktp"].value;
      var noHp = document.forms["loginForm"]["no_hp"].value;
      
      if (nama == "" || alamat == "" || noKtp == "" || noHp == "") {
        alert("Harap isi formulir yang masih kosong!");
        return false;
      }
      
      return true;
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

button {
  background-color: #4CAF50; /* Hijau */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.form-footer {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.form-footer p {
  margin: 0;
  margin-left: 10px;
}

.form-footer a {
  color: #007bff;
  text-decoration: none;
  margin-left: 5px;
}

.form-footer a:hover {
  text-decoration: underline;
}
</style>
<body>
  <div class="header">
    <h2>Daftar Pasien</h2>
  </div>

  <div class="login-container">
    <form name="loginForm" action="ConfigDFTR-Pasien.php" method="post" onsubmit="return validateForm()">
      <input type="text" name="nama" placeholder="Nama Lengkap" required>
      <input type="text" name="alamat" placeholder="Alamat" required>
      <input type="text" name="no_ktp" placeholder="No. Ktp" required>
      <input type="text" name="no_hp" placeholder="No. HP" required>
      <input type="text" name="passwordPasien" placeholder="Password" required>
      <input type="hidden" name="no_rm" value="">
      <div class="form-footer">
        <button type="submit">Daftar</button>
        <p>Sudah Punya Akun?</p>
        <a href="Login-Pasien.php">Masuk</a>
      </div>
    </form>
  </div>
  <div class="caption">
    <p>Jika Anda adalah Pasien Baru, Maka Masukan Data Diri Anda untuk Mendaftarkan Akun Anda.</p>
    <p>Jika sudah pernah membuat Akun, silahkan langsung memilih opsi "Masuk"</p>
  </div>
</body>
</html>
