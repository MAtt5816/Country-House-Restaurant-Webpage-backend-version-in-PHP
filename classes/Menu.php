<?php
  class Menu
  {
    private $category;

    private const tabe_tags = array(
      'row_start' => '<tr>',
      'row_end' => '</tr>',
      'cell_start' => '<td>',
      'cell_end' => '</td>'
      );

    protected $categories_types = array('glowne' => 'Dania główne', 'dodatki' => 'Dodatki obiadowe do wyboru', 'zupy' => 'Zupy', 'maczne' => 'Potrawy mączne');

    public function __construct($category)
    {
      $this->category = $category;
      echo "OBJ = $category <br />";
    }

    public function build_table($db){
      $key = $this->category;
      $cat = $this->categories_types[$key];
      $sql = "SELECT * FROM `menu` WHERE `kategoria` LIKE '$cat'";
      $fields = array('nazwa', 'cena');
      $result = $db->select($sql, $fields);

      var_dump($result);  //temp print
    }

    public function print()
    {
      //TODO... printing menu from DB
    }

    public function __destruct()
    {}
  }
?>
