<?php
$iip_viewer_host = 'http://iipmooviewer.celata.com/viewimg.php';
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

$page_turner_service_url = "http://biblita.celata.com/page_turner/$image_name/$collection";
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

# sostituisce l'estensione jpeg con .tif nelle url delle
# prev e next
list($next_name, $next_ext) = explode(".", $next_page);
list($prev_name, $prev_ext) = explode(".", $prev_page);
if ($collection == 'orlando' || $collection == 'cortegiano') {
  $next_name = strtoupper($next_name);
  $prev_name = strtoupper($prev_name);
}
$next_page = sprintf("%s.%s", $next_name, 'tif');
$prev_page = sprintf("%s.%s", $prev_name, 'tif');



$pages_urls = array(
  'current_page'  => "$iip_viewer_host?img_path=$image_path&img_name=$current_page&collection=$collection",
  'next_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$next_page&collection=$collection",
  'prev_page_url' => "$iip_viewer_host?img_path=$image_path&img_name=$prev_page&collection=$collection",
);
$pages_urls_json = json_encode(array('pages' => $pages_urls));
echo $pages_urls_json;
?>
