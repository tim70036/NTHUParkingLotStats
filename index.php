<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <script src="//d3js.org/d3.v3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">LazyShout</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="status" class="nav-link link" href="#">Status</a>
                </li>
                <li class="nav-item">
                    <a id="challenge" class="nav-link link" href="#">Challenge</a>
                </li>
                <li class="nav-item">
                    <a id="history" class="nav-link link" href="#">History</a>
                </li>
            </ul>
            <ul class="navbar-nav pull-xs-right">
                <li class="nav-item active">
                    <a id="login" class="nav-link link" href="#">Login</a>
                </li>
            </ul>
    </nav>


    <!-- Main content -->
    <div id="main-content" class="container-fluid">

        <div class="card">
            <div class="card-header">
                摸魚
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>
                        我在摸魚
                        <small class="text-muted">摸摸摸</small>
                    </p>

                </blockquote>
            </div>
        </div>

    </div> 

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


    <script type="text/javascript">
    function requestAndJumpToPage(requestTarget){
        $.ajax({
        type: 'GET',
            url: requestTarget,
            // data: postedData,
            dataType: 'text',
            success: function(response){
                $("#main-content").html(response);
                //console.log(response);
            },
            fail: function(response){
                console.log(response);
            }
        });
    }

    $(".link").on("click", function () {
        // remove focus on navbar, this causes issue on webterm page (user pushes enter -> reload webterm again)
        $(this).blur();

        var requestTarget = $(this).attr("id") + ".html";
        requestAndJumpToPage(requestTarget);
    });

    // Default home page
    requestAndJumpToPage('status.html');
    </script>
</body>
</html>