@extends('layouts.admin.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="layanan_add_id" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Rincian Layanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="layanan_form_add" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="id_layanan">Id Layanan</label>
                <select style="width:100%;" class="form-control js-example-basic-single" name="id_layanan">
                    <option class="form-control">----pilihh----</option>
                    @foreach ($layanan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" name="id_layanan" id="id_layanan" class="form-control" placeholder="Id Layanan" required> --}}
            </div>
            <div class="my-2">
              <label for="id_persyaratan">Id Persyaratan</label>
              <select class="form-control js-example-basic-single" style="width:100%;" class="form-control js-example-basic-single" name="id_persyaratan" >
                <option>----pilihh----</option>
                @foreach ($persyaratan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_persyaratan }}</option>
                @endforeach
            </select>
              {{-- <input type="text" name="id_persyaratan" id="id_persyaratan" class="form-control" placeholder="id Layanan" required> --}}
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Rincian Layanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_TU_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">

        <div class="modal-body p-4 bg-light">
            <div class="my-2">
                <label for="id_layanan">Id Layanan</label>
                <select style="width:100%;" class="form-control js-example-basic-single" name="id_layanan" id="id_layanan">
                    {{-- <option disabled></option> --}}
                    @foreach ($layanan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" name="id_layanan" id="id_layanan" class="form-control" placeholder="Id Layanan" required> --}}
            </div>
            <div class="my-2">
              <label for="id_persyaratan">Id Persyaratan</label>
              <select style="width:100%;" class="form-control js-example-basic-single" name="id_persyaratan" id="id_persyaratan">
                {{-- <option disabled></option> --}}
                @foreach ($persyaratan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_persyaratan }}</option>
                @endforeach
            </select>
              {{-- <input type="text" name="id_persyaratan" id="id_persyaratan" class="form-control" placeholder="id Layanan" required> --}}
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
            <h3 class="text-light">Table Rincian Layanan</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#layanan_add_id"><i
                class="bi-plus-circle me-2"></i>Tambah Rincian Persyaratan</button>
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

        $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

      // add new employee ajax request
      $("#layanan_form_add").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#layanan_button").text('Adding...');
        $.ajax({
          url: '{{ route('rincian_layanan-store') }}',
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
          url: '{{ route('rincian_layanan-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#id_layanan").val(response.id_layanan);
            $("#id_persyaratan").val(response.id_persyaratan);
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
          url: '{{ route('rincian_layanan-update') }}',
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
              url: '{{ route('rincian_layanan-delete') }}',
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
          url: '/rincian_layanan/all',
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
