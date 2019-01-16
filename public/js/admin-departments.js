$(document).ready(function(){
    $("#new-department").click(function(){
        get_me_view('new_department');
    });

    function get_me_view(view_name){
            $.ajax({
              url: "/ajax/getview",
              type: 'POST',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
              data: {
                name: view_name,
              },
              success: function (view) {
                $("#big-container").html(view);
              }
          });
        };
});