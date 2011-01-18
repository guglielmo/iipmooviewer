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

  <link rel="stylesheet" type="text/css" media="all" href="css/iip.css" />
  <link rel="shortcut icon" href="images/iip-favicon.png" />
  <title><?php echo urldecode($_GET["img_path"]) . $_GET["img_name"]?></title>

  <script type="text/javascript" src="javascript/mootools-1.3-core-compressed.js"></script>
  <script type="text/javascript" src="javascript/mootools-1.3-more-compressed.js"></script>
  <script type="text/javascript" src="javascript/iipmooviewer-1.1.js"></script>

  <script type="text/javascript">

    // The iipsrv server path (/fcgi-bin/iipsrv.fcgi by default)
    var server = '/fcgi-bin/iipsrv.fcgi';

    // The *full* image path on the server. This path does *not* need to be in the web
    // server root directory. On Windows, use Unix style forward slash paths without
    // the "c:" prefix
    var image_path = '<?php echo $_GET["img_path"]?>';
    var image_name = '<?php echo $_GET["img_name"]?>';
    var collection = '<?php echo $_GET["collection"]?>';
    var image_file = image_path + image_name;

    // Copyright or information message (optional)
    var credit = '&copy; Universit&agrave; degli studi di Roma - La Sapienza';
    

    // Create our viewer object - note: must assign this to the 'iip' variable.
    // See documentation for more details of options
    iip = new IIP( "targetframe", {
  		image: image_file,
  		server: server,
  		zoom: 1,
  		render: 'random',
      showNavButtons: true
    });


    window.addEvent('domready', function() {
      var url = window.location;
      var prev_page = '';
      var next_page = '';

  		var json_request = new Request.JSON({
  			url: "page_turner_json.php",
  			method: 'post',
  			data: { path: image_path, name: image_name, collection: collection },
  			onComplete: function(jsonObj) {
  				next_page_url = jsonObj.pages.next_page_url;
  				prev_page_url = jsonObj.pages.prev_page_url;
  			},
    		onFailure: function() {
    			alert('Errore nella richiesta');
    		}
  		}).send();

      $('zoomin').addEvent('click', function(event) {
        event.stop();
        iip.zoomIn();
    	});
      $('zoomout').addEvent('click', function(event) {
        event.stop();
        iip.zoomOut();
    	});
      $('reset').addEvent('click', function(event) {
        event.stop();
        url.reload();
      });
      $('next_page').addEvent('click', function(event) {
        event.stop();
        window.location = next_page_url;
      });
      $('prev_page').addEvent('click', function(event) {
        event.stop();
        window.location = prev_page_url;
      });
    });
  </script>

 </head>

 <body>
   <div style="position: absolute; right: 1%">
     <ul style="list-style-type:none; width: 25px; text-align: center">
       <li>
         <a href="#" id="zoomin"><img src="images/zoomInColor.png" alt="zoomin" title="ingrandimento" border="0"/></a>       
       </li>
       <li>
         <a href="#" id="zoomout"><img src="images/zoomOutColor.png" alt="zoomout" title="riduzione" border="0" /></a>       
       </li>
       <li>
         <a href="#" id="reset"><img src="images/resetColor.png" alt="reset" title="dimensioni originali" border="0" /></a>       
       </li>
       <li>
         <a href="#" id="next_page"><img src="images/nextPage.png" alt="next page" title="pagina successiva" border="0" /></a>       
       </li>
       <li>
         <a href="#" id="prev_page"><img src="images/prevPage.png" alt="previous page" title="pagina precedente" border="0" /></a>       
       </li>
       
     </ul>      
   </div>
   <div style="width:94%; height:98%; margin-left:auto;margin-right:auto" id="targetframe"></div>
 </body>

</html>
