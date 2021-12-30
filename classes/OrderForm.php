<?php
  include_once 'Menu.php';

  class OrderForm extends Menu
  {
    private $category;
    protected $filter_array = [
        'order_type' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'position' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
        'name' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[A-Za-z]\D+$/']],
        'surname' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[A-Za-z]\D+$/']],
        'tel' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^\d{9}}$/']],
        'time' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'hour' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[0-5]\d{1}\:[0-5]\d{1}}$/']],
        'date' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^\d{4}\-\d{2}\-\d{2}$/']],
        'street' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[A-Za-z0-9]{1}[0-9A-Za-z\/ \.\,\'-]{0,99}$/']],
        'number' => ['filter' => FILTER_VALIDATE_REGEXP,
          'options' => ['regexp' => '/^[0-9]{1}[0-9A-Za-z\/ \.]{0,5}$/']],
        'payment' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'comments' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
      ];

    function __construct($category)
    {
      $this->category = $category;
      Menu::__construct($category);
      Form::__construct($this->filter_array);
    }

    public function print($db)
    {
      list($result, $key, $cat) = Menu::build_table($db);
      echo "<fieldset>";
      $content = "<legend>$cat</legend>";
      foreach ($result as $value) {
        $content .= '<input type="checkbox" name="position[]" value="'.$value['name_tag'].'" id="'.$value['name_tag'].'">';
        $content .= '<div class="menuPosition" id="div_'.$value['name_tag'].'">';
        $content .= '<label for="'.$value['name_tag'].'"><span class="menuPosition_element dish_name">';
        $content .= $value['nazwa'].'</span>';
        $content .= '<span class="menuPosition_element price">';
        $content .= $value['cena'].' zł</span></label>';
        $content .= '</div>';
      }
      echo $content;
      echo "</fieldset>";
    }



    public function __destruct()
    {
      Form::__destruct();
      Menu::__destruct();
    }
  }
?>
