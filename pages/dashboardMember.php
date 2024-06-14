<?php
require_once "./class/class.Documents.php";

if (!isset($_SESSION["user_id"]) && $_SESSION["role"] != "member") {
    header("location: index.php?p=signin");
    exit;
} else {
    $objDocuments = new Documents();
    $arrDocuments = $objDocuments->SelectAllDocuments();
}

?>
<main class="w-4/5 h-full">
    <div class="h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white">Hello, <?= $_SESSION["username"] ?></h1>
    </div>
    <div class="h-2/3 p-4 rounded-lg">
        <h1 class="font-semibold mb-2">All Documents</h1>
        <div
            class="h-full flex flex-column flex-wrap gap-4 justify-start items-start overflow-y-scroll scroll-pl-6 snap-x">
            <?php $k = 0; ?>
            <?php while ($k < count($arrDocuments)) { ?>
                <a href="<?php echo $arrDocuments[$k]->url ?>"
                    class="w-48 h-60 snap-start bg-white rounded-lg shadow p-4 text-center flex flex-wrap flex-column justify-center items-center">
                    <h2 class="font-bold text-xl w-full h-3/4 p-4 bg-blue text-white rounded-lg overflow-hidden">
                        <?= $arrDocuments[$k]->title ?>
                    </h2>
                    <h3 class="text-lg w-full">Author: <span class="font-semibold "><?= $arrDocuments[$k]->author ?></span>
                    </h3>
                </a>
                <?php $k++; ?>
            <?php } ?>
        </div>
    </div>
</main>