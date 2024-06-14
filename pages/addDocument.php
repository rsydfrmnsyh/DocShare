<?php

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("location: index.php?p=signin");
    exit;
} else {
    require_once "./class/class.Documents.php";
    require_once "./class/class.Categories.php";

    $objCategories = new Categories();
    $arrCategories = $objCategories->SelectAllCategories();

    $objDocuments = new Documents();
    $arrDocuments = $objDocuments->SelectAllDocuments();
    $indexNewDocument = count($arrDocuments) + 1;

    print_r($arrCategories[0]->category_id);

    if (isset($_POST["submit"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $pages = $_POST["pages"];
        $category = $_POST["category"];

        // upload document
        $documentName = $_FILES["uploadDocument"]["name"];
        $documentType = $_FILES["uploadDocument"]["type"];
        $documentSize = $_FILES["uploadDocument"]["size"];
        $documentLocation = $_FILES["uploadDocument"]["tmp_name"];

        $folder = "./uploads/documents/" . $indexNewDocument . "/";
        // membuat folder baru path sesuai dengan id buku contoh: ./uploads/documents/1/
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if ($documentType != "application/pdf") {
            echo "<script>alert('bukan file yang diinginkan!');</script>";
            echo "<script>window.location='index.php?p=addDocument'</script>";
        } else if ($documentSize >= 100000000) {
            echo "<script>alert('Size File tidak boleh lebih dari 100MB!');</script>";
            echo "<script>window.location='index.php?p=addDocument'</script>";
        } else {
            $isSuccessUpload = move_uploaded_file($documentLocation, $folder . $title . ".pdf");
            if ($isSuccessUpload) {
                $objDocument = new Documents();
                $objDocument->title = $title;
                $objDocument->author = $author;
                $objDocument->description = $description;
                $objDocument->pages = $pages;
                $objDocument->category->category_id = $category;
                $objDocument->user->user_id = $_SESSION["user_id"];
                $objDocument->url = $folder . $title . ".pdf";
                $objDocument->AddDocument();

                if ($objDocument->result) {
                    echo "<script>alert('$objUser->message');</script>";
                    echo "<script>window.location.href='./index.php?p=listDocuments';</script>";
                } else {
                    echo "<script>alert('$objUser->message');</script>";
                    echo "<script>window.location.href='./index.php?p=addDocument';</script>";
                }
            }
        }
    }
}
?>
<main>
    <h1>Add Document</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-row justify-center items-center">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="pages">Pages</label>
            <input type="number" name="pages" id="pages" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="" selected disabled>-- Select Category --</option>
                <?php foreach ($arrCategories as $value) { ?>
                    <option value="<?= $value->category_id ?>"><?= $value->category_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="upload">Upload Document</label>
            <input type="file" name="uploadDocument" id="upload" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Upload" name="submit">
            <a href="index.php?p=listDocuments">Cancel</a>
        </div>
        <div class="flex flex-row justify-center items-center">
            <p>Sistem akan otomatis menjadikan halaman pertama sebagai cover</p>
        </div>
    </form>
</main>