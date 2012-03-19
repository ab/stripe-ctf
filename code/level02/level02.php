<?php
    function random_string($max = 20){
        $chars = "abcdefghijklmnopqrstuvwxwz0123456789";
        for($i = 0; $i < $max; $i++){
            $rand_key = mt_rand(0, strlen($chars));
            $string  .= substr($chars, $rand_key, 1);
        }
        return str_shuffle($string);
    }

    $out = '';
    if (!isset($_COOKIE['user_details'])) {
      $out = "<p>Looks like a first time user. Hello, there!</p>";
      $filename = random_string(16) . ".txt";
      $f = fopen('/tmp/level02/' . $filename, 'w');

      $str = $_SERVER['REMOTE_ADDR']." using ".$_SERVER['HTTP_USER_AGENT'];
      fwrite($f, $str);
      fclose($f);
      setcookie('user_details', $filename);
    }
    else {
      $out = file_get_contents('/tmp/level02/'.$_COOKIE['user_details']);
    }

?>

<html>
  <head>
    <title>Level02</title>
  </head>
  <body>
    <h1>Welcome to the challenge!</h1>
    <div class="main">
      <p><?php echo $out ?></p>
      <?php
        if (isset($_POST['name']) && isset($_POST['age'])) {
          echo "You're ".$_POST['name'].", and your age is ".$_POST['age'];
        }
        else {
      ?>
      <form action="#" method="post">
        Name: <input name="name" type="text" length="40" /><br />
        Age: <input name="age" type="text" length="2" /><br /><br />
        <input type="submit" value="Submit!" />
      </form>
      <?php   } ?>
    </div>
  </body>
</html>
