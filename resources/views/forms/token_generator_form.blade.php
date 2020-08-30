

<form>
  <div class="row mx-0" style="justify-content:space-between;">
      <label class="col-form-label">Your Token</label>
      <a      href="{{ route('project.collabOther')}}" 
              class="btn btn-primary mb-2" 
              id="request-other-token">
              Try Other One
      </a>
  </div>
  <div class="form-group row">
    <div class="col-12 px-0">
      <input type="text" readonly class="form-control" id="result-generated-token" value="{{ $token }}">
    </div>
    <div class="col-12"><a href="#" id="copy-token" class="horizontal-word-line">&nbsp; Copy The Token &nbsp;</a></div>
  </div>
    
</form>

<script>

    $('#copy-token').click(function(e) {
        e.preventDefault();

        var token = document.getElementById("result-generated-token");

        token.select();
        token.setSelectionRange(0, 999999);

        document.execCommand("copy");

    });



</script>

