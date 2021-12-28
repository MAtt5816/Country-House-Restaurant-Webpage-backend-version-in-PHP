<?php
  class Menu
  {
    private $category;

    protected $categories_types = array('glowne' => 'Dania główne', 'dodatki' => 'Dodatki obiadowe do wyboru', 'zupy' => 'Zupy', 'maczne' => 'Potrawy mączne');

    public function __construct($category)
    {
      $this->category = $category;
    }

    public function build_table($db){
      $key = $this->category;
      $cat = $this->categories_types[$key];
      $sql = "SELECT * FROM `menu` WHERE `kategoria` LIKE '$cat'";
      $fields = array('nazwa', 'cena','name_tag');
      $result = $db->select($sql, $fields);

      return array($result, $key, $cat);
    }

    public function print($db)
    {
      list($result, $key, $cat) = $this->build_table($db);
      echo "<table id='$key' class='menu_cat'>";
      $content = "<caption>$cat</caption>
            <tbody>";
      foreach ($result as $value) {
        $content .= '<tr>';
        $content .= '<td class="dish_name">'.$value['nazwa'].'</td>';
        $content .= '<td class="price">'.$value['cena'].'</td>';
        $content .= '</tr>';
      }
      $content .= '</tbody>';
      echo $content;
      echo "</table>";
    }

    public function __destruct()
    {}
  }
?>
