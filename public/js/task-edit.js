$(document).ready(function(){
    for(let i = 0; i < 20; i++){
      $("#delete_image"+ i).click(function(){
        if(confirm('Удалить фото?'))
            delete_image($("#delete_image"+ i).attr('name'));
      });
    }
       

    function delete_image(image_id){
        $.ajax({
          url: "/ajax/deleteimage",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          data: {
            id: image_id,
          }
      });
      $('#'+ image_id).fadeOut('slow');
    };
    $('#dropfilebutton').click(function(){
      $('#dropfileinput').html('<input type="file" accept="image/*" name="photos[]" multiple capture="camera">');
    });

    $("#dep_select").change(function(){
      send_dep_id($(this).val(), $("#task_id").attr('name'));
    });
    function send_dep_id(department_id, task_id){
      $.ajax({
          url: "/ajax/fortaskedit",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          data: {
            department_id: department_id,
            task_id: task_id
          },
          success: function (user_foreach_view) { 
            $("#user_select").html(user_foreach_view);
          }
      });
    };
    send_dep_id($("#dep_select").val(), $("#task_id").attr('name'));
});
