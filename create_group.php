<?php
$fonts = $_POST['fonts'];
$group_id = uniqid();
file_put_contents("groups/$group_id.json", json_encode($fonts));
echo "Group created";

