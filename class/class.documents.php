<?php
    class Documents extends Connection
    {
        private $d_id = 0;
        private $d_title = '';
        private $d_author = '';
        private $d_desc = '';
        private $d_img = '';
        private $d_category_id = '';
        private $d_user_upload_id = 0;
        private $d_pages = '';
        private $d_created_at = '';
        private $d_updated_at = '';

        private $result = false;
        private $message = '';

        public function __get($attribute1)
        {
            if (property_exists($this, $attribute1))
            {
                return $this->$attribute1;
            }
        }

        public function __set($attribute2, $value)
        {
            if (property_exists($this, $attribute2))
            {
                $this->$attribute2 = $value;
            }
        }

        public function SelectAllDocuments()
        {
            $sql = 'SELECT d.*, u.user_id
                    FROM tbl_documents d INNER JOIN tbl_users u
                    ON d.user_upload_id = u.user_id';
            $result = mysqli_query($this->connection, $sql);
            $arrResult = Array();
            $count = 0;
            if(mysqli_num_rows($result) > 0)
            {
                while($data = mysqli_fetch_array($result))
                {
                    $objDocuments = new Documents();
                    $objDocuments->d_id = $data['document_id'];
                    $objDocuments->d_tile = $data['title'];
                    $objDocuments->d_author = $data['author'];
                    $objDocuments->d_desc = $data['description'];
                    $objDocuments->d_imh = $data['img'];
                    $objDocuments->d_category_id = $data['category_id'];
                    $objDocuments->d_user_upload_id->user_id = $data['user_id'];
                    $objDocuments->d_pages = $data['page'];
                    $objDocuments->d_created_at = $data['created_at'];
                    $objDocuments->d_updated_at = $data['updated_at'];
                    $arrResult[$count] = $objDocuments;
                    $count++;
                }
            }
            return $arrResult;
        }

        public function AddDocuments()
        {
            $sql = "INSERT INTO tbl_documents (title, author, description, img, page)
                    VALUES ($this->d_title, $this->d_author, $this->d_desc, $this->d_img, $this->d_pages)";
            $this->result = mysqli_query($this->connection, $sql);

            if($this->result)
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

            if($this->result)
                $this->message = 'document successfully updated';
            else
                $this->message = 'failed to update document';
        }

        public function DeleteDocument()
        {
            $sql = "DELETE FROM tbl_documents
                    WHERE document_id = $this->d_id";
            $this->result = mysqli_query($this->connection, $sql);

            if($this->result)
                $this->message = 'document successfully deleted';
            else
                $this->message = 'failed to delete document';
        }
    }
?>