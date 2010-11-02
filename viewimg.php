<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >

 <head>
  <meta name="author" content="Ruven Pillay &lt;ruven@users.sourceforge.netm&gt;"/>
  <meta name="keywords" content="IIPImage Ajax Internet Imaging Protocol IIP Zooming Streaming High Resolution Mootools"/>
  <meta name="description" content="IIPImage: High Resolution Remote Image Streaming Viewing"/>
  <meta name="copyright" content="&copy; 2003-2008 Ruven Pillay"/>

  <meta http-Equiv="Cache-Control" Content="no-cache">
  <meta http-Equiv="Pragma" Content="no-cache">
  <meta http-Equiv="Expires" Content="0">

  <link rel="stylesheet" type="text/css" media="all" href="css/iip.compressed.css" />
  <link rel="shortcut icon" href="images/iip-favicon.png" />
  <title><?php echo urldecode($_GET["img_path"]) . $_GET["img_name"]?></title>

  <script type="text/javascript" src="javascript/mootools-1.2-core-compressed.js"></script>
  <script type="text/javascript" src="javascript/mootools-1.2-more-compressed.js"></script>
  <script type="text/javascript" src="javascript/iipmooviewer-1.1.js"></script>

  <script type="text/javascript">

    // The iipsrv server path (/fcgi-bin/iipsrv.fcgi by default)
    var server = '/fcgi-bin/iipsrv.fcgi';

    // The *full* image path on the server. This path does *not* need to be in the web
    // server root directory. On Windows, use Unix style forward slash paths without
    // the "c:" prefix
    var image_file = '<?php echo urldecode($_GET["img_path"]) . $_GET["img_name"]?>';

    // Copyright or information message (optional)
    var credit = '&copy; Universit&agrave; degli studi di Roma - La Sapienza';

    // Create our viewer object - note: must assign this to the 'iip' variable.
    // See documentation for more details of options
    iip = new IIP( "targetframe", {
  		image: image_file,
  		server: server,
  		zoom: 1,
  		render: 'random',
      showNavButtons: false
    });

  </script>

 </head>

 <body>
   <div style="width:98%;height:98%;margin-left:auto;margin-right:auto" id="targetframe"></div>
 </body>

</html>
