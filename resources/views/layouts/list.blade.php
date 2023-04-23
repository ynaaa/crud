@extends('layouts.app')
@section('contents')
<div class="">
  <div class="">
    <div class="col-md-12 text-center">
      <h2 class="text-info mt-5">Users</h2>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="d-flex justify-content-center">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <div class="text-right">
        <div class="mb-5">
          <button type="button" class="btn btn-primary btn-insert" id="btn-insert">
          <i class="fa-solid fa-pencil mr-2"></i>
            Insert Data
          </button>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-striped" id="usertbl">
          <thead>
            <tr>
              <th scope="col" class="text-center">ID</th>
              <th scope="col" class="text-center">Name</th>
              <th scope="col" class="text-center">Email</th>
              <th scope="col" class="text-center">Telephone</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($user_info->isEmpty())
            <tr>
              <td><i>Empty Table</i></td>
            </tr>
            @else
            @foreach($user_info as $user_info)
            <tr>
              <th scope="row" class="text-center">{{$user_info->id}}</th>
              <td class="text-center">{{$user_info->name}}</td>
              <td class="text-center">{{$user_info->email}}</td>
              <td class="text-center">{{$user_info->telephone}}</td>
              <td class="text-center">
                <button id="{{$user_info->id}}" name="btn-edit" id="b-edit" class="btn btn-warning btn-edit" value="{{$user_info->id}}"><i class="fa-solid fa-pencil mr-2"></i>edit</button>
                <button id="{{$user_info->id}}" class="btn btn-danger btn-delete" name="btn-delete" value="{{$user_info->id}}"><i class="fa-solid fa-trash mr-2"></i>delete</button>
              </td>
            </tr>
            @endforeach
            @endif
            <!-- asdasd -->
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Insert -->
<form method="POST" action="{{ route('insert-info') }}">
  @csrf
  <div id="modal_insert" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white">Data Entry</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          @if($errors->error1->has('name'))
            <span class="red">{{ $errors->error1->first('name') }}
          @endif
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
          </div>
          @if($errors->error1->has('email'))
            <span class="red">{{ $errors->error1->first('email') }}
          @endif
          <div class="mb-3">
            <label for="email">Telephone</label>
            <input type="text" name="telephone" id="telephone" class="form-control">
          </div>
          @if($errors->error1->has('telephone'))
            <span class="red">{{ $errors->error1->first('telephone') }}
          @endif
        </div>
        <div class="modal-footer">
          <button type="submit" name="b-insert" id="b-insert" class="btn btn-info">Submit</button>
          <button type="button" class="btn btn-secondary btn-close-insert" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- edit route -->
<form method="POST" action="{{ route('edit-info') }}">
  @csrf
  <div id="modal_edit" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white">Edit Info</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_name">Name</label>
            <input type="text" name="edit_name" id="edit_name" class="form-control">
          </div>
          @if($errors->error2->has('edit_name'))
            <span class="red">{{ $errors->error2->first('edit_name') }}
          @endif
          <div class="mb-3">
            <label for="edit_email">Email</label>
            <input type="text" name="edit_email" id="edit_email" class="form-control">
          </div>
          @if($errors->error2->has('edit_email'))
            <span class="red">{{ $errors->error2->first('edit_email') }}
          @endif
          <div class="mb-3">
            <label for="edit_telephone">Telephone</label>
            <input type="text" name="edit_telephone" id="edit_telephone" class="form-control">
          </div>
          @if($errors->error2->has('edit_telephone'))
            <span class="red">{{ $errors->error2->first('edit_telephone') }}
          @endif
          <input type="hidden" name="hiddenid" id="hiddenid">
        </div>
        <div class="modal-footer">
          <button type="submit" name="b-edit" id="b-edit" class="btn btn-info">Submit</button>
          <button type="button" class="btn btn-secondary btn-close-edit" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- delete route -->
<form method="POST" action="{{ route('delete-info') }}">
  @csrf
  <div id="modal_delete" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white">Delete Info</h5>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this user?</p>
          <input type="hidden" name="d_delete" id="d_delete">
        </div>
        <div class="modal-footer">
          <button type="submit" name="b-delete" class="btn btn-info">Delete</button>
          <button type="button" class="btn btn-secondary btn-close-delete">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  let table = new DataTable('#usertbl');
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#usertbl tbody').on('click', '.btn-edit', function () {
      $('#hiddenid').val($(this).val());
      $.ajax({
        "url": "{{ route('get-Info') }}",
        "type": "post",
        data: {
          "_token": "{{ csrf_token() }}",
          "id": $(this).val()
        },
        success: function(res) {
          $('#modal_edit').show();
          $('#edit_name').val(res.name);
          $('#edit_telephone').val(res.telephone);
          $('#edit_email').val(res.email); 
        }
      });
    });
  });

  let btn_close_edit = document.querySelector('.btn-close-edit');
  btn_close_edit.addEventListener('click', () => {
    $('#modal_edit').hide();
  })
</script>

<!-- script insert -->
<script type="text/javascript">
  const btn_insert = document.querySelector('.btn-insert');
  btn_insert.addEventListener('click', () => {
    $('#modal_insert').show();
  })

  let btn_close_insert = document.querySelector('.btn-close-insert');
  btn_close_insert.addEventListener('click', () => {
    $('.modal').hide();
  })
</script>

<!-- script delete -->
<script type="text/javascript">
  $(document).ready(function () {
    $('#usertbl tbody').on('click', '.btn-delete', function () {
      $('#modal_delete').show();
      $('#d_delete').val($(this).val())
    });
  });

  let btn_close_delete = document.querySelector('.btn-close-delete');
  btn_close_delete.addEventListener('click', () => {
    $('.modal').hide();
  })
</script>
@endsection
