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

    protected $categories_types = array('Dania główne' => 'glowne', 'Dodatki obiadowe do wyboru' => 'dodatki', 'Zupy' => 'zupy', 'Potrawy mączne' => 'maczne');

    public function __construct($category)
    {
      $this->category = $category;
      echo "OBJ = $category <br />";
    }

    public function build_table($db){
      $sql = "SELECT * FROM menu WHERE `kategoria` LIKE $categories_types[$category]";
      echo $sql;
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
