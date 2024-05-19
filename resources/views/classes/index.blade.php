@extends('layouts.app')

@section('content')
<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('classesUpdate') }}" method="post"> @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="col-12">
                    <input type="text" class="form-control d-none" id="class_id" name="id">
                    <label for="inputEmail4" class="form-label">Class Name</label>
                    <input id="new_classname" type="text" class="form-control" name="class_name" required autocomplete="class_name" autofocus>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputEmail4" class="form-label">Year Level</label>
                    <select name="year_level" id="year_level" class="form-control">
                        @foreach (config(('const.year_level')) as $item)
                            <option value="{{ ($loop->iteration) - 1 }}">{{ ucfirst(config('const.year_level.'.($loop->iteration) - 1)) }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Classes</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('classesStore') }}" id="class_create_form"> @csrf
                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger mb-3">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Class Name</label>
                  <input id="class_name" type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus>
                    @error('class_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="inputEmail4" class="form-label">Year Level</label>
                    <select name="year_level" id="year_level" class="form-control">
                        @foreach (config(('const.year_level')) as $item)
                            <option value="{{ ($loop->iteration) - 1 }}">{{ ucfirst(config('const.year_level.'.($loop->iteration) - 1)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-left">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Table with hoverable rows</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Class Name</th>
                <th scope="col">Year Level</th>
                <th scope="col">Date Added</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($classes as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->class_name }}</td>
                        <td>{{ config('const.year_level.'. $item->year_level) }}</td>
                        <td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
                        <td>
                            <button type="button" id="edit_class" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="{{ $item->id }}" data-class_name="{{ $item->class_name }}">Edit</button>
                            <button type="button" id="delete_class" class="btn btn-danger" data-id="{{ $item->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
             
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>
</div>
<script>
    $(document).on('click', '#delete_class', function() {
        var id = $(this).data('id');
        $.ajax({
            url: `{{ route('classesDestroy') }}`,
            data : { id : id },
            method: 'POST',
            success: function(response) {
                if(response.status == 200) {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '#edit_class', function() {
        var id = $(this).data('id');
        var class_name = $(this).data('class_name');
        $('#class_id').val(id);
        $('#new_classname').val(class_name);
    });
</script>
@endsection
