<?php
$iip_viewer_host = 'http://iipmooviewer.celata.com/viewimg.php';
$image_path = $_POST["path"];
$image_name = str_replace('.', ':', $_POST["name"]);
$page_turner_service_url = "http://biblita.celata.com/page_turner/$image_name";
$collection = $_POST["collection"];
$xml_obj = simplexml_load_file($page_turner_service_url);

$next_page = (string)$xml_obj->next_page;
$prev_page = (string)$xml_obj->prev_page;
$current_page = (string)$xml_obj->current_page;

$pages_urls = array(
  'current_page'  => "$iip_viewer_host?img_path=$image_path&img_name=$current_page",
  'next_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$next_page",
  'prev_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$prev_page",
);
$pages_urls_json = json_encode(array('pages' => $pages_urls));
echo $pages_urls_json;
?>
