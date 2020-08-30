<form>
	<div class="form-group">
	    <label for="">Paste The Collaborator's Token</label>
	    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" 
	    title="ask your new guest to send you 
	    his/her own generated Token
	    form 'Allow Others to add me'"></i>

		<div class="input-group mb-3">
		  <input type="text" class="form-control" placeholder="paste the Token Here" id="collab-token">

		  <div class="input-group-append">
		    <button class="input-group-text" href="{{ route('project.getdetails.Collab') }}" id="get-user-detail-from-token-btn">Get Details</button>
		  </div>
		</div>
	</div>
</form>

