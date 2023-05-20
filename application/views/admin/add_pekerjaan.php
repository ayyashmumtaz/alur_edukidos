
<div class="container-fluid">
<title>Form Tambah Data Pekerjaan</title>
	<style>
		form {
			max-width: 500px;
			margin: auto;
			padding: 20px;
			background-color: #f2f2f2;
			border-radius: 5px;
		}
		input[type=text], select, input[type=number] {
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
		.status {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
		}
		.status label {
			margin-right: 10px;
		}
	</style>

	<form action="<?= base_url('admin/simpanPekerjaan');?>" method="POST">

		<label for="target">Nama Pekerjaan:</label>
		<input type="text" id="paket_pekerjaan" name="paket_pekerjaan" required>

		<label for="paket">Keterangan:</label>
		<input type="text" id="target" name="target" required>

		<label for="jumlah">Jumlah:</label>
		<input type="number" id="jumlah" name="jumlah" min="1" required>

		<label for="pekerja">Tim:</label>
		<input type="text" id="pekerja" name="pekerja" required>
		<input type="hidden" name="status" value="belum">

		<input type="submit" value="Submit">
	</form>

</div>
	