<style>

</style>
<?php 
    // get Price level Details of the Project
    $levels = \App\Project::find($project_id)->level_details;
    $levels_decoded = json_decode($levels);

    $very_easy  = $levels_decoded->{"Very Easy"};
    $easy       = $levels_decoded->{"Easy"};
    $medium     = $levels_decoded->{"Medium"};
    $hard       = $levels_decoded->{"Hard"};
    $very_hard  = $levels_decoded->{"Very Hard"};


 ?>
<form action="{{ route('task.store') }}" id="store-task-form">
    @csrf

    <input type="hidden" name="project_id" value="{{ $project_id }}">
    <div class="form-group row">
        <label for="dateInput" class="col-sm-2 col-form-label">Date</label>
        <div class="col-sm-10">
            <input  type="date" 
                    class="form-control" 
                    name="date" 
                    id="dateInput" 
                    <?php echo " value='".date('m/d/y')."'";?>
                    >
        </div>
    </div>
    <div class="form-group row">
        <label for="authorInput" class="col-sm-2 col-form-label">Author</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="authorInput" placeholder="{{ Auth()->user()->name}}" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label for="timeInput" class="col-sm-2 col-form-label">Time</label>
        <div class="col-sm-10">
            <div class="row">
                <label for="timeStart" class="col-sm-2 col-form-label">Start</label>
                <div class="col-sm-10">
                    <input  type="time" class="form-control" name="timeStart" id="timeStart" name="timeStart">
                </div>
            </div>
            <div class="row">
                <label for="timeEnd" class="col-sm-2 col-form-label">End</label>
                <div class="col-sm-10">
                    <input  type="time" class="form-control" name="timeEnd" id="timeEnd" name="timeEnd">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="levelInput" class="col-sm-2 col-form-label">level</label>
        <div class="col-sm-10">
            <select class="form-control" id="levelInput" name="level">
              <option>Very Easy</option>
              <option>Easy</option>
              <option>Medium</option>
              <option>Hard</option>
              <option>Very Hard</option>
            </select>
            <div>
                
            </div>

            <div class="input-group my-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="min_text">Min: {{ $very_easy[0] }} $</span>
              </div>
              <input type="number" min="{{ $very_easy[0] }}" max="{{ $very_easy[1] }}" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" value="{{ $very_easy[0] }}" id="amount_level">
              <div class="input-group-append">
                <span class="input-group-text" id="max_text">{{ $very_easy[1] }} $:Max</span>
              </div>
            </div>

        </div>
    </div>
    <script>
        
        $('select').on('change', function() {
            var level = $('select option:selected').val();  
            var min,max;
            switch(level) {
                case 'Very Easy': min = <?php echo $very_easy[0] ?>; max = <?php echo $very_easy[1] ?>;break;
                case 'Easy':        min = <?php echo $easy[0] ?>; max = <?php echo $easy[1] ?>;break;
                case 'Medium':      min = <?php echo $medium[0] ?>; max = <?php echo $medium[1] ?>;break;
                case 'Hard':        min = <?php echo $hard[0] ?>; max = <?php echo $hard[1] ?>;break;
                case 'Very Hard':   min = <?php echo $very_hard[0] ?>; max = <?php echo $very_hard[1] ?>;break;
                default:          min = <?php echo $very_easy[0] ?>; max = <?php echo $very_easy[1] ?>;
            }
            $('#amount_level').attr({
                    min     : min,
                    max     : max,
                    value   : min, 
            });

            min = "Min: " + min + " $";
            max = max + " $ :Max";

            $('#min_text').text(min);
            $('#max_text').text(max);


        });

        // $("[type='number']").keypress(function(evt) {
        //     evt.preventDefault();
        // });

    </script>
    <!--<div class="form-group row">
        <label for="amountInput" class="col-sm-2 col-form-label">Amount</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="amountInput" placeholder="Amount">
        </div>
    </div>
    -->
    <div class="form-group row">
        <label for="descriptionInput" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description"></textarea>
        </div>
     </div>

</form>