<?php

session_start();

include( 'includes/config.inc.php' );
include( 'includes/function.php' );

if( isset( $_POST['ajax_call'] ) && ! empty( $_POST['ajax_call'] ) ){
	$ajax_proc = $_POST['ajax_proc'];
	switch( $ajax_proc ){
	
		case 'apsuggest':
			echo json_encode( array( 'airports' => $config['airports'] ) );
		break;
	
	}
	exit;
}

if( isset( $_POST['form_submit'] ) && 
	! empty( $_POST['form_submit'] ) &&
	$_POST['form_submit'] == $_SESSION['sid']
){
	$_SESSION['form_post'] = $_POST;
	header ('HTTP/1.1 301 Moved Permanently');
	header( 'Location: splash.php' );
	exit;
}

if( isset( $_GET['p'] ) && $_GET['p'] == 'run' ){
	
	if( $_SESSION['sid'] == $_SESSION['form_post']['form_submit'] ){
		if( isset( $_SESSION['form_post'] ) && ! empty( $_SESSION['form_post'] ) ){
			
			include_once( 'crawlers/qantas.php' );
			$_SESSION['html'] = $html;
?>
			<script>
				window.parent.redir();
			</script>
<?php			
		}else{
			echo 'error 500';
		}
	}else{
		echo 'error 500';
	}
	unset( $_SESSION['form_post'] );
	exit;
}

renderPage();
?>