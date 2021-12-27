<?php
  class Menu
  {
    private $category;

    private row_start, row_end, cell_start, cell_end = '<tr>', '</tr>', '<td>', '</td>';

    protected $categories_types = array('Dania główne' => 'glowne', 'Dodatki obiadowe do wyboru' => 'dodatki', 'Zupy' => 'zupy', 'Potrawy mączne' => 'maczne');

    public function __construct($category)
    {
      $this->category = $category;
    }

    public build_table($db){
      $sql = "SELECT * FROM menu WHERE `kategoria` LIKE $categories_types[$category]";
      $fields = array('nazwa', 'cena');
      $result = $db->select($sql, $fileds);

      var_dump($result);
    }

    public print()
    {
      //TODO... printing menu from DB
    }

    public __destruct()
    {}
  }
?>
