<style>
  .marquee-container {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 30px;
  overflow: hidden;
}

.marquee-text {
  position: absolute;
  animation: marquee 50s linear infinite;
}

.marquee-line {
  height: 30px;
  background-color: black;
  border: none;
  margin-top: -1px;
}


@keyframes marquee {
  0% { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}
</style>

<script type="text/javascript">
$(document).ready(function() {
  var table =  $('#example').DataTable({
 
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '<?php echo site_url('home/getPekerjaanTable'); ?>',
            'type': 'GET'
        },
        columnDefs: [
      { targets: [0], width: '50px' },
      { targets: [4], width: '50px' }, // Mengatur lebar kolom indeks 0 menjadi 50 piksel
       // Mengatur lebar kolom indeks 1 menjadi 100 piksel
      // Tambahkan kolom dan lebar sesuai kebutuhan Anda
    ],
        'columns': [
          { 'data': 'waktu'},
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
{ render: function(data, type, row) {
  var id_bekerja = row.status;
              var buttonHtml;

switch (id_bekerja) {
  case 'belum':
               buttonHtml = ' <button class="badge bg-primary rounded-3 fw-semibold editButton" data-id="'+ row.id_kerja +'">KLIK UNTUK MENGERJAKAN</button>';
    break;
    case 'selesai':
               buttonHtml = 'Selesai :'+ row.waktu_selesai +'';
    break;
    case 'proses':
               buttonHtml = ' <button class="badge bg-secondary rounded-3 fw-semibold doneButton" data-id="'+ row.id_kerja +'">KLIK JIKA SUDAH SELESAI</button>';
    break;
    default:
 buttonHtml = ''
    break;
}

return buttonHtml;
}


},


        ]
        
    });

    function playNotificationSound() {
        var audio = new Audio('<?php echo base_url('sound/kerjaan.mp3'); ?>');
        audio.play();
    }

    function stopMusic(){
      audio.pause();
      audio.currentTime = 0;
    }

    $.ajax({
            url: '<?php echo site_url('home/getPekerjaanTable'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
           
           var mulaiHitung = response.recordsTotal;
           console.log(response.recordsTotal);
           

            }


       });


      
      
        
  var previousCount = 0;
         

    function fetchData() {
      
        $.ajax({
            url: '<?php echo site_url('home/getPekerjaanTable'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              
                // Ambil jumlah data saat ini
                var currentCount = response.recordsTotal;
              console.log('saat ini : ' + currentCount);  
              console.log('sebelum ini : ' + previousCount);  

                if (currentCount > previousCount) {
                    // Mainkan musik
                     table.ajax.reload();
                    playNotificationSound();
                    
                }


                // Jika jumlah data saat ini sama dengan jumlah data sebelumnya
                if (currentCount == previousCount) {
                    // Hentikan musik
                    table.ajax.reload();
                console.log(previousCount);
                stopMusic();
                 
                }

               previousCount = currentCount;

                // Simpan jumlah data saat ini sebagai jumlah data sebelumnya
               
            }
            
       
          });
             

 
  }

setInterval(fetchData, 5000);

            // Memuat ulang DataTable setiap 5 detik

$('#example tbody').on('click', '.editButton', function(){

      var id = $(this).data('id');
      var status = 'proses';
      console.log(id);
        $.ajax({
            url: '<?php echo site_url("home/kerjakan"); ?>',
            method: 'POST',
            data: { id: id, status: status },
            dataType: 'json',
            success: function(response) {
                // Tindakan setelah pembaruan data berhasil
                if (response.status === 'success') {
                    alert(response.message);
                   table.ajax.reload(); // Memuat ulang tabel setelah pembaruan data berhasil
                } else {
                    alert('Terjadi kesalahan saat memperbarui data');
                }
            },
            error: function() {
                alert('Terjadi kesalahan pada permintaan Ajax');
            }
          });
        
           
});

$('#example tbody').on('click', '.doneButton', function(){

var id = $(this).data('id');
var status = 'selesai';
console.log(id);
  $.ajax({
      url: '<?php echo site_url("home/selesaikan"); ?>',
      method: 'POST',
      data: { id: id, status: status },
      dataType: 'json',
      success: function(response) {
          // Tindakan setelah pembaruan data berhasil
          if (response.status === 'success') {
              alert(response.message);
             table.ajax.reload(); // Memuat ulang tabel setelah pembaruan data berhasil
          } else {
              alert('Terjadi kesalahan saat memperbarui data');
          }
      },
      error: function() {
          alert('Terjadi kesalahan pada permintaan Ajax');
      }
    });
  
     
});

    
});










</script>



          


      <div class="container-fluid">
        
        <!--  Row 1 -->
   
        <div class="row justify-content-end">
  
          <div style="position:absolute; float:right;" class="col-lg-8">
    <div class="card w-100">
      <div class="card-body p-4">
        <h2 class="card-title fw-semibold mb-4">DAFTAR PEKERJAAN HARI INI</h2>
       
        <div class="table-responsive">
<table id="example" class="display" style="width:100%">
<thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0 narrow-column">WAKTU</h6>
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

  
        <div class="row">
        
       

          
        <h2 style="margin-bottom:20px; margin-top:6px;">Shift Hari Ini</h2>
          <div class="col-sm-2 col-md-1">
            
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/abizar.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Abizar</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <small>Operator Outdoor 1</small>
</div>
                </div>
              </div>
              </div>
              <div class="col-sm-2 col-md-1">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/evan.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Evan </h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Operator Outdoor 2</small>
                 
                </div>
              </div>
            </div>
      </div>
          
            <div class="col-sm-2 col-md-1"> 
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/badeng.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Fikri</h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Operator Outdoor 3</small>                 
                </div>
              </div>
            </div>
</div>


      
            <div class="col-sm-2 col-md-1">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <!-- <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 999999;color: white;font-size: 30px;">ABSEN</p> -->
                <a href="javascript:void(0)"><img  src="<?= base_url('foto/fatih.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
                 </div>
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Fatih</h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Packaging</small>                 
                </div>
              </div>
            </div>

            
            
          </div>

     
         

 <div class="row">
          

          <div class="col-sm-2 col-md-1">
            
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/rhino.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Rino</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <small>Operator Seaming 1</small>
</div>
                </div>
              </div>
              </div>
              <div class="col-sm-2 col-md-1">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/arik.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Arik </h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Operator Seaming 2</small>
                 
                </div>
              </div>
            </div>
      </div>
          
            <div class="col-sm-2 col-md-1"> 
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('foto/arifin.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
</div>              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Arifin</h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Driver & Helper</small>                 
                </div>
              </div>
            </div>
</div>

      
            <div class="col-sm-2 col-md-1">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <!-- <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 999999;color: white;font-size: 30px;">ABSEN</p> -->
                <a href="javascript:void(0)"><img  src="<?= base_url('foto/radifan.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
                 </div>
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Radifan</h6>
                <div class="d-flex align-items-center justify-content-between">
                <small>Admin Gudang</small>                 
                </div>
              </div>
            </div>

            
            
          </div>
          <div class="row">


          

            <div class="col-sm-2 col-md-1">
              
              <div class="card overflow-hidden rounded-2">
                <div class="position-relative">
                  <a href="javascript:void(0)"><img src="<?= base_url('foto/warsini.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
  </div>              <div class="card-body pt-3 p-4">
                  <h6 class="fw-semibold fs-4">Warsini</h6>
                  <div class="d-flex align-items-center justify-content-between">
                    <small>Finishing</small>
  </div>
                  </div>
                </div>
                </div>

                <div class="col-sm-2 col-md-1">
              
              <div class="card overflow-hidden rounded-2">
                <div class="position-relative">
                  <a href="javascript:void(0)"><img src="<?= base_url('foto/jalal.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
  </div>              <div class="card-body pt-3 p-4">
                  <h6 class="fw-semibold fs-4">Jalal</h6>
                  <div class="d-flex align-items-center justify-content-between">
                    <small>Finishing</small>
  </div>
                  </div>
                </div>
                </div>

                <div class="col-sm-2 col-md-1">
              <div class="card overflow-hidden rounded-2">
                <div class="position-relative">
                  <a href="javascript:void(0)"><img src="<?= base_url('foto/opiani.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
  </div>              <div class="card-body pt-3 p-4">
                  <h6 class="fw-semibold fs-4">Opiani </h6>
                  <div class="d-flex align-items-center justify-content-between">
                  <small>Finishing</small>
                   
                  </div>
                </div>
              </div>
        </div>
            
          
  
        
              <div class="col-sm-2 col-md-1">
              <div class="card overflow-hidden rounded-2">
                <div class="position-relative">
                  <!-- <p style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 999999;color: white;font-size: 30px;">ABSEN</p> -->
                  <a href="javascript:void(0)"><img  src="<?= base_url('foto/zahra.jpg');?>" class="card-img-top rounded-0" alt="..."></a>
                   </div>
                <div class="card-body pt-3 p-4">
                  <h6 class="fw-semibold fs-4">Zahra</h6>
                  <div class="d-flex align-items-center justify-content-between">
                  <small>Quality Check</small>                 
                  </div>
                </div>
                
              </div>
              <div class="marquee-container">
              

            <p style="color:black;" class="marquee-text"><strong> SEGERA LAPOR PEKERJAAN ANDA JIKA SUDAH SELESAI !!!      SEGERA LAPOR PEKERJAAN ANDA JIKA SUDAH SELESAI !!!   SEGERA LAPOR PEKERJAAN ANDA JIKA SUDAH SELESAI !!!   SEGERA LAPOR PEKERJAAN ANDA JIKA SUDAH SELESAI !!!</strong></p>
            
            <hr class="marquee-line">
          </div>
       
            </div>
   
              
          
     
         
     
            
      
     
     