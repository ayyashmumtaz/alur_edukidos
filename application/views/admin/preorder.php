
<script type="text/javascript">
$(document).ready(function() {
  var table =  $('#example').DataTable({
 
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '<?php echo base_url('home/getPekerjaanTable'); ?>',
            'type': 'GET'
        },
        'columns': [
            { 'data': '',
        render: function(data, type, row, meta) {
          return meta.row + 1; // Menampilkan nomor urut
        } },
            { 'data': 'paket_pekerjaan' },
            { 'data': 'target' },
            { 'data': 'pekerja' },
            { 'data': 'status', render: function(data, type, row) {
              var buttonHtml;

switch (data) {
  case 'belum':
    buttonHtml = ' <span class="badge bg-danger rounded-3 fw-semibold">Belum Dikerjakan</span>';
    break;
  case 'selesai':
    buttonHtml = ' <span class="badge bg-success rounded-3 fw-semibold">Selesai</span>';
    break;
    case 'proses':
    buttonHtml = ' <span class="badge bg-warning rounded-3 fw-semibold">Proses Pengerjaan</span>';
    break;
  default:
    buttonHtml = '';
    break;
}

return buttonHtml;
}


},
{ 'data': 'status', render: function(data, type, row) {
              var buttonHtml;

switch (data) {
  default:
    buttonHtml = '<span class="badge bg-primary rounded-3 fw-semibold">HAPUS</span>';
    break;
}

return buttonHtml;
}


},


        ]
        
    });


  });
        


</script>



          


      <div class="container-fluid">
      <?php if ($this->session->flashdata('pesan')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> Data berhasil disimpan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            <?php endif ?>
          
        <!--  Row 1 -->
        <a class="btn btn-sm btn-success" href="<?= base_url('admin/addPekerjaan'); ?>">+ Tambah Pekerjaan</a>
<br>
<br>
        <div class="row">
  
          <div style="position:absolute; float:right;" class="col-lg-10">
    <div class="card w-100">
      <div class="card-body p-4">
        <h2 class="card-title fw-semibold mb-4">DAFTAR PEKERJAAN HARI INI</h2>
       
        <div class="table-responsive">
<table id="example" class="display" style="width:100%">
<thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0 narrow-column">NO</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">PEKERJAAN</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">KETERANGAN</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">TEAM</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">STATUS</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">ACTION</h6>
                </th>
              </tr>
            </thead>
        
           
</table>
</div>
      </div>
    </div>

  </div>
          </div>

  
       
        
       

     