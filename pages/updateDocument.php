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
        if (isset($_POST["submit"])) {
            $objDocuments->title = $_POST["title"];
            $objDocuments->author = $_POST["author"];
            $objDocuments->description = $_POST["description"];
            $objDocuments->category->category_id = $_POST["category"];
            $objDocuments->UpdateDocuments();
            if ($objDocuments->result) {
                echo "<script>alert('$objDocuments->message');</script>";
                echo "<script>window.location.href='./index.php?p=listDocuments';</script>";
            } else {
                echo "<script>alert('$objDocuments->message');</script>";
                echo "<script>window.location.href='./index.php?p=updateDocument&document_id=$objDocuments->document_id';</script>";
            }
        }
    }
}
?>

<main class="w-4/5 h-full flex flex-column flex-wrap justify-center items-center gap-4">
    <div class="w-full h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column flex-wrap justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white w-full">Form Update Document</h1>
        <p class="text-white text-center text-xl"><?php echo $objDocuments->title; ?></p>
    </div>
    <form action="" method="post"
        class="w-full h-2/3 p-10  overflow-y-scroll rounded-lg bg-white shadow flex flex-column flex-wrap justify-center items-center gap-4">
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="title" class="font-semibold text-xl w-1/5">Title</label>
            <input type="text" name="title" id="title" value="<?= $objDocuments->title ?>"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="author" class="font-semibold text-xl w-1/5">Author</label>
            <input type="text" name="author" id="author" value="<?= $objDocuments->author ?>"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="description" class="font-semibold text-xl w-1/5">Description</label>
            <textarea name="description" id="description"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"><?= $objDocuments->description ?></textarea>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="category" class="font-semibold text-xl w-1/5">Category</label>
            <select name="category" id="category"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
                <option value="<?= $objDocuments->category->category_id ?>" selected>
                    <?= $objDocuments->category->category_name ?>
                </option>
                <?php foreach ($arrCategories as $value) { ?>
                    <option value="<?= $value->category_id ?>"><?= $value->category_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="upload" class="font-semibold text-xl w-1/5">Upload Document</label>
            <div class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
                <a href="<?= $objDocuments->url ?>"
                    class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-blue hover:bg-black cursor-pointer">Open
                    Document</a>
                <p>Tidak bisa mengedit file document</p>
            </div>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <input type="submit" value="Update" name="submit"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-blue hover:bg-black cursor-pointer">
            <a href="./index.php?p=listDocuments.php"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-red-600 hover:bg-black cursor-pointer">Cancel</a>
        </div>
    </form>
</main>