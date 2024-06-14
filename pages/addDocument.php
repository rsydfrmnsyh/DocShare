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
            $isSuccessUpload = move_uploaded_file($documentLocation, $folder . $indexNewDocument . ".pdf");
            if ($isSuccessUpload) {
                $objDocument = new Documents();
                $objDocument->title = $title;
                $objDocument->author = $author;
                $objDocument->description = $description;
                $objDocument->pages = $pages;
                $objDocument->category->category_id = $category;
                $objDocument->user->user_id = $_SESSION["user_id"];
                $objDocument->url = $folder . $indexNewDocument . ".pdf";
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
<main class="w-4/5 h-full flex flex-column flex-wrap justify-center items-center gap-4">
    <div class="w-full h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white">Add Document</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data"
        class="w-full h-2/3 overflow-y-scroll p-10 gap-4 rounded-lg bg-white shadow flex flex-column flex-wrap justify-center items-center">
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="title" class="font-semibold text-xl w-1/5">Title</label>
            <input type="text" name="title" id="title"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="author" class="font-semibold text-xl w-1/5">Author</label>
            <input type="text" name="author" id="author"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="description" class="font-semibold text-xl w-1/5">Description</label>
            <textarea name="description" id="description"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required></textarea>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="pages" class="font-semibold text-xl w-1/5">Pages</label>
            <input type="number" name="pages" id="pages"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="category" class="font-semibold text-xl w-1/5">Category</label>
            <select name="category" id="category" required
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue cursor-pointer">
                <option value="" selected disabled>-- Select Category --</option>
                <?php foreach ($arrCategories as $value) { ?>
                    <option value="<?= $value->category_id ?>"><?= $value->category_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="upload" class="font-semibold text-xl w-1/5">Upload Document</label>
            <input type="file" name="uploadDocument" id="upload"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <input type="submit" value="Upload" name="submit"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-blue hover:bg-black cursor-pointer">
            <a href="index.php?p=listDocuments"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-red-600 hover:bg-black cursor-pointer">Cancel</a>
        </div>
    </form>
</main>