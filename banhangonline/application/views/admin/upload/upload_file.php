<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<br />
	<br />
	<h1>Upload file</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		<label>Anh minh hoa</label>
		<input type="file" id="image" name="image" /> <br />
		<label>Anh kem theo</label>
		<input type="file" id="image_list" name="image_list[]" multiple /> <br />
		<input type="submit" name="submit" class="button" value="Upload" />
	</form>
</body>
</html>