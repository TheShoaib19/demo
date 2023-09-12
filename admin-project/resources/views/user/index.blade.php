@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading">
                    <h1>Users</h1>
                    <div class="topButtons">
                        <a href="{{ route('newForm') }}" class="btn btn-success btn-sm mr-3">Add New</a>
                        <a class="btn btn-danger btn-sm mr-3 removeAll">Delete Selected</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <table id="users" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>View</th>
                            <th><input type="checkbox" id="checkboxesMain"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#users',{
          processing: true,
          serverSide: true,
          responsive: true,
          ajax: {
            url: "{{route('getUsers')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                _token : "{{ csrf_token() }}"
            }
            },
            columnDefs: [
                {
                    targets: [ -1, -2, -3 ],
                    orderable: false
                }
            ],
          columns: [
              { data: 'id' },
              { data: 'first_name' },
              { data: 'last_name' },
              { data: 'email' },
              { data: 'age' },
              { data: 'phone' },
              { data: 'view'},
              { data: 'checkbox'}
      ]
        });
      </script>
      <script type="text/javascript">
        $(document).ready(function() {
            $('#checkboxesMain').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });
            $('.removeAll').on('click', function(e) {
                var userIdArr = [];
                $(".checkbox:checked").each(function() {
                    userIdArr.push($(this).attr('data-id'));
                });
                if (userIdArr.length <= 0) {
                    alert("Choose min one item to remove.");
                } else {
                    if (confirm("Are you sure?")) {
                        var stuId = userIdArr.join(",");
                        $.ajax({
                            url: "{{ url('delete-all') }}",
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + stuId,
                            success: function(data) {
                                if (data['status'] == true) {
                                    $(".checkbox:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['message']);
                                } else {
                                    alert('Error occured.');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });
      </script>
    
@endsection()