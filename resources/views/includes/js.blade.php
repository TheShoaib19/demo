<!-- CDN of JQuery -->
<script src="{{ asset('assets/plugins/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/responsive.bootstrap4.min.js') }}"></script>
<script>
  new DataTable('#users',{
    responsive: true
  });
</script>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('assets/dist/js/demo.js') }}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
      $('#checkboxesMain').on('click', function(e) {
          if ($(this).is(':checked', true)) {
              $(".checkbox").prop('checked', true);
          } else {
              $(".checkbox").prop('checked', false);
          }
      });
      $('.checkbox').on('click', function() {
          if ($('.checkbox:checked').length == $('.checkbox').length) {
              $('#checkboxesMain').prop('checked', true);
          } else {
              $('#checkboxesMain').prop('checked', false);
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