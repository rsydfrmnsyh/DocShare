<?php
class Category extends Connection
{
    private $category_id = 0;
    private $category_name = "";
    private $result = false;
    private $message = '';

    public function __get($attribute1)
    {
        if (property_exists($this, $attribute1)) {
            return $this->$attribute1;
        }
    }

    public function __set($attribute2, $value)
    {
        if (property_exists($this, $attribute2)) {
            $this->$attribute2 = $value;
        }
    }

    public function SelectAllCategory()
    {
        $sql = 'SELECT * FROM tbl_categories';
        $result = mysqli_query($this->connection, $sql);
        $arrResult = Array();
        $count = 0;
        if(mysqli_num_rows($result) > 0)
        {
            while($data = mysqli_fetch_array($result))
            {
                $objCategory = new Category();
                $objCategory->category_id = $data['category_id'];
                $objCategory->category_name = $data['category_name'];
                $arrResult[$count] = $objCategory;
                $count++;
            }
        }
        return $arrResult;
    }
}
?>