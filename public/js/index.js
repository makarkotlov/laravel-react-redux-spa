$(document).ready(function(){
    let donebutton = document.getElementById('donebutton');
    let allbutton = document.getElementById('allbutton');
    let urgentbutton = document.getElementById('urgentbutton');
    let todaybutton = document.getElementById('todaybutton');
    get_me_view('alltasks');
    donebutton.addEventListener('click', function () {
        urgentbutton.setAttribute( 'class', 'btn btn-default' );
        todaybutton.setAttribute( 'class', 'btn btn-default' );
        allbutton.setAttribute( 'class', 'btn btn-default' );
        donebutton.setAttribute( 'class', 'active btn btn-default' );
        get_me_view('donetasks');

    });
    allbutton.addEventListener('click', function () {
        urgentbutton.setAttribute( 'class', 'btn btn-default' );
        todaybutton.setAttribute( 'class', 'btn btn-default' );
        allbutton.setAttribute( 'class', 'active btn btn-default' );
        donebutton.setAttribute( 'class', 'btn btn-default' );
        get_me_view('alltasks');
    });
    urgentbutton.addEventListener('click', function () {
        urgentbutton.setAttribute( 'class', 'active btn btn-default' );
        todaybutton.setAttribute( 'class', 'btn btn-default' );
        allbutton.setAttribute( 'class', 'btn btn-default' );
        donebutton.setAttribute( 'class', 'btn btn-default' );
        get_me_view('urgenttasks');
    });
    todaybutton.addEventListener('click', function () {
        urgentbutton.setAttribute( 'class', 'btn btn-default' );
        todaybutton.setAttribute( 'class', 'active btn btn-default' );
        allbutton.setAttribute( 'class', 'btn btn-default' );
        donebutton.setAttribute( 'class', 'btn btn-default' );
        get_me_view('todaytasks');
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
            $("#droptasks").html(view);
          }
      });
    };
    
    setTimeout(function(){
    $("div.alert").fadeOut('slow');
    }, 2000 );

  });