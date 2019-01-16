$(document).ready(function(){
    $("#dep_select").change(function(){
        $(this).val() != 0 ? send_dep_id($(this).val()) : $("#users").trigger("click");
      });
      function send_dep_id(department_id){
        $.ajax({
            url: "/ajax/getusers",
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: {
              department: department_id
            },
            success: function (admin_user_foreach_view) {
              $("#users_ul").html(admin_user_foreach_view);
            }
        });
      };
      function get_me_view(view_name){
          $.ajax({
            url: "/ajax/getview",
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: {
              name: view_name,
              id: $("#user_edit").attr('name')
            },
            success: function (view) {
              $("#big-container").html(view);
            }
        });
      };
});