<!DOCTYPE html>

<?php
  $serverIp = file_get_contents("http://ipecho.net/plain");
  $reqUrl = "$_SERVER[HTTP_HOST]";
  $fullReqUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $domains = scandir("/etc/nginx/sites-enabled/");
?>

<html>
  <head>
    <title>Welcome from <?= $serverIp ?></title>
    <style>
      html {
        color-scheme: light dark;
      }
      body {
        width: 35em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
      }
      li {
        margin: 5px 0;
      }
    </style>
  </head>
  <body>

    <h1>Welcome to the server <?= $serverIp ?></h1>

    <p>
      Unfortunately the given domain <a href="<?= $fullReqUrl ?>"><?= $reqUrl ?></a> is no longer hosted on this server. Here is a list of websites, that this server hosts:
    </p>

    <ul>
      <?php for($i = 2; $i < count($domains); $i++)
      {
        if($domains[$i] == "default") continue;
        echo "<li><a href=\"http://$domains[$i]\">$domains[$i]</a></li>";
      };
      ?>
    </ul>

    <p><em>We apologize for any inconvenience.</em></p>

  </body>
</html>
