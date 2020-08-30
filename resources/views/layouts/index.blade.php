<!DOCTYPE html>
<html>

<head>
    <title>
        @yield('page-title')
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('extra-style')

    <style>
        .tool-btn {
            display: none;
        }

        .task-hover:hover + .tool-btn, .tool-btn:hover {
            display: inline-block;
        }

        .horizontal-word-line 
        {
            display: flex; 
            flex-direction: row; 
            color: #15316f;
            font-weight: 700;
            text-decoration: underline
        }
        .horizontal-word-line:before, 
        .horizontal-word-line:after 
        { 
            content: ""; 
            flex: 1 1; 
            border-bottom: 1px solid #000; 
            margin: auto; 
        } 


    </style>
</head>

<body>

    <div class="progress">
      <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    
    @yield('content')

    <div class="progress">
      <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/custom.js')}}"></script>
    <script>
        
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
        
    </script>
</body>

</html>
