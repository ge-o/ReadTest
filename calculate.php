<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Anna &middot; Rechnen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 20px;
            padding-bottom: 40px;
        }

            /* Custom container */
        .container-narrow {
            margin: 0 auto;
            max-width: 700px;
        }
        .container-narrow > hr {
            margin: 30px 0;
        }
        .counter {
            font-size: 35px;
            float:right;
            margin-right:35px;
        }
        .jumbotron {
            margin: 60px 0;

            text-align: center;
        }
        .marketing {
            margin: 60px 0;
        }
        .marketing p + h4 {
            margin-top: 28px;
        }
        .in
        {
            width: 80px !important;
            height: 80px !important;
            font-size: 48px !important;
            font-family:Verdana !important;
            text-align:center;
            padding: 4px 20px 18px 6px !important;
        }
        .red
        {
            background-color: red !important;
            color: white !important;
        }
        .green
        {
            background-color: forestgreen !important;
            color: white !important;
        }
        .orange
        {
            background-color: darkorange !important;
            color: white !important;
        }
        #erg
        {
            display: inline-block;
            width:150px !important;
            text-align:left;
        }
        #second
        {

        }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">
</head>

<body>

<div class="container-narrow">

    <div class="masthead">
        <span class="counter">0</span>
        <ul class="nav nav-tabs">
            <li >
                <a href="index.php">Lies!</a>
            </li>
            <li class="active"><a href="calculate.php">Rechne!</a></li>
        </ul>
    </div>
    <div class="jumbotron">
        <form action="#" method="POST">
            <input type="hidden" id="act" value="solution">
            <input type="text" id="first" class="in" value="5"> <span id="meth" class="in">+</span> <input type="text" id="second" class="in" value="8"> <span id="erg" class="in">= ?</span>

        </form>

        <a id="change" class="btn btn-large btn-success">lösen</a>
    </div>
    <hr>

    <div class="footer">
        <ul class="nav nav-pills pull-right">
            <li><label class="radio"><input type="radio" name="mode" id="mode" value="+" checked="checked"> Addition &nbsp;</label></li>
            <li><label class="radio"><input type="radio" name="mode" id="mode" value="*"> Multiplikation</label></li>
        </ul>
        <p>&copy; <a href="https://github.com/ge-o" target="_blank">ge-o</a> 2013</p>
    </div>

</div> <!-- /container -->

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Neuer Eintrag</h3>
    </div>
    <div class="modal-body">
        <div id="modalError" class="alert alert-error hidden"></div>
        <form method="post">
            <input type="text" name="new-word" id="new-word">
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">schliessen</button>
        <button class="btn btn-primary" id="add">hinzufügen</button>
    </div>

</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/conf.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    var counter = 0;
    $(document).ready(function(){
        $('#change').click(function(){
            var act = $('#act').val();
            if(act == 'solution')
            {
                var a = $('#first').val();
                var b = $('#second').val();
                var m = $('#meth').html();
                $('#erg').html('= '+eval(a + m + b));
                $('#change').html('nächster');
                $('#act').val('next');
                counter++;
                $('.counter').html(counter);
            }
            else if(act == 'next')
            {
                var first = make_rnd();
                var second = make_rnd();
                var meth = $( "input:radio[name=mode]:checked" ).val();
                $('#first').val(first);
                $('#second').val(second);
                if(meth == '+')
                {
                    if (first == second)
                    {
                        reset_class('red');
                    }
                    else if(first ==1 || second == 1 || first ==10 || second ==10 )
                    {
                        reset_class('green');
                    }
                    else
                    {
                        reset_class('');
                    }
                }
                else
                {
                    if (first == second)
                    {
                        reset_class('red');
                    }
                    else if(first ==1 || second == 1 || first ==10 || second ==10 )
                    {
                        reset_class('green');
                    }
                    else if(first ==2 || second == 2 )
                    {
                        reset_class('orange');
                    }
                    else
                    {
                        reset_class('');
                    }
                }
                $('#meth').html(meth);
                $('#erg').html('= ?')
                $('#change').html('lösen');
                $('#act').val('solution');
            }
        });

    });

    function reset_class(hold)
    {
        var colors = ['red','green','orange'];
        for (var i=0;i<=colors.length;i++)
        {
            if(colors[i] == hold)
            {
                $('#first').addClass(hold);
                $('#second').addClass(hold);
            }
            else
            {
                $('#first').removeClass(colors[i]);
                $('#second').removeClass(colors[i]);
            }
        }
    }
    function make_base_auth(user, password) {
        var tok = user + ':' + password;
        var hash = btoa(tok);
        return "Basic " + hash;
    }
    function make_rnd()
    {
        return 1 + Math.floor(Math.random() * (11-1));
    }
</script>
</body>
</html>
