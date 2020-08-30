$(document).ready(function(){



/*-----[Function helpers]-----*/
function float2int (value) {
    return value | 0;
}

function minutes2string (Minutes) {
  var hours   = float2int(Minutes / 60);
  var minutes = Minutes - (hours * 60);
  var result ;
  if(hours == 0)
    {
        result = minutes + " min";

    } else if(minutes == 0)
        {
            result = hours + " h";

        } else 
            {
                result = hours + " h , " + minutes + " min";
            } 
    
  return result;
}

function updateProjectCounts() {
    //getting the value from database via blade
    var tasks   = "{{ getAmount($project->id) }}";
    var amount  = "{{ getTasksCount($project->id) }}";
    var hours   = "{{ getHours($project->id) }}";

    document.getElementById('total-tasks').innerHTML  = tasks;
    document.getElementById('total-amount').innerHTML = amount;
    document.getElementById('total-hours').innerHTML  = hours;

    // $('#total-tasks').html(tasks);
    // $('#total-amount').html(amount + " $");
    // $('#total-hours').html(minutes2string(hours));

}

///showMessage///
function showMessage(message, element) {
    var alert = element == undefined ? "#add-new-alert" : element;
    $(alert).text(message).fadeTo(1000, 500).slideUp(1000, function() {
      $(this).hide();
    });
}


  //Show Token Generator Modal's Form
  $('body').on('click', '#generate-token-btn', function(event) {
      event.preventDefault();

      var modalDialog = $("#generate-token-dialog");
      modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 3));

      var me = $(this),
          url = me.attr('href');

      $.ajax({
          url: url,
          dataType: 'html',
          success: function(response) {
              $('#generated-token').html(response);
          }

      });
  });

  // Regenerate Token
  $('body').on('click', '#request-other-token', function(event) {
      event.preventDefault();

      var me  = $(this),
          url = me.attr('href');

      $.ajax({
          url: url,
          dataType: 'html',
          success: function(response) {
            $('#result-generated-token').val(response);
            console.log(response);
          }

      });
  });

  // Add Collaborator Modal's form
  $('body').on('click', '#add-collaborator', function(event) {
      event.preventDefault();
    
      var me  = $(this),
          url = me.attr('href')
          project_id = me.data('title');

      $('#project-id-add-collab').val(project_id);

      $.ajax({
          url: url,
          dataType: 'html',
          success: function(response) {
            $('#add-collaborator-form').html(response);
            
          }  
      });

  });

  //get Collaborator Details
  $('body').on('click', '#get-user-detail-from-token-btn', function(event) {
      event.preventDefault();

      var me  = $(this),
          url = me.attr('href');
      var collab_token  = $('#collab-token').val();
      var project_id    = $('#project-id-add-collab').val(); 

      $.ajax({
          url: url,
          method: 'get',
          data: {
              collab_token: collab_token,
              project_id: project_id,
          },
          success: function(response) {
              $('#show-collaborator-details').html(response);
          }
      });
  });

  //request a collaboration
  
  $('body').on('click', '#request-collab', function(event) {
      event.preventDefault();
 
      var me = $(this),
          url = me.attr('href');


      $.ajax({
          url: url,
          success: function(response) {
                $('#addTask').modal('hide');
                showMessage("The request for the Collaborator has beed sent successfully.", "#update-alert");

          },
      });


  });


  //show Add Task Modal's Form
  $('body').on('click', '#add-task-btn', function(event) {
  	event.preventDefault();

    var modalDialog = $("#addTask-dialog");
        /* Applying the top margin on modal dialog to align it vertically center */
    modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 5));

  	var me = $(this),
  		url = me.attr('href'),
  		project_id = me.data('title');

      project_id_global = project_id;         //i need it for global uses

  	$.ajax({
  		url: url,
  		dataType: 'html',
      data: {
          project_id: project_id,
      },
  		success: function(response) {
            $('#add-task').html(response);
  		}
  	});

  });

  //Store the new Task
  $('body').on('click', '#store-new-task-btn', function(event) {
    event.preventDefault();

    var form = $('#store-task-form'),
        url = form.attr('action'),
        method = 'post';
    $.ajax({
      url: url,
      method: method,
      data: form.serialize(),
      success: function(response) {
                console.log(response);
                updateProjectCounts();
                // $('#total-tasks').text(data.tasks);
                // $('#total-amount').text(data.amounts + " $");
                // $('#total_hours').text(minutes2string(data.duration));
                $('#task-list').prepend(response);
                $('#addTask').modal('hide');
                showMessage("new Task has been added.", "#update-alert");


      },
      error: function(xhr) {
            var errors = xhr.responseJSON;
            if($.isEmptyObject(errors) == false) {
                $.each(errors, function(key, value) {
                   $("#error-message").removeClass('hidden')
                                        .append('<span class="help-block mx-auto text-danger"><strong>' + value + '</strong></span>');
                   return false;
                });
            }
      },
    });

  });

  //Show Edit Task Modal's Form
  $('body').on('click', '#edit-task-btn', function(event) {
    event.preventDefault();

    var modalDialog = $("#editTask-dialog");
        /* Applying the top margin on modal dialog to align it vertically center */
    modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 5));

    var me  = $(this),
        url = me.attr('href');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response) {
            $('#edit-task').html(response);
        }
    });
  });

  //Update Edited Task 
  $('body').on('click', '#task-update-btn', function(event) {
    event.preventDefault();

    var form  = $('#update-task-form'),
        url   = form.attr('action');

    $.ajax({
        url: url,
        method: 'put',
        data: form.serialize(),
        success: function(response) {
              $('#task-list').prepend(response);
              $('#editTask').modal('hide');
              showMessage("Task has been updated.", "#update-alert");
        }
    });

  });


  //Show details Destroy task Modal
  $('body').on('click', '#destroy-task-btn', function(event) {
    event.preventDefault();

    var modalDialog = $("#destroyTask-dialog");
        /* Applying the top margin on modal dialog to align it vertically center */
    modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 3));

    var me      = $(this),
        title   = me.data('title'),
        action  = me.attr('href');

        $('#destroy-task-confirm form').attr('action', action);
        $('#destroy-task-confirm p').html("Are sure to delete the Task created at: <strong>" + title + "</strong>");
  });

  //Confirm Destroy task Modal
  $('#destroy-task-confirmed').click(function(event){
    event.preventDefault();

    var form    = $('#destroy-task-confirm form'),
        action  = form.attr('action');

    $.ajax({
        url: action,
        type: 'DELETE',
        data: {
          _token: $('input[name=_token]').val()
        },
        success: function(response) {
              $('#task-' + response[0].id).fadeOut(function() {
              $(this).remove();
              $('#destroyTask').modal('hide');
              $('#total-tasks').text(response[3]);
              $('#total-amount').text(response[2] + " $");
              $('#total-hours').text(minutes2string(response[1]));
              
              $('#total-tasks-user').text(response[6]);
              $('#total-amount-user').text(response[5] + " $");
              $('#total-hours-user').text(minutes2string(response[4]));


              showMessage("Task has been deleted.", "#update-alert");
          });

        }
    });
  });

});
