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

        //$tables = array('Dania główne', 'Dodatki obiadowe do wyboru', 'Zupy', 'Potrawy mączne');  // list names of menu's
        $tables = array('glowne', 'dodatki', 'zupy', 'maczne');
        foreach ($tables as $value) {
          $menu_{$value} = new Menu($value);
          $menu_{$value}->print($db);
        }
      ?>
  <!--    <table id="glowne" class="menu_cat">
        <caption>Dania główne</caption>
        <tbody>
          <tr>
            <td class="dish_name">Kotlet schabowy tradycyjny</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Kotlet schabowy zapiekany serem i pieczarką</td>
            <td class="price">11 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Pierś z kurczaka w panierce</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Kotlet mielony</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Żeberka wieprzowe</td>
            <td class="price">13 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Bitka wołowa</td>
            <td class="price">12 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Gołąbek</td>
            <td class="price">11 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Udko pieczone</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Kotlet de’volaille z serem i masłem</td>
            <td class="price">11 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Gulasz wieprzowy warzywami</td>
            <td class="price">11 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Placek po węgiersku</td>
            <td class="price">20 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Filet z dorsza w delikatnej panierce</td>
            <td class="price">12 zł</td>
          </tr>
        </tbody>
      </table>
      <table id="dodatki" class="menu_cat">
        <caption>Dodatki obiadowe do wyboru</caption>
        <tbody>
          <tr>
            <td class="dish_name">Frytki</td>
            <td class="price">5 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Ziemniaki</td>
            <td class="price">5 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Ziemniaki opiekane</td>
            <td class="price">6 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Chleb (2 kromki)</td>
            <td class="price"> 1zł</td>
          </tr>
          <tr>
            <td class="dish_name">Zestaw surówek</td>
            <td class="price">5 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Kapusta zasmażana </td>
            <td class="price">5 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Ketchup / musztarda</td>
            <td class="price">1 zł</td>
          </tr>
        </tbody>
      </table>
      <table id="zupy" class="menu_cat">
        <caption>Zupy</caption>
        <tbody>
          <tr>
            <td class="dish_name">Pomidorowa</td>
            <td class="price">6zł </td>
          </tr>
          <tr>
            <td class="dish_name">Żurek staropolski</td>
            <td class="price">8 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Flaki wołowe</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Barszcz ukraiński</td>
            <td class="price">7 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Barszcz czerwony z uszkami</td>
            <td class="price">7 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Grochowa</td>
            <td class="price">7 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Rosół domowy</td>
            <td class="price">5 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Ogórkowa</td>
            <td class="price">7 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Szczawiowa</td>
            <td class="price">6 zł</td>
          </tr>
        </tbody>
      </table>
      <table id="maczne" class="menu_cat">
        <caption>Potrawy mączne</caption>
        <tbody>
          <tr>
            <td class="dish_name">Pierogi z mięsem</td>
            <td class="price">14 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Pierogi z kapustą</td>
            <td class="price">14 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Pierogi ruskie</td>
            <td class="price">14 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Pierogi z serem</td>
            <td class="price">14 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Placki ziemniaczane ze śmietaną (3 szt.)</td>
            <td class="price">9 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Naleśniki z serem, bitą śmietaną i owocami (1 szt.)</td>
            <td class="price">4,50 zł</td>
          </tr>
          <tr>
            <td class="dish_name">Kluski leniwe na słodko</td>
            <td class="price">10 zł</td>
          </tr>
        </tbody>
      </table> -->
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
