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
      $fields = array('nazwa', 'cena');
      $result = $db->select($sql, $fields);

      $content = "<caption>$cat</caption>
            <tbody>";
      foreach ($result as $value) {
        $content .= '<tr>';
        $content .= '<td class="dish_name">'.$value['nazwa'].'</td>';
        $content .= '<td class="price">'.$value['cena'].'</td>';
        $content .= '</tr>';
      }
      $content .= '</tbody>';
      return $content;
    }

    public function print($db)
    {
      echo "<table id='$this->category' class='menu_cat'>".$this->build_table($db)."</table>";
    }

    public function __destruct()
    {}
  }
?>
