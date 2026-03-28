<?php
$config= require getBasePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';
$params=[
    'id'=> $id
];

$listing = $db->query("SELECT * FROM listings WHERE job_id = :id", $params)->fetch();

loadView('listings/listing_details', ['listing' => $listing]);

?>