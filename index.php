
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Anna &middot; ReadIt</title>
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

            /* Main marketing message and sign up button */
        .jumbotron {
            margin: 60px 0;

            text-align: center;
        }
        .jumbotron h1 {
            font-size: 72px;
            height:300px;
            line-height: 1;
        }
        .jumbotron h1.old {
            font-family: SCHOOLBOOK-WEB-CONDENSED;
        }
        .jumbotron h1.new{
            font-family:Arial;
        }
        .jumbotron h1.so{
            font-family:Georgia;
        }
        .jumbotron h1.zu{
            font-family:Verdana;
        }
        .jumbotron .btn {
            font-size: 40px;
            padding: 24px 44px;
        }

            /* Supporting marketing content */
        .marketing {
            margin: 60px 0;
        }
        .marketing p + h4 {
            margin-top: 28px;
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
        <ul class="nav nav-pills pull-right">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#myModal" role="button" data-toggle="modal">Add</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="muted">Read it!</h3>
    </div>

    <hr>

    <div class="jumbotron">
        <h1 id="read-this">Delfin</h1>

        <a id="change" class="btn btn-large btn-success">Nächster</a>
    </div>

    <hr>
<!--
    <div class="row-fluid marketing">
        <div class="span6">
            <h4>Subheading</h4>
            <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

            <h4>Subheading</h4>
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

            <h4>Subheading</h4>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="span6">
            <h4>Subheading</h4>
            <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

            <h4>Subheading</h4>
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

            <h4>Subheading</h4>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
    </div>

    <hr>-->

    <div class="footer">
        <p>&copy; Read it! 2013</p>
    </div>

</div> <!-- /container -->

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Add new Word</h3>
    </div>
    <div class="modal-body">
        <div id="modalError" class="alert alert-error hidden"></div>
        <form>
            <input type="text" name="new-word" id="new-word">
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" id="add">Add</button>
    </div>
</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change').click(function(){
            var sclass = ['old','new','so','zu'];
            var d = $('#read-this');
            d.fadeOut('slow',function(){
                d.removeClass( );
                var c = sclass[Math.floor(Math.random() * sclass.length)];
                d.addClass(c);
                var z = 18 + Math.floor(Math.random() * (128-18+1));
                d.css('font-size',z);

                $.ajax({
                     url: "http://localhost:8529/api/random",
                     type: "GET",
                     dataType: "json",
                     crossDomain: true,
                     beforeSend: function (xhr) {
                          xhr.setRequestHeader('Authorization', make_base_auth('user', "pw"));
                     },error:function (xhr, ajaxOptions, thrownError){
                        alert(xhr.status + '<>' + thrownError + '<>' + xhr.responseText);
                    }
                }).done(function(result) {
                        $('#read-this').html(result.name);
                    });
            });
            d.fadeIn('slow');
        });
        $('#add').click(function(){
            var word = $('#new-word');

            if(word.val()=='')
            {
                $('#modalError').html('Please fill in a word');
                $('#modalError').removeClass('hidden');
            }
            else
            {
                $.ajax({
                    url: "http://localhost:8529/api/new",
                    type: "POST",
                    dataRaw:{name:word.val()},
                    dataType: "json",
                    crossDomain: true,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', make_base_auth('user', "pw"));
                    },error:function (xhr, ajaxOptions, thrownError){
                        alert(xhr.status + '<>' + thrownError + '<>' + xhr.responseText);
                    }
                }).done(function(result) {
                        console.log(result);
                        $('#myModal').modal('hide');
                    });
            }
        });
    });
    function make_base_auth(user, password) {
        var tok = user + ':' + password;
        var hash = btoa(tok);
        return "Basic " + hash;
    }
</script>
</body>
</html>
