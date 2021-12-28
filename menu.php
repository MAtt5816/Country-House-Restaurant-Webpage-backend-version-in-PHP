<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swojska Chata | najlepsze obiady domowe!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/menu.css" type="text/css">
  </head>
  <body>
    <header>
      <nav>
        <?php
          include_once 'snippets/navigation.php';
        ?>
      </nav>
      <div id="banner">
        <div>
          <h1>Swojska Chata</h1>
          <h2>Najlepsze obiady domowe w okolicy</h2>
        </div>
        <img src="images/banner.jpg" alt="baner">
      </div>
    </header>
    <main>
      <?php
        include_once 'classes/Database.php';
        include_once 'classes/Menu.php';

        $db = new Database('localhost', 'root', '', 'restauracja');

        $tables = array('glowne', 'dodatki', 'zupy', 'maczne');
        foreach ($tables as $value) {
          $menu_{$value} = new Menu($value);
          $menu_{$value}->print($db);
        }
      ?>
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
