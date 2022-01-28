<?php
  if(!isset($_SESSION))
    {
      session_start();
    }
  $is_session = false;
  if(isset($_SESSION['userID'])){
    $is_session = true;
  }
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swojska Chata | najlepsze obiady domowe!</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="css/form.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/orderForm_functions.js"></script>
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
    <button type="button" name="load" id="load">Załaduj poprzednie zamówienie</button>
    <h2>Formularz zamówienia</h2>
    <form action="zamowienie.php" method="post">
      <input type="hidden" name="mode" id="mode" value="new">
      <fieldset class="visibility" id="cart">
        <fieldset>
          <input type="radio" name="order_type" value="takeaway" id="takeaway" required><label for="takeaway">Na wynos</label>
          <input type="radio" name="order_type" value="delivery" id="delivery"><label for="delivery">Dostawa na adres</label>
        </fieldset>
        <fieldset id="menu_positions">
          <legend>Menu</legend>
          <?php
            include_once 'classes/Database.php';
            include_once 'classes/OrderForm.php';
            include_once 'classes/UserLogged.php';

            $db = new Database('localhost', 'root', '', 'restauracja');

            $tables = array('glowne', 'dodatki', 'zupy', 'maczne');
            foreach ($tables as $value) {
              $form_{$value} = new OrderForm($value);
              $form_{$value}->print($db);
            }

          ?>
        </fieldset>
      </fieldset>
      <fieldset class="visibility" id="details">
        <fieldset>
          <legend>Dane osoby zamawiającej</legend>
          <?php
            if($is_session){
              $uid = unserialize($_SESSION['userID']);
              $user_data = OrderForm::choose_data($db, $uid->userID);
              if($user_data !== false){
              //end of <<if's>> below
              echo '<select name="user_data" id="user_data">';
              foreach ($user_data[0] as $value) {
                echo $value;
              }
              echo '<option value="add" selected>+ Dodaj dane...</option>';
              echo '</select><br />';
            }}
          ?>
          <label for="name">Imię: </label><input type="text" name="name" id="name" pattern="^([A-Za-z][ ]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required>
          <label for="surname">Nazwisko: </label><input type="text" name="surname" id="surname" pattern="^([A-Za-z][ -]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required>
          <label for="phone">Nr telefonu: </label><input type="tel" name="phone" id="phone" pattern="^\d{9}$" title="Podaj dziewięć cyfr bez spacji i innych znaków." required>
        </fieldset>
        <fieldset>
          <legend>Czas realizacji</legend>
          <input type="radio" name="time" value="asap" id="asap" required><label for="asap">Jak najszybciej</label>
          <input type="radio" name="time" value="date" id="date"><label for="date">Wybieram przewidywany czas realizacji</label><br>
          <span id="data_time">
            <label for="hour">Godzina: </label><input type="time" name="hour" id="hour" pattern="^\d{2}\:\d{2}$">
            <label for="day">Data: </label><input type="date" name="day" id="day" pattern="^\d{4}\-\d{2}\-\d{2}$">
          </span>
        </fieldset>
        <fieldset id="address">
          <legend>Adres dostawy</legend>
          <?php
            if(isset($user_data)){
              if($user_data !== false){
                echo '<select name="user_address" id="user_address">';
                foreach ($user_data[1] as $value) {
                  echo $value;
                }
                echo '<option value="add" selected>+ Dodaj adres...</option>';
                echo '</select><br />';
              }
            }
          ?>
          <label for="street">Ulica: </label><input type="text" name="street" id="street" minlength="2" title="Podaj co najmniej dwa znaki.">
          <label for="number">Numer: </label><input type="text" name="number" id="number">
          <br><br>
          <label for="payment">Sposób płatności  kurierowi: </label><select id="payment" name="payment">
            <option value="cash">Gotowka</option>
            <option value="card">Karta</option>
            <option value="voucher">Bon rabatowy</option>
          </select>
        </fieldset>
        <textarea name="comments" rows="3" cols="80" placeholder="Uwagi do zamówienia"></textarea>
        <input type="submit" name="submit" value="Zamawiam">
        <p>UWAGA: płatność tylko przy odbiorze!</p>
      </fieldset>
    </form>
    <?php
      $form = new OrderForm("");
      if(filter_input(INPUT_POST, "submit")){
        $action = filter_input(INPUT_POST, "submit");
        switch ($action){
            case "Zamawiam": {
                $form->insertToDB($db);
                break;
            }
        }
      }
    ?>
  </main>
  <?php
    include_once 'snippets/footer.php';
  ?>
</body>

</html>