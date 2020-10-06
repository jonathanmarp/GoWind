<?php

$error = "";

if(error_get_last())
{
	$error = error_get_last();
	$file = $error['file'];
	$line = $error['line'];
	$mess = $error ['message'];
}
if($error)
{
	$myfile = fopen($file, "r") or die("Unable to open file!");
	$textOnline = fread($myfile,filesize($file));
	fclose($myfile);
}

?>
<?php if($error) : ?>
	<style type="text/css" media="screen">
		.HandlingErrorFunction {
			position: fixed;
			z-index: 9999999;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: #fff;
		}
		#editor {
			width: 80vw;
			height: 67vh;
		}
		.ace_editor, .ace_editor div{
		    font-family:monospace
		}
	</style>
	<div class="HandlingErrorFunction">
		<div class="container">
			<h1>
				<img src="<?= base_url; ?>assets/img/icon/<?= favicon; ?>" width="50" height="50" />Reporting Error
			</h1>
			<hr />
		</div>
		<div class="container">
			<div class="container">
				<h2><?= $mess; ?> Line: </h2>
				<p>Line: <?= $line; ?></p>
				<p>From: <?= $file; ?></p>
				<hr />
			</div>
			<div id="editor"></div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
	<script>
	    var editor = ace.edit("editor");
	    editor.setTheme("ace/theme/chrome");
	    editor.session.setMode("ace/mode/php");
	    editor.setReadOnly(true);

	    editor.setValue(`<?= $textOnline; ?>`);
	    editor.gotoLine(<?= $line; ?>);
	</script>
<?php endif; ?>