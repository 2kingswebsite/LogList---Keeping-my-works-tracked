<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="col-6 mx-auto mb-2">
         <img src="https://via.placeholder.com/150" />
      </div>
      <div class="col-12">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
          </div>
          <input type="text" class="form-control" aria-label="Small" value="{{ $user->name }}" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
          </div>
          <input type="text" class="form-control" aria-label="Small" value="{{ $user->email }}" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Total Projects</span>
          </div>
          <input type="text" class="form-control" aria-label="Small" value="{{ $user->projects()->count() }}" readonly>
        </div>
      </div>
   </div>
  </div>
  <div class="row" style="justify-content: flex-end;">
     <button  class="input-group-text" 
              href="{{ route('project.request.Collab',['id' => $user->id, 'project_id' => $project_id]) }}" 
              id="request-collab"
              >
              Request a Collab
      </button>

  </div>
</div>