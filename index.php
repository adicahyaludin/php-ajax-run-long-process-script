<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style>
    .run-script-now {
        cursor: pointer;
    }
    ul.run-script-result {
        padding: 0;
    }
    ul.run-script-result li {
        display: inline-block;
        margin: 5px;
    }
</style>
</head>
<body>
    <form method="post" action="" id="run-script-form" enctype="multipart/form-data">         
        <button class="run-script-now">Run Long PHP AJAX Scripts</button>
        <input type="hidden" name="current_row" value="0">
    </form>
    <ul class="run-script-result"></ul>
    <script>
        (function ($) {	
            "use strict";
                
            $(document).ready(function() {
                $(".run-script-now").on('click', function(e) {
                    e.preventDefault(); 
                    $('.run-script-result').html('<li>Start</li>');
                    var formData = $("#run-script-form").serialize();
                    processScript(formData);
                });
            });

            function processScript(formData) {	
                $.getJSON('ajax.php', formData)
                    .done(function(data) {	
                        switch (data.result) {
                            case 'COMPLETE':
                                $('.run-script-result').append('<li>Done!</li>');
                                break;
                            case 'NEXT':
                                var newFormData = JSON.parse(data.form_data);
                                $("#run-script-form INPUT[name='current_row']").val(newFormData.current_row);
                                $('.run-script-result').append('<li>'+newFormData.current_row+'</li>');
                                processScript(newFormData);
                                break;
                            case 'FAIL':	
                                $('.run-script-result').append('<li>Fail!</li>');
                                break;
                        }
                }).fail(function(data, status, error) {	
                    $('.run-script-result').append('<li>jQuery AJAX Failed!</li>');			
                });
            }	
        })( jQuery );
    </script>
</body>
</html>