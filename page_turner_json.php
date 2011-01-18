<?php
$iip_viewer_host = 'http://iipimageviewer/viewimg.php';
$image_path = $_POST["path"];
$image_name = str_replace('.', ':', $_POST["name"]);
$collection = $_POST["collection"];

# gestisce eccezione incunaboli
if ($collection == 'incunaboli') {
  $path_ar = explode("/", $image_path);
  $n = count($path_ar) - 2;
  $prefix = $path_ar[$n];
  $image_name = sprintf("%s_%s", $prefix, $image_name);
}

$page_turner_service_url = "http://abiblita/page_turner/$image_name/$collection";
$xml_obj = simplexml_load_file($page_turner_service_url);

$next_page = (string)$xml_obj->next_page;
$prev_page = (string)$xml_obj->prev_page;
$current_page = (string)$xml_obj->current_page;

# per incunaboli, strip della stringa
if ($collection == 'incunaboli') {
  $l = strlen("file:///Scan");
  $next_page = substr($next_page, $l);
  $prev_page = substr($prev_page, $l);
}

$pages_urls = array(
  'current_page'  => "$iip_viewer_host?img_path=$image_path&img_name=$current_page",
  'next_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$next_page",
  'prev_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$prev_page",
);
$pages_urls_json = json_encode(array('pages' => $pages_urls));
echo $pages_urls_json;
?>
