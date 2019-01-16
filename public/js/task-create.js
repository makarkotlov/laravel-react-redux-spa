$(document).ready(function(){
    $("#dep_select").change(function(){
      $(this).val() != 0 ? send_dep_id($(this).val()) : $("#user_select").html(''); // if select is null, nullify the other select
    });
    function send_dep_id(department_id){
      $.ajax({
          url: "/ajax",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          data: {
            department: department_id,
          },
          success: function (user_foreach_view) { 
            $("#user_select").html(user_foreach_view);
          }
      });
    };
    $('#dropfilebutton').click(function(){
      $('#dropfileinput').html('<input type="file" accept="image/*" name="photos[]" multiple capture="camera">');
    });
  });