$(document).ready(function(){
    let users = 'users';
    let departments = 'departments';
    let account = 'account';
    $("#departments").click(function(){
        $("#departments").attr( 'class', 'active btn btn-default' );
        $("#users").attr( 'class', 'btn btn-default' );
        $("#account").attr( 'class', 'btn btn-default' );
        get_me_view(departments);
    });
    $("#users").click(function(){
        $("#departments").attr( 'class', 'btn btn-default' );
        $("#users").attr( 'class', 'active btn btn-default' );
        $("#account").attr( 'class', 'btn btn-default' );
        get_me_view(users);
    });

    $("#account").click(function(){
        $("#departments").attr( 'class', 'btn btn-default' );
        $("#users").attr( 'class', 'btn btn-default' );
        $("#account").attr( 'class', 'active btn btn-default' );
        get_me_view(account);
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
  