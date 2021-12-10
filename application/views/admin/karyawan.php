<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Karyawan</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKaryawanModal">
      Tambah Karyawan
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable">
      <thead>
        <tr>
          <th>No Unik</th>
          <th>Nama Lengkap</th>
          <th>Jenis Kendaraan</th>
          <th>Telepon</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</main>

<div class="modal fade" id="addKaryawanModal" tabindex="-1" aria-labelledby="addKaryawanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addKaryawanModalLabel">Tambah Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="tambahUnik">No Unik</label>
          <input type="text" class="form-control" id="tambahUnik">
        </div>
        <div class="form-group">
          <label for="tambahNama">Nama Lengkap</label>
          <input type="text" class="form-control" id="tambahNama">
        </div>
        <div class="form-group">
          <label for="tambahTelepon">Telepon</label>
          <input type="text" class="form-control" id="tambahTelepon">
        </div>
        <div class="form-group">
          <label for="tambahJenis">Jenis Kendaraan</label>
          <select id="tambahJenis" class="form-control"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="tambahKaryawan">Tambah</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editKaryawanModal" tabindex="-1" aria-labelledby="editKaryawanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKaryawanModalLabel">Tambah Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="editUnik">No Unik</label>
          <input type="text" class="form-control" id="editUnik" readonly>
        </div>
        <div class="form-group">
          <label for="editNama">Nama Lengkap</label>
          <input type="text" class="form-control" id="editNama">
        </div>
        <div class="form-group">
          <label for="editTelepon">Telepon</label>
          <input type="text" class="form-control" id="editTelepon">
        </div>
        <div class="form-group">
          <label for="editJenis">Jenis Kendaraan</label>
          <select id="editJenis" class="form-control"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="editKaryawan">Edit</button>
      </div>
    </div>
  </div>
</div>

<script>
  loadJenis();
  loadKaryawan();

  function loadKaryawan() {
    let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
    empTable.innerHTML = "";

    $.ajax({
      url: "/ajax/karyawan.php",
      type: "get",
      success: function (data) {
        let response = JSON.parse(data);
        for (let key in response) {
          if (response.hasOwnProperty(key)) {
            let val = response[key];
            
            let newRow = empTable.insertRow(0); 
            let unikCell = newRow.insertCell(0);
            let namaCell = newRow.insertCell(1);
            let jenisCell = newRow.insertCell(2);
            let teleponCell = newRow.insertCell(3);
            let aksiCell = newRow.insertCell(4);

            unikCell.innerHTML = val['unik'];
            namaCell.innerHTML = val['nama'];
            jenisCell.innerHTML = val['jenis'];
            teleponCell.innerHTML = val['telepon'];
            aksiCell.innerHTML = '<button class="btn btn-danger mr-2" onclick="hapus('+val['unik']+')">Hapus</button>';
            aksiCell.innerHTML += '<button class="btn text-white btn-warning" data-unik="'+val['unik']+'" data-nama="'+val['nama']+'" data-telepon="'+val['telepon']+'" data-jenis="'+val['id_jenis']+'" id="editBtn" data-toggle="modal" data-target="#editKaryawanModal">Edit</button>';
          }
        }
      }
    });
  }

  function loadJenis() {
    $.ajax({
      url: "/ajax/jenis.php?act=select",
      type: "get",
      success: function (data) {
        $("#tambahJenis").html(data);
      }
    });
  }

  function hapus(unik) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data anda akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/ajax/karyawan.php?act=hapus",
          type: "post",
          data: {unik: unik},
          success: function (response) {
            Swal.fire({
              title: 'Harap tunggu!',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              },
              willClose: () => {
                if (response == 1) {
                  loadKaryawan();
                  Swal.fire('Wooww', 'Data anda berhasil dihapus!', 'success');
                } else {
                  Swal.fire('Ooops!', 'Data anda gagal dihapus!', 'error');
                }
              }
            })
          }
        });
      }
    })
  }

  $(document).ready(function () {
    $("#tambahKaryawan").click(function () {
      let unik = $("#tambahUnik").val().trim();
      let nama = $("#tambahNama").val().trim();
      let jenis = $("#tambahJenis").val().trim();
      let telepon = $("#tambahTelepon").val().trim();

      if (unik == "" && nama == "" && jenis == "" && telepon == "") {
        Swal.fire('Ooops!', 'Form tidak boleh kosong!', 'error');
      } else if (unik == "") {
        Swal.fire('Ooops!', 'Form no unik tidak boleh kosong!', 'error');
      } else if (nama == "") {
        Swal.fire('Ooops!', 'Form nama tidak boleh kosong!', 'error');
      } else if (telepon == "") {
        Swal.fire('Ooops!', 'Form telepon tidak boleh kosong!', 'error');
      } else {
        $.ajax({
          url: "/ajax/karyawan.php?act=post",
          type: "post",
          data: {unik:unik, jenis: jenis, nama: nama, telepon: telepon},
          success: function (response) {
            Swal.fire({
              title: 'Harap tunggu!',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              },
              willClose: () => {
                if (response == 1) {
                  loadKaryawan();
                  $("#tambahUnik").val("");
                  $("#tambahNama").val("");
                  $("#tambahJenis").val("");
                  $("#tambahTelepon").val("");
                  $("#addKaryawanModal").modal("hide")
                  Swal.fire('Wooww', 'Data anda berhasil ditambah!', 'success');
                } else {
                  Swal.fire('Ooops!', 'Data anda gagal ditambah!', 'error');
                }
              }
            })
          }
        });
      }
    });

    $("body").on('click', '#editBtn', function () {
      let unik = $(this).data("unik");
      let nama = $(this).data("nama");
      let telepon = $(this).data("telepon");
      let jenis = $(this).data("jenis");
      
      $("#editUnik").val(unik)
      $("#editNama").val(nama)
      $("#editTelepon").val(telepon)
      $.ajax({
        url: "./ajax/jenis.php?act=select-by-id&jenis="+jenis,
        type: "get",
        success: function (data) {
          $("#editJenis").html(data);
        }
      });
    })

    $("#editKaryawan").click(function () {
      let unik = $("#editUnik").val().trim()
      let nama = $("#editNama").val().trim()
      let telepon = $("#editTelepon").val().trim()
      let jenis = $("#editJenis").val().trim()

      if (unik == "" && nama == "" && jenis == "" && telepon == "") {
        Swal.fire('Ooops!', 'Form tidak boleh kosong!', 'error');
      } else if (unik == "") {
        Swal.fire('Ooops!', 'Form no unik tidak boleh kosong!', 'error');
      } else if (nama == "") {
        Swal.fire('Ooops!', 'Form nama tidak boleh kosong!', 'error');
      } else if (telepon == "") {
        Swal.fire('Ooops!', 'Form telepon tidak boleh kosong!', 'error');
      } else {
        $.ajax({
          url: "./ajax/karyawan.php?act=update",
          type: "post",
          data: {unik:unik, jenis: jenis, nama: nama, telepon: telepon},
          success: function (response) {
            Swal.fire({
              title: 'Harap tunggu!',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              },
              willClose: () => {
                if (response == 1) {
                  loadKaryawan();
                  $("#editUnik").val("");
                  $("#editNama").val("");
                  $("#editJenis").val("");
                  $("#editTelepon").val("");
                  $("#editKaryawanModal").modal("hide")
                  Swal.fire('Wooww', 'Data anda berhasil diubah!', 'success');
                } else {
                  Swal.fire('Ooops!', 'Data anda gagal diubah!', 'error');
                }
              }
            })
          }
        });
      }
    })
  })
</script>
