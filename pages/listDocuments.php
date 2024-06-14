<?php
require_once "./class/class.Documents.php";

$objDocuments = new Documents();
$arrDocuments = $objDocuments->SelectAllDocuments();
?>
<main class="w-4/5 h-full">
    <div class="h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white">List All Documents</h1>
    </div>
    <div class="h-auto py-4 flex flex-column justify-start items-center">
        <a href="index.php?p=addDocument"
            class="bg-blue px-4 py-2 rounded-lg shadow font-semibold hover:bg-black text-white">Add Document</a>
    </div>
    <div class="h-3/5 bg-white rounded-lg p-10 overflow-y-auto">
        <table border="" class="w-full">
            <thead>
                <tr>
                    <th class="border border-black p-2">#</th>
                    <th class="border border-black p-2">Title</th>
                    <th class="border border-black p-2">Category</th>
                    <th class="border border-black p-2">Description</th>
                    <th class="border border-black p-2">Author</th>
                    <th class="border border-black p-2">Contributor</th>
                    <th class="border border-black p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($arrDocuments)) {
                    $i = 0;
                    foreach ($arrDocuments as $value) { ?>
                        <tr>
                            <td class="border border-black p-2"><?= ++$i ?></td>
                            <td class="border border-black p-2"><?= $value->title ?></td>
                            <td class="border border-black p-2"><?= $value->category->category_name ?></td>
                            <td class="border border-black p-2"><?= $value->description ?></td>
                            <td class="border border-black p-2"><?= $value->author ?></td>
                            <td class="border border-black p-2"><?= $value->user->username ?></td>
                            <td class="border border-black p-2"><a href="<?= $value->url ?>"
                                    class="bg-blue p-2 rounded-lg font-semibold text-white hover:bg-black mr-2">open</a><a
                                    href="index.php?p=updateDocument&document_id=<?= $value->document_id ?>"
                                    class="bg-blue p-2 rounded-lg font-semibold text-white hover:bg-black  mr-2">Update</a><a
                                    href="index.php?p=deleteDocument&document_id=<?= $value->document_id ?>"
                                    class="bg-red-600 p-2 rounded-lg font-semibold text-white hover:bg-black">Delete</a></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">Data tidak ditemukan</td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</main>