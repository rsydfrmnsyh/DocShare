<?php
include "class.User.php";
include "class.Category.php";

class Documents extends Connection
{
    private $document_id = 0;
    private $title = '';
    private $author = '';
    private $description = '';
    private $img = '';
    private $pages = '';
    private $url = '';
    private $created_at = '';
    private $updated_at = '';
    private $user;
    private $category;

    private $result = false;
    private $message = '';

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

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->category = new Category();
    }

    public function SelectAllDocuments()
    {
        $sql = 'SELECT d.*, u.user_id, u.username, u.profile_photo, c.category_name FROM tbl_documents d INNER JOIN tbl_users  u ON d.user_upload_id = u.user_id INNER JOIN tbl_categories c ON d.category_id = c.category_id';
        $result = mysqli_query($this->connection, $sql);
        $arrResult = array();
        $count = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $objDocuments = new Documents();
                $objDocuments->id = $data['document_id'];
                $objDocuments->title = $data['title'];
                $objDocuments->author = $data['author'];
                $objDocuments->description = $data['description'];
                $objDocuments->img = $data['img'];
                $objDocuments->user->user_id = $data["user_id"];
                $objDocuments->user->username = $data["username"];
                $objDocuments->user->profile_photo = $data["profile_photo"];
                $objDocuments->category->category_id = $data['category_id'];
                $objDocuments->category->category_name = $data['category_name'];
                $objDocuments->pages = $data['page'];
                $objDocuments->created_at = $data['created_at'];
                $objDocuments->updated_at = $data['updated_at'];
                $arrResult[$count] = $objDocuments;
                $count++;
            }
        }
        return $arrResult;
    }

    public function AddDocument()
    {
        $sql = "INSERT INTO tbl_documents (title, author, description, category_id, user_upload_id, url)
                    VALUES ('$this->title', '$this->author', '$this->description', '" . $this->category->category_id . "', '" . $this->user->user_id . "' , '$this->url')";

        $this->result = mysqli_query($this->connection, $sql);
        if ($this->result)
            $this->message = 'document successfully added';
        else
            $this->message = 'failed to add document';
    }

    public function UpdateDocuments()
    {
        $sql = "UPDATE tbl_documents
                    SET title = '$this->d_title',
                    author = '$this->d_author',
                    description = '$this->d_desc',
                    img = '$this->d_img',
                    page = '$this->d_pages'
                    WHERE document_id = $this->d_id";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result)
            $this->message = 'document successfully updated';
        else
            $this->message = 'failed to update document';
    }

    public function DeleteDocument()
    {
        $sql = "DELETE FROM tbl_documents
                    WHERE document_id = $this->d_id";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result)
            $this->message = 'document successfully deleted';
        else
            $this->message = 'failed to delete document';
    }
}
?>