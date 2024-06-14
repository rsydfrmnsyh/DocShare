<?php
if (!isset($_SESSION["user_id"]) && $_SESSION["role"] != "admin" && !isset($_GET["document_id"])) {
    header("location: index.php?p=signin");
    exit;
} else {
    require_once ("./class/class.Documents.php");

    $objDocuments = new Documents();
    $objCategories = new Categories();
    $arrCategories = $objCategories->SelectAllCategories();
    
    if ($_GET["document_id"]) {
        $objDocuments->document_id = $_GET["document_id"];
        $objDocuments->SelectDocumentById();
        if(isset($_POST["submit"])){
            $objDocuments->title = $_POST["title"];
            $objDocuments->author = $_POST["author"];
            $objDocuments->description = $_POST["description"];
            $objDocuments->category = $_POST["category"];
            $objDocuments->UpdateDocuments();
        }
    }
}
?>
<main>
    <h1>Form Update Documents</h1>
    <h2><?php echo $objDocuments->title; ?></h2>
    <form action="" method="post">
        <div class="flex flex-row justify-center items-center">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= $objDocuments->title ?>">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="<?= $objDocuments->author ?>">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $objDocuments->description ?></textarea>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="category">Category</label>
            <select name="category" id="category" required>
                <option value="<?= $objDocuments->category->category_id ?>" selected><?= $objDocuments->category->category_name ?></option>
                <?php foreach ($arrCategories as $value) { ?>
                    <option value="<?= $value->category_id ?>"><?= $value->category_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="upload">Upload Document</label>
            <a href="<?= $objDocuments->url ?>">Open Document</a>
            <p>Tidak bisa mengedit file document</p>
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Update" name="submit">
            <a href="./index.php?p=listDocuments.php">Cancel</a>
        </div>
    </form>
</main>