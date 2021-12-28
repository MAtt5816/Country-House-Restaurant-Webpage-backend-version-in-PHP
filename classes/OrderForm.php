<?php
  include_once 'Menu.php';

  class OrderForm extends Menu
  {
    private $category;

    function __construct($category)
    {
      $this->category = $category;
      Menu::__construct($category);
    }

    public function print($db)
    {
      list($result, $key, $cat) = Menu::build_table($db);
      echo "fieldset";
      $content = "<legend>$cat</legend>";
      foreach ($result as $value) {
        $content .= '<input type="checkbox" name="'.$value['name_tag'].'" id="'.$value['name_tag'].'">';
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
    {}
  }
?>
