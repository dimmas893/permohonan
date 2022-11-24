@extends('layouts.admin.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_persyaratan_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Persyaratan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="persyaratan_form_add" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="emp_image" id="emp_image"> --}}
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
              <label for="nama_persyaratan">Nama Persyaratan</label>
              <input type="text" name="nama_persyaratan" class="form-control" placeholder="Nama Persyaratan" required>
          </div>
          {{-- <div class="my-2">
            <label for="entry_data">Entry Data</label>
            <input type="text" name="entry_data" class="form-control" placeholder="Entry Data">
        </div>
        <div class="my-2">
          <label for="upload_data">Upload Data</label>
          <input type="file" name="upload_data" class="form-control" placeholder="upload Data">
      </div> --}}
      <div class="my-2">
        <label for="status">Status</label>
        <input type="text" name="status" class="form-control" placeholder="Status">
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="persyaratan_button" class="btn btn-primary">Save</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Persyaratan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="emp_image" id="emp_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="nama_persyaratan">Nama Persyaratan</label>
                <input type="text" name="nama_persyaratan" id="nama_persyaratan" class="form-control" placeholder="Nama Persyaratan" required>
            </div>
            <div class="my-2">
              <label for="entry_data">Entry Data</label>
              <input type="text" name="entry_data"  id="entry_data"class="form-control" placeholder="Entry Data">
          </div>
          <div class="my-2">
            <label for="upload_data">Upload Data</label>
            <input type="file" name="upload_data" id="upload_data" class="form-control" placeholder="upload Data">
            <div class="mt-2" id="image"></div>
            </div>
                <div class="my-2">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" class="form-control" placeholder="Status">
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
            <h3 class="text-light">Table Persyaratan</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_persyaratan_modal"><i
                class="bi-plus-circle me-2"></i>Tambah persyaratan</button>
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
      $("#persyaratan_form_add").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#persyaratan_button").text('Adding...');
        $.ajax({
          url: '{{ route('persyaratan-store') }}',
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
                'Persyaratan Added Successfully!',
                'success'
              )
              perysaratan_data();
            }
            $("#persyaratan_button").text('Save');
            $("#persyaratan_form_add")[0].reset();
            $("#add_persyaratan_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('persyaratan-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#nama_persyaratan").val(response.nama_persyaratan);
            $("#entry_data").val(response.entry_data);
            $("#status").val(response.status);
            $("#image").html(
                `<img src="/storage/images/${response.upload_data}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_image").val(response.upload_data);
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
          url: '{{ route('persyaratan-update') }}',
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
                'Persyaratan Updated Successfully!',
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
              url: '{{ route('persyaratan-delete') }}',
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
          url: '/persyaratan/all',
          method: 'get',
          success: function(response) {
            $("#perysaratan_data").html(response);
            $("table").DataTable({
            });
          }
        });
      }
    });
  </script>
@endsection
