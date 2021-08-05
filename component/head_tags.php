<?php
	$title = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
	$page_name = str_replace(' ',' ',ucwords(str_replace('-',' ', $title)))
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<title><?=($page_name == "Index")? "Home" : $page_name ?> :: Prahelika Solitary</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="assets/css/custom.css" rel="stylesheet">	
<link rel="stylesheet" href="assets/plugins/sweetmodal/jquery.sweet-modal.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" />
<link rel="icon" href="assets/img/favicon.png" type="image/png" >

<?php
	// sweetmodal
	function show_alert($msg) {
	    echo "<script> window.onload = function() { $.sweetModal('".$msg."'); }; </script>";
	}
	function show_success($msg){
		echo "<script> window.onload = function() { $.sweetModal({
			content:'".$msg."',
			icon:$.sweetModal.ICON_SUCCESS
		}); }; </script>";
	}
	function show_success_redirect($msg,$page = '#',$time= 1500){
		echo "<script> window.onload = function() { $.sweetModal({
			content:'".$msg."',
			icon:$.sweetModal.ICON_SUCCESS
		}); }; </script>";
		echo "<script>window.setTimeout(function(){window.location.href = '".$page."';}, ".$time.");</script>";
	}
	
	function show_warning($msg){
		echo "<script> window.onload = function() { $.sweetModal({
			content:'".$msg."',
			icon:$.sweetModal.ICON_WARNING
		}); }; </script>";
	}
	function show_error($msg,$title = 'Oh noes…',$btn_name ='Exit' ){
		echo "<script> window.onload = function() { $.sweetModal({
			content:'".$msg."',
			title: '".$title."',
			icon:$.sweetModal.ICON_ERROR,
			buttons: [
				{
					label: '".$btn_name."',
					classes: 'redB'
				}
			]
		}); }; </script>";
	}
	function show_notification($msg, $title = 'Notification') {
	    echo "<script> window.onload = function() { $.sweetModal('".$title."','".$msg."'); }; </script>";
	}

	function confirm_redirect_msg($msg='Confirm please?',$page = '#') {
	    echo "<script> window.onload = function() {
	    	$.sweetModal.confirm('".$msg."', function() {
				window.location.href = '".$page."';
			});
	    }; </script>";
	}

	function confirm_multiple_redirect_msg($msg='Confirm please?', $title = 'Titled Confirm',  $success_page = '#', $failed_page = '#') {
	    echo "<script> window.onload = function() {
	    	$.sweetModal.confirm('".$title."', '".$msg."', function() {
				window.location.href = '".$success_page."';
			},function() {
				window.location.href = '".$failed_page."';
			});
	    }; </script>";
	}
	function titled_confirm_msg($msg='Confirm please?', $title = 'Titled Confirm',  $yes_msg = 'Thanks for Accepting!', $no_msg = 'You declined!') {
	    echo "<script> window.onload = function() {
	    	$.sweetModal.confirm('".$title."', '".$msg."', function() {
				$.sweetModal('".$yes_msg."');
			},function() {
				$.sweetModal('".$no_msg."');
			});
	    }; </script>";
	}
	
	function youtube($msg,$video_link = 'https://www.youtube.com/watch?v=gocwRvLhDf8'){
		echo "<script> window.onload = function() { $.sweetModal({
			title: '".$msg."',
			content:'".$video_link."',
			theme: $.sweetModal.THEME_DARK
		}); }; </script>";
	}
?>