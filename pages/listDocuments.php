<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();
} else {
    $user_id = $_SESSION["user_id"];

    require_once ("./class/class.documents.php");

    $objDoc = new Documents();
    $arrDocuments = $objDoc->SelectAllDocuments();
}
?>
<main>
    <h1>List all Document</h1>
    <a href="index.php?p=addDocument">Add Document</a>
    <table border="">
        <thead>
            <tr>
                <th class = "border border-black">document id</th>
                <th class = "border border-black">title</th>
                <th class = "border border-black">author</th>
                <th class = "border border-black">description</th>
                <th class = "border border-black">image</th>
                <th class = "border border-black">category id</th>
                <th class = "border border-black">user upload id</th>
                <th class = "border border-black">page</th>
                <th class = "border border-black">created at</th>
                <th class = "border border-black">updated at</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($arrDocuments) == 0)
                {
                    $no = 1;
                    foreach($arrDocuments as $docdata)
                    {
                        ?>
                            <tr>
                                <td class="border border-black"><?= ++$no ?></td>
                                <td class="border border-black"><?= $value["document_id"] ?></td>
                                <td class="border border-black"><?= $value["title"] ?></td>
                                <td class="border border-black"><?= $value["author"] ?></td>
                                <td class="border border-black"><?= $value["description"] ?></td>
                                <td class="border border-black"><img src="<?= $value["img"] ?>" alt=""
                                        title="<?= $value["img"] ?>" width="50"></td>
                                <td class="border border-black"><?= $value["category_id"] ?></td>
                                <td class="border border-black"><?= $value["user_upload_id"] ?></td>
                                <td class="border border-black"><?= $value["page"] ?></td>
                                <td class="border border-black"><?= $value["created_at"] ?></td>
                                <td class="border border-black"><?= $value["updated_at"] ?></td>
                                <td class="border border-black"><a
                                        href="index.php?p=updateDocument&document_id=<?= $value["document_id"] ?>">Update</a><a
                                        href="index.php?p=deleteDocument&document_id=<?= $value["document_id"] ?>">Delete</a></td>
                            </tr>
                        <?php                    
                    }
                } else
                {
                    ?>
                        <tr>
                            <td colspan="7">Data not found</td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</main>