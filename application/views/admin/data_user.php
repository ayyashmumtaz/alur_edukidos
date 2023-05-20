<?php if ($this->session->flashdata('update_berhasil')) : ?>
  <script type="text/javascript">
    let timerInterval
    Swal.fire({
      title: 'Update Berhasil!',
      html: ' ',
      icon: 'success',
      timer: 1500,

      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
      },
      willClose: () => {
        clearInterval(timerInterval)
      }

    })
  </script>
  <?= $this->session->flashdata('update_berhasil') ?>

<?php endif ?>

<?php if ($this->session->flashdata('input-berhasil')) : ?>
  <script type="text/javascript">
    let timerInterval
    Swal.fire({
      title: 'Data Berhasil Ditambahkan!',
      html: ' ',
      icon: 'success',
      timer: 1500,

      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
      },
      willClose: () => {
        clearInterval(timerInterval)
      }

    })
  </script>
  <?= $this->session->flashdata('input-berhasil') ?>
<?php endif ?>

<?php if ($this->session->flashdata('hapus-berhasil')) : ?>
  <script type="text/javascript">
    let timerInterval
    Swal.fire({
      title: 'Data Berhasil Dihapus!',
      html: ' ',
      icon: 'success',
      timer: 1500,

      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
      },
      willClose: () => {
        clearInterval(timerInterval)
      }

    })
  </script>
  <?= $this->session->flashdata('hapus-berhasil') ?>
<?php endif ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "columnDefs": [{
        "width": "2%",
        "targets": 0
      }]
    })
  });
</script>


<div class="container-fluid">
<a class="btn btn-sm btn-success" href="<?= base_url('admin/addKaryawan'); ?>">+ Tambah Karyawan</a>
<br>
<br>

  <h3>Data User Aplikasi</h3>
  <div class="table-responsive">
    <table id="example" class="display" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>username</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
     
          <tr>
            <td><?php echo 1 ?></td>
            <td>nama_bahan ?></td>
            <td>satuan ?></td>     
            <td>
              <a class="btn btn-sm btn-primary" href="<?= base_url('Master/edit_bahan/');?>">Edit</a>
              <a class="btn btn-sm btn-danger remove" href="<?= base_url('Master/hapus_bahan/');?>" onclick="return confirm('Anda Yakin Ingin Menghapus Data Bahan ID : <id_bahan ?> Ini?');">Hapus</a>
            </td>
          </tr>
  
      </tbody>
    </table>
  </div>
</div>
