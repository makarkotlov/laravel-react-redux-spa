$(document).ready(function(){
    $("#departments").click(function(){
        $("#departments").attr( 'class', 'active btn btn-default' );
        $("#users").attr( 'class', 'btn btn-default' );
        $("#account").attr( 'class', 'btn btn-default' );
        get_me_view('departments');
    });
    $("#users").click(function(){
        $("#departments").attr( 'class', 'btn btn-default' );
        $("#users").attr( 'class', 'active btn btn-default' );
        $("#account").attr( 'class', 'btn btn-default' );
        get_me_view('users');
    });

    $("#account").click(function(){
        $("#departments").attr( 'class', 'btn btn-default' );
        $("#users").attr( 'class', 'btn btn-default' );
        $("#account").attr( 'class', 'active btn btn-default' );
        get_me_view('account');
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
    $("#users").trigger("click"); // to load the view by default when the page is ready
  
    setTimeout(function(){
    $("div.alert").fadeOut('fast');
     }, 3000 ); // 5 secs
  
  });