<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $lang_array["title"] ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="./resources/setup_views/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- include the core styles -->
	<link rel="stylesheet" href="./resources/setup_views/css/alertify.core.css" />
	<!-- include a theme, can be included into the core instead of 2 separate files -->
	<link rel="stylesheet" href="./resources/setup_views/css/alertify.bootstrap.css" />

	<!-- Theme style -->
	<link rel="stylesheet" href="./resources/setup_views/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="./resources/setup_views/css/skins/_all-skins.min.css">

	<style>
		.dataTables_filter { visibility: hidden;}
		input.error {
			border-color: red;
		}
		input.error:focus {
			border-color: red;
		}
		.error{
			color:red;
		}
	</style>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="skin-blue sidebar-mini" style="background-color: #ecf0f5;">
	<!-- Horizontal Form -->
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="page-header">
			<h1> <?= $lang_array["header"] ?> </h1>
		</div>
		<div class="col-md-8"><p class="lead"><?= $lang_array["headtext"] ?></p></div>
		<div class="col-md-4"></div>
		<br/><br/><br/>
		<div class="box box-solid ">
			<div class="box-header with-border">
				<h3 class="box-title"><?= $lang_array["header-box-4"] ?></h3>
			</div>
			<!-- form start -->
			<div class="box-body">
				<div class="alert alert-dismissible alert-success"><?= $lang_array['alert-4'] ?><a href="<?= $parameters['directory'] ?>"><?= $lang_array['here-4'] ?></a></div>
        	</div>
		</div>
			<!-- /.box-footer -->
	</div>
<div class="col-md-3"></div>

</body>
<!-- jQuery 2.2.3 -->
<script src="./resources/setup_views/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./resources/setup_views/js/bootstrap.min.js"></script>
<script src="./resources/setup_views/js/alertify.js"></script>
<script src="./resources/setup_views/js/jquery.validate.js"></script>
<!-- AdminLTE App -->
<script src="./resources/setup_views/js/app.min.js"></script>
<script type="text/javascript">
	$("#installForm").validate({
		error: function(label) {
			$(this).addClass("error");
		},
		rules: {
			new_db_user: "required",
			new_db_password: "required",
			install_directory: "required",
		},
		messages: {
			new_db_user: "<?= $lang_array['INSTALL_VALIDATION_FORM_DBUSER-3'] ?>",
			new_db_password: "<?= $lang_array['INSTALL_VALIDATION_FORM_DBPASS-3'] ?>",
			install_directory: "<?= $lang_array['INSTALL_VALIDATION_FORM_INSTALLDIRECTORY-3'] ?>",
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
</script>
</html>
