<?php
require_once "./class/class.Documents.php";

$objDocuments = new Documents();
$arrDocuments = $objDocuments->SelectAllDocuments();
 ?>
<main>
    <h1>List all Document</h1>
    <a href="index.php?p=addDocument">Add Document</a>
    <table border="">
        <thead>
            <tr>
                <th class="border border-black">#</th>
                <th class="border border-black">document_id</th>
                <th class="border border-black">title</th>
                <th class="border border-black">category</th>
                <th class="border border-black">description</th>
                <th class="border border-black">author</th>
                <th class="border border-black">user_upload_id</th>
                <th class="border border-black">url</th>
                <th class="border border-black">action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($arrDocuments)) {
                $i = 0;
                foreach ($arrDocuments as $value) { ?>
                    <tr>
                        <td class="border border-black"><?= ++$i ?></td>
                        <td class="border border-black"><?= $value->document_id ?></td>
                        <td class="border border-black"><?= $value->title ?></td>
                        <td class="border border-black"><?= $value->category->category_name ?></td>
                        <td class="border border-black"><?= $value->description ?></td>
                        <td class="border border-black"><?= $value->author ?></td>
                        <td class="border border-black"><?= $value->user->username ?></td>
                        <td class="border border-black"><?= $value->url ?></td>
                        <td class="border border-black"><a href="<?= $value->url ?>">open</a><a href="index.php?p=deleteDocument&document_id=<?= $value->document_id ?>">Delete</a><a href="index.php?p=updateDocument&document_id=<?= $value->document_id ?>">Update</a></td>
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
</main>