<?php
if (!isset($_SESSION["user_id"]) && $_SESSION["role"] != "admin") {
    header("location: index.php?p=signin");
    exit();
} else {
    require_once ("./class/class.Documents.php");

    if ($_GET["document_id"]) {
        $objDocuments = new Documents();
        $objDocuments->document_id = $_GET["document_id"];
        $objDocuments->SelectDocumentById();
        $objDocuments->DeleteDocument();

        echo "<script>alert('$objDocuments->message');</script>";
        echo "<script>window.location = 'index.php?p=listDocuments';</script>";
    }
}
?>