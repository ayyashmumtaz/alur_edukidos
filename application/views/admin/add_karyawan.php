<div class="container-fluid">

<style>
		form {
			max-width: 500px;
			margin: auto;
			padding: 20px;
			background-color: #f2f2f2;
			border-radius: 5px;
		}
		input[type=text], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #45a049;
		}
		.container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
		}
		.image-preview {
			width: 200px;
			height: 200px;
			margin: 10px;
			position: relative;
			overflow: hidden;
			border-radius: 50%;
		}
		.image-preview img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		.image-preview input {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			width: 100%;
			height: 100%;
			opacity: 0;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<form action="" method="POST" >
        <h2>Form Tambah Data Karyawan</h2>
		<label for="nama">Nama:</label>
		<input type="text" id="nama" name="nama" required>

		<label for="tim">Tim:</label>
		<select id="tim" name="tim" required>
            <option value="tim1">Tim Pagi</option>
            <option value="tim2">Tim Malam</option>

		<label for="jabatan">Jabatan:</label>
		<input type="text" id="jabatan" name="jabatan" required>

		<label for="foto">Upload Foto:</label>
		<div class="container">
			<div class="image-preview">
				<img id="img-preview">
				<input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
			</div>
		</div>

		<input type="submit" value="Submit">
	</form>

	<script>
		function previewImage(event) {
			var reader = new FileReader();
			reader.onload = function(){
				var output = document.getElementById('img-preview');
				output.src = reader.result;
			};
			reader.readAsDataURL(event.target.files[0]);
		}
	</script>


</div>