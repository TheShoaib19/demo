@extends('layout.master')
@section('content')
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success" id="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('message1'))
            <div class="alert alert-primary" id="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message1') }}
            </div>
        @endif
    </div>
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading">
                    <h1>Users</h1>
                    @if (session()->has('user_add'))
                        {{ session()->get('user_add') }}
                    @endif
                    <div class="topButtons">
                        <a class="btn btn-danger btn-sm mr-3 removeAll" id="visible" hidden="true">Delete</a>
                        <a href="{{ route('newForm') }}" class="btn btn-success btn-sm mr-3">Add New</a>
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
                            <th><input type="checkbox" id="checkboxesMain"></th>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>View</th>
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
          order: [[1 , 'asc']],
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
                    targets: [-1 , 0],
                    orderable: false
                }
            ],
          columns: [
              { data: 'checkbox'},
              { data: 'id' },
              { data: 'first_name' },
              { data: 'last_name' },
              { data: 'email' },
              { data: 'age' },
              { data: 'phone' },
              { data: 'view'}
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
        $(document).on('click', function(){
            var length = $('.checkbox:checked').length; 
            if(length == 0){
                $('#visible').prop('hidden', true);
            }
            else{
                $('#visible').prop('hidden', false);
            }
        });
        function individual(){
            if ($('.checkbox:checked').length == $('.checkbox').length){
                    $('#checkboxesMain').prop('checked', true);
            }else{
                    $('#checkboxesMain').prop('checked', false);
            }
        }
    </script>
    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
                $("div.alert").remove();
            }, 3000);
        });
    </script>
@endsection()