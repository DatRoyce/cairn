<!DOCTYPE html>
<?php
$page = $_POST["page"];
function gc($name) {
	return file_get_contents("../meta/pages/".strtolower(urldecode($name)).".md");
}
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<html>
<head>
	<title>Backend - <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/core.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php include "./sidebar.php"; ?>
	<div id="frame">
		<section id="edit">
			<h1>Editing: <?php echo urldecode($page); ?></h1>
			<form id="compose" action="page.php" method="POST">
				<input type="hidden" name="titlebefore" value='<?php echo $page; ?>'/>
				<input type="text" placeholder="Name your page." name="title" id="title" value="<?php echo ucfirst(htmlentities(urldecode($page))); ?>">
				<textarea name="markdown" id="content" rows="10" placeholder="Whatever you want to say. HTML accepted."><?php echo gc($page); ?></textarea>
				<textarea name="content" id="html" style="display:none;"></textarea>
				<p>
					<strong>Preview:</strong>
					<a class="help" target="_blank" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">?</a>
				</p>
				<blockquote name="markdown" id="preview" style="width:80%;padding:12px;overflow:hidden"></blockquote>
				<br>
				<button type="submit" id="publish" class="button">Publish</button>
				<button name="delete" value="Delete" class="button delete" type="submit">Delete</button>
			</form>
		</section>
	</div>
	<script src="js/vendor/md.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	window.onload = function() {
		document.getElementById('content').oninput = function() {
			document.getElementById('preview').innerHTML = marked(this.value);
		};
		document.getElementById('compose').onsubmit = function() {
			var content = document.getElementById('content');
			document.getElementById("html").value = marked(content.value);
		};
		document.getElementById('content').oninput();
	};
	</script>
</body>
</html>