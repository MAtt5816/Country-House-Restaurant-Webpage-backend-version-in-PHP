<?php
  include_once 'Form.php';

  class RegistrationForm extends Form
  {
    function __construct()
    {
      echo '
          <h3>Formularz rejestracji</h3>
          <input type="text" name="name" placeholder="imię" pattern="^([A-Za-z][ ]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
          <input type="text" name="surname" placeholder="nazwisko" pattern="^([A-Za-z][ -]?)+$" title="Podaj co najmniej dwie litery. Nie uzywaj cyfr." required><br />
          <input type="text" name="phone" placeholder="nr telefonu" pattern="^\d{9}$" title="Podaj dziewięć cyfr bez spacji i innych znaków." required><br />
          <input type="text" name="street" placeholder="ulica" minlength="2" title="Podaj co najmniej dwa znaki." required><br />
          <input type="text" name="number" placeholder="nr budynku" pattern="^[A-Za-z0-9\/\. ]{,6}$" required><br />
          <input type="text" name="login" placeholder="login" pattern="^[A-Za-z0-9_]{5,65}$" title="Podaj min. 5 liter, cyfr lub zanaków - _" required><br />
          <input type="password" name="password" placeholder="hasło" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_\W])(?!.*\s).{8,}$" title="Hasło musi zawierać min. 8 małych i wielkich liter, cyfry oraz znaki specjalne." required><br />
          <input type="password" name="repeat" placeholder="powtórz hasło" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_\W])(?!.*\s).{8,}$" title="Hasło musi zawierać min. 8 małych i wielkich liter, cyfry oraz znaki specjalne." required>
          <input type="submit" name="submit" value="Zarejestruj">
          <input type="reset" name="reset" value="Wyczyść">
          <label for="register">Masz już konto? Zaloguj się:</label>
          <input type="submit" name="else_login" value="Zaloguj się" formnovalidate>
      ';
    }
  }
?>