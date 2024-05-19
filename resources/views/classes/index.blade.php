@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Classes</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="{{ route('classesStore') }}"> @csrf
                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
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
                            <button type="submit" class="btn btn-danger" data-id="{{ $item->id }}">Delete</button>
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
    
</script>
@endsection
