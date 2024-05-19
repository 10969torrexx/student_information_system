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
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Students</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ date('M, d, Y', strtotime($item->created_at)) }}</td>
                        <td>
                           <select name="class" id="assign_class" class="form-control" data-student_id="{{ $item->id }}">
                                @if ($item->classess_id == null)
                                    <option value="">No Assigned Class</option>
                                    @if (!empty($classes))
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Class Added</option>
                                    @endif
                                @else
                                    @foreach ($classes as $class)
                                        @if ($class->id == $item->classess_id)
                                            <option value="{{ $class->id }}" selected>{{ $class->class_name }}</option>
                                        @else
                                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                           </select>
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

    $(document).on('change', '#assign_class', function() {
        var class_id = $(this).val();
        var student_id = $(this).data('student_id');

        console.log(class_id, student_id);
        $.ajax({
            url: `{{ route('studentsClass') }}`,
            data : { 
                id : student_id, 
                class_id : class_id 
            },
            method: 'POST',
            success: function(response) {
                console.log(response);
                if(response.status == 200) {
                    location.reload();
                }
            }
        });
    });
</script>
@endsection
