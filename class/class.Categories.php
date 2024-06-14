<?php
class Categories extends Connection
{
    private $category_id = 0;
    private $category_name = "";
    private $result = false;
    private $message = "";

    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        }
    }

    public function __set($attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $value;
        }
    }

    public function SelectAllCategories(){
        $sql = "SELECT * FROM tbl_categories";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $count = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $objCategories = new Categories();
                $objCategories->category_id = $data["category_id"];
                $objCategories->category_name = $data["category_name"];
                $arrResult[$count] = $objCategories;
                $count++;
            }
        }
        return $arrResult;
    }
}
?>