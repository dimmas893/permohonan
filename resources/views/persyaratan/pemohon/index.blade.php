@extends('layouts.admin.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="layanan_add_id" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pemohon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="layanan_form_add" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="nik">NIK</label>
                <input type="text" name="nik" class="form-control" placeholder="Masukan NIK" required>
            </div>
            <div class="my-2">
              <label for="no_kk">No KK</label>
              <input type="text" name="no_kk" class="form-control" placeholder="Masukan No KK" required>
          </div>
          <div class="my-2">
            <label for="nama_pemohon">Nama Pemohon</label>
            <input type="text" name="nama_pemohon" class="form-control" placeholder="Masukan Nama Pemohon" required>
        </div>
        <div class="my-2">
            <label for="alamat">Alamat</label>
            <textarea type="text" name="alamat"class="form-control" placeholder="Masukan Alamat" required></textarea>
        </div>
        <div class="my-2">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required>
        </div>
        <div class="my-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="layanan_button" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editTUModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemohon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">

        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" required>
            </div>
            <div class="my-2">
              <label for="no_kk">No KK</label>
              <input type="text" name="no_kk" id="no_kk" class="form-control" placeholder="Masukan No KK" required>
          </div>
          <div class="my-2">
            <label for="nama_pemohon">Nama Pemohon</label>
            <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" placeholder="Masukan Nama Pemohon" required>
        </div>
        <div class="my-2">
            <label for="alamat">Alamat</label>
            <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
        </div>
        <div class="my-2">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan No HP" required>
        </div>
        <div class="my-2">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email" required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_TU_btn" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Table Pemohon</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#layanan_add_id"><i
                class="bi-plus-circle me-2"></i>Tambah Pemohon</button>
          </div>
          <div class="card-body" id="perysaratan_data">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
      <script>
    $(function() {

      // add new employee ajax request
      $("#layanan_form_add").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#layanan_button").text('Adding...');
        $.ajax({
          url: '{{ route('pemohon-store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Pemohon Added Successfully!',
                'success'
              )
              perysaratan_data();
            }
            $("#layanan_button").text('Save');
            $("#layanan_form_add")[0].reset();
            $("#layanan_add_id").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('pemohon-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#nik").val(response.nik);
            $("#no_kk").val(response.no_kk);
            $("#nama_pemohon").val(response.nama_pemohon);
            $("#alamat").val(response.alamat);
            $("#no_hp").val(response.no_hp);
            $("#email").val(response.email);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update employee ajax request
      $("#edit_TU_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_TU_btn").text('Updating...');
        $.ajax({
          url: '{{ route('pemohon-update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Pemohon Updated Successfully!',
                'success'
              )
              perysaratan_data();
            }
            $("#edit_TU_btn").text('Update');
            $("#edit_TU_form")[0].reset();
            $("#editTUModal").modal('hide');
          }
        });
      });

      // delete employee ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('pemohon-delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                perysaratan_data();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      perysaratan_data();

      function perysaratan_data() {
        $.ajax({
          url: '/pemohon/all',
          method: 'get',
          success: function(response) {
            $("#perysaratan_data").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection
