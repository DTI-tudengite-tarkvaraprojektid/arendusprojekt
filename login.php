<<<<<<< HEAD
<?php
  require("php/functions.php");
  require("php/function_main.php");
  require("php/config.php");

  require("session/session.class.php");
  SessionManager::sessionStart("vp", 0, "/~hannepru/", "greeny.cs.tlu.ee");
  
  $notice = "";
  $username = "";
  $usernameError = "";
  $passwordError = "";

  if(isset($_POST["login"])){
    if (isset($_POST["username"]) and !empty($_POST["username"])){
      $username = test_input($_POST["username"]);
    } else {
      $usernameError = "Palun sisesta kasutajanimi!";
    }

    if (!isset($_POST["password"]) or strlen($_POST["password"])< 8){
      $passwordError = "Palun sisesta parool!";
    } 
  
    if (empty($usernameError) and empty($passwordError)){
      $notice = login($username, $_POST["password"]);
    } else {
      $notice = "Sisselogimine ei õnnestunud!";
    }
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="login">
			<h1>Sisselogimine</h1>
        <br>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input name="username" value="" type="text" placeholder="kasutajanimi">
        <br>
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input name="password" type="password" placeholder="parool">
        <br>
        <input name="login" type="submit" value="Logi sisse"&nbsp;<span><?php echo $notice; ?>
        </form>
    </div>
    <br>
</body>
</html>
=======
<?php
  require("php/functions.php");
  require("php/function_main.php");
  require("php/config.php");

  /*
  require("session/session.class.php");
  SessionManager::sessionStart("vp", 0, "/~hannepru/", "greeny.cs.tlu.ee");
  */
  
  $notice = "";
  $username = "";
  $usernameError = "";
  $passwordError = "";

  if(isset($_POST["login"])){
    if (isset($_POST["username"]) and !empty($_POST["username"])){
      $username = test_input($_POST["username"]);
    } else {
      $usernameError = "Palun sisesta kasutajanimi!";
    }

    if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
      $passwordError = "Palun sisesta parool!";
    } 
  
    if (empty($usernameError) and empty($passwordError)){
      $notice = login($username, $_POST["password"]);
    } else {
      $notice = "Sisselogimine ei õnnestunud!";
    }
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="login">
			<h1>Sisselogimine</h1>
        <br>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input name="username" value="" type="text" placeholder="kasutajanimi">
        <br>
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input name="password" type="password" placeholder="parool">
        <br>
        <input name="login" type="submit" value="Logi sisse"&nbsp;<span><?php echo $notice; ?>
        </form>
    </div>
    <br>
</body>
</html>
>>>>>>> Roosi---reDesign
