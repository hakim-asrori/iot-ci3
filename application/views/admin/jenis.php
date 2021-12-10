<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Jenis</h1>
  </div>
  <div class="row">
    <div class="col-lg-4 mb-3">
      <div class="card">
        <div class="card-body" id="tambah">
          <div class="form-group">
            <label for="tambahJenis">Tambah Jenis</label>
            <input type="text" id="tambahJenis" class="form-control">
          </div>
          <div class="form-group">
            <button id="addJenis" class="btn btn-primary">Tambah</button>
          </div>
        </div>
        <div class="card-body d-none" id="edit">
          <div class="form-group">
            <label for="editJenis">Edit Jenis</label>
            <input type="text" id="editJenis" class="form-control">
            <input type="hidden" id="editId" class="form-control">
          </div>
          <div class="form-group">
            <button id="updateJenis" class="btn btn-primary">Simpan</button>
            <button onclick="batal()" class="btn btn-danger">Batal</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
          <thead>
            <tr>
              <th>Jenis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
  loadJenis();

  function loadJenis() {
    let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
    empTable.innerHTML = "";

    $.ajax({
      url: "/ajax",
      type: "get",
      success: function (data) {
        let response = JSON.parse(data);
        for (let key in response) {
          if (response.hasOwnProperty(key)) {
            let val = response[key];
            
            let newRow = empTable.insertRow(0); 
            let JenisCell = newRow.insertCell(0);
            let aksiCell = newRow.insertCell(1);

            JenisCell.innerHTML = val['jenis'];
            aksiCell.innerHTML = '<button class="btn btn-danger mr-2" onclick="hapus('+val['id']+')">Hapus</button>';
            aksiCell.innerHTML += '<button class="btn text-white btn-warning" data-id="'+val['id']+'" data-value="'+val['Jenis']+'" id="editBtn">Edit</button>';
          }
        }
      }
    });
  }

  function hapus(id) {
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
          url: "/ajax/jenis.php?act=hapus",
          type: "post",
          data: {id: id},
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
                  loadJenis();
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

  function batal() {
    $("#tambah").removeClass('d-none');
    $("#edit").addClass('d-none');
  }

  $(document).ready(function () {
    $('#addJenis').click(function () {
      let jenis = $('#tambahJenis').val().trim();

      if (jenis == "") {
        Swal.fire('Ooops!', 'Form jenis harap diisi!', 'error');
      } else {
        $.ajax({
          url: "/ajax/jenis.php?act=post",
          type: "post",
          data: {jenis: jenis},
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
                  loadJenis();
                  $('#tambahJenis').val('');
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
      $("#edit").removeClass('d-none');
      $("#tambah").addClass('d-none');

      let idValue = $(this).data('id');
      let JenisValue = $(this).data('value');

      $("#editId").val(idValue);
      $("#editJenis").val(JenisValue);
    })

    $("#updateJenis").click(function () {
      let id = $('#editId').val().trim();
      let Jenis = $('#editJenis').val().trim();

      if (Jenis == "" && id == "") {
        Swal.fire('Ooops!', 'Form harap diisi!', 'error');
      } else if (Jenis == "") {
        Swal.fire('Ooops!', 'Form jenis harap diisi!', 'error');
      } else if (id == "") {
        Swal.fire('Ooops!', 'Form id harap diisi!', 'error');
      } else {
        $.ajax({
          url: "/ajax/jenis.php?act=update",
          type: "post",
          data: {id: id, jenis: Jenis},
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
                  loadJenis();
                  $("#tambah").removeClass('d-none');
                  $("#edit").addClass('d-none');
                  Swal.fire('Wooww', 'Data anda berhasil disimpan!', 'success');
                } else {
                  Swal.fire('Ooops!', 'Data anda gagal disimpan!', 'error');
                }
              }
            })
          }
        });
      }
    })
  })
</script>
