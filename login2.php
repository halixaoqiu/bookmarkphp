<!DOCTYPE html>  
<html>  
    <head>  
<?php
	if(empty($page_title)){
		$page_title = "草莓收藏";
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?php echo $page_title?></title>
<link href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link href="static/bookmark.css" rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   
         
    </head>  
    <body>  
<!--        <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>  -->
        <!-- Modal -->  
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  
                <h3 id="myModalLabel">Modal header</h3>  
            </div>  
            <div class="modal-body">  
                <p>弹出层…</p>  
            </div>  
            <div class="modal-footer">  
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>  
                <button class="btn btn-primary">Save changes</button>  
            </div>  
        </div>  
    </body>  
</html>  