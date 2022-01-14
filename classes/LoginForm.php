<?php
  include_once 'Form.php';

  class LoginForm extends Form
  {
    function __construct()
    {
      echo '
      <form action="panel.php" method="post">
        <fieldset class="visibility">
          <h3>Formularz logowania</h3>
          <input type="text" name="login" placeholder="login" required><br />
          <input type="password" name="password" placeholder="password" required>
          <input type="submit" name="submit" value="Zaloguj">
          <input type="reset" name="reset" value="Wyczyść">
          <label for="register">Nie masz konta? Załóż je:</label>
          <input type="submit" name="register" value="Zarejestruj się" formnovalidate>
        </fieldset>
      </form>
      ';
    }
  }
?>