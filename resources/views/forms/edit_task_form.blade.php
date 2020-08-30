<style>

</style>
<?php 

    // get Price level Details of the Project
    $levels = $task->project->level_details;
    $levels_decoded = json_decode($levels);

    $very_easy  = $levels_decoded->{"Very Easy"};
    $easy       = $levels_decoded->{"Easy"};
    $medium     = $levels_decoded->{"Medium"};
    $hard       = $levels_decoded->{"Hard"};
    $very_hard  = $levels_decoded->{"Very Hard"};

    //Fromat the Date
    $date       = $task->date;
    $newDate    = date("Y-m-d", strtotime($date)); 

    //Get out Start and End off Time
    $time       = $task->time;
    $timeArray  = explode(" -> ", $time);
    $start      = $timeArray[0];
    $end        = $timeArray[1];
    $newStart   = date("H:i", strtotime($start)); 
    $newEnd     = date("H:i", strtotime($end)); 

    $duration   = $task->duration;
    $level      = $task->level;
    $amount     = $task->amount;
    $description = $task->description;

    //get price Level from Project
    $level_details = $task->project->level_details;
    $level_decoded = json_decode($level_details, true);
    //getvalues
    $level_min = $level_decoded[$level][0];
    $level_max = $level_decoded[$level][1];

 ?>

<form action="{{ route('task.update', $task->id ) }}" id="update-task-form">
    @csrf
    <input type="hidden" name="project_id" value="">
    <div class="form-group row">
        <label for="dateInput" class="col-sm-2 col-form-label">Date</label>
        <div class="col-sm-10">
            <input  type="date" 
                    class="form-control" 
                    name="date" 
                    id="dateInput" 
                    value="<?php echo $newDate;?>"
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
                <label for="originalDuration" class="col-sm-2 col-form-label">Duration</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="<?php echo $duration ?>" readonly>
                </div>
            </div>
            <div class="row">
                <label for="timeStart" class="col-sm-2 col-form-label">Start</label>
                <div class="col-sm-10">
                    <input  type="time" class="form-control" name="timeStart" id="timeStart" name="timeStart" <?php echo "value='" . $newStart ."'" ?> >
                </div>
            </div>
            <div class="row">
                <label for="timeEnd" class="col-sm-2 col-form-label">End</label>
                <div class="col-sm-10">
                    <input  type="time" class="form-control" name="timeEnd" id="timeEnd" name="timeEnd" <?php echo "value='" . $newEnd ."'" ?>>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="levelInput" class="col-sm-2 col-form-label">level</label>
        <div class="col-sm-10">
            <select class="form-control" id="levelInput" name="level">
              <option <?php echo ($level=="Very Easy") ? "selected" : "" ?>>Very Easy</option>
              <option <?php echo ($level=="Easy") ? "selected" : "" ?>>Easy</option>
              <option <?php echo ($level=="Medium") ? "selected" : "" ?>>Medium</option>
              <option <?php echo ($level=="Hard") ? "selected" : "" ?>>Hard</option>
              <option <?php echo ($level=="Very Hard") ? "selected" : "" ?>>Very Hard</option>
            </select>
            <div>
                
            </div>

            <div class="input-group my-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="min_text">Min: {{ $level_min }} $</span>
              </div>

              <input type="number" min="{{ $level_min }}" max="{{ $level_max }}" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" value="{{ $task->original_price }}" id="amount_level_edit">

              <div class="input-group-append">
                <span class="input-group-text" id="max_text">{{ $level_max }} $:Max</span>
              </div>
            </div>

        </div>
    </div>
    <script>
        
        $('#levelInput').on('change', function() {
            var level = $('select option:selected').val();  
            var min,max;
            switch(level) {
                case 'Very Easy': min = <?php echo $very_easy[0] ?>; max = <?php echo $very_easy[1] ?>;break;
                case 'Easy':        min = <?php echo $easy[0] ?>; max = <?php echo $easy[1] ?>;break;
                case 'Medium':      min = <?php echo $medium[0] ?>; max = <?php echo $medium[1] ?>;break;
                case 'Hard':        min = <?php echo $hard[0] ?>; max = <?php echo $hard[1] ?>;break;
                case 'Very Hard': min = <?php echo $very_hard[0] ?>; max = <?php echo $very_hard[1] ?>;break;
                default:        min = <?php echo $very_easy[0] ?>; max = <?php echo $very_easy[1] ?>;
            }
            
            $('#amount_level_edit').attr({
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
            <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Description" name="description">{{ $description }}</textarea>
        </div>
     </div>

</form>