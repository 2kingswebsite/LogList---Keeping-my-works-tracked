<!-- Destroy Task Modal-->

<div class="modal fade" id="destroyTask" tabindex="-1" role="dialog" aria-labelledby="destroyTaskModal" aria-hidden="true">
  <div class="modal-dialog" role="document" id="destroyTask-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroyTaskModal">Delete the Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="destroy-task-confirm">
        <form>
            {{ csrf_field() }}
        </form>
        <p></p>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="destroy-task-confirmed">Yes</button>
      </div>
    </div>
  </div>
</div>