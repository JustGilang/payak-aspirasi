<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:300,400,700');

    *{
      margin: 0;
      padding: 0;
      outline: none;
      box-sizing: border-box;
      font-family: 'Raleway', sans-serif;
    }

    body{ background: #3598dc; }

    .cont{
      position: relative;
      width: 25%;
      height: 400px;
      padding: 10px 25px;
      margin: 10vh auto;
      background: #fff;
      border-radius: 8px;
    }

    .form{ width: 100%; height: 100%; }

    h1, h2, .user, .pass{ 
      text-align: center;
      display: block;
    }

    h1{ 
      color: #606060;
      font-weight: bold;
      font-size: 40px;
      margin: 30px auto;
    }

    .user, .pass, .login{
      width: 100%;
      height: 45px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: lighter;
      margin-bottom: 30px;
    }

    .user, .pass{ background: #ecf0f1; }

    .login{
      color: #fff;
      cursor: pointer;
      margin-top: 20px;
      background: #3598dc;
      transition: background 0.4s ease;
    }

    .login:hover{ background: #3570dc; }

    @media only screen and (min-width : 280px) {
      .cont{ width: 90% }
    }

    @media only screen and (min-width : 480px) {
      .cont{ width: 60% }
    }

    @media only screen and (min-width : 768px) {
      .cont{ width: 40% }
    }

    @media only screen and (min-width : 992px) {
      .cont{ width: 30% }
    }

    h2{ color: #fff; margin-top: 25px; }

    .select {
  -moz-appearance: none;
  -webkit-appearance: none;
  background: white;
  border: none;
  border-radius: 0;
  cursor: pointer;
  padding: 12px;
  width: 100%;
  font-size: 18px;
}
.select:focus {
  color: black;
}
.select::-ms-expand {
  display: none;
}
.select-wrapper {
  position: relative;
  width: 350px;
}
.select-wrapper::after {
  color: black;
  content: '▾';
  margin-right: 10px;
  pointer-events: none;
  position: absolute;
  right: 10px;
  top: 7px;
  font-size: 20px;
}

  </style>
</head>
<body>
  <div class="cont">
    
    <div class="form">
      <form action="function/db_login.php" method="POST">
        <h1>Login</h1>
        <input type="text" class="user" name="username" placeholder="ID User"/>
        <input type="password" class="pass" name="pass" placeholder="pass"/>
              <div class="">
                <select class="select" name="jabatan" require>
                  <option value="value1">-- Login Sebagai</option>
                  <option value="kelurahan" name="kelurahan">Kelurahan</option>
                  <option value="rt" name="rt">RT</option>
                  <option value="rw" name="rw">RW</option>
                  <option value="warga" name="warga">warga</option>
                </select>
              </div>
        <button type="submit" class="login">Login</button>
        <center>
          <a href="registrasi.php">Create Account</a>
        </center>
      </form>
    </div>
  </div>
</body>
</html>