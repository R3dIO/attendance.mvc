
<head>

<link href="<?php echo base_url(); ?>css/table.css" rel="stylesheet" type="text/css">    
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body>
<center>
    <div class="col-md-10">
    <br>
    <div class="form-group form-inline" <?php if($count==0) echo 'hidden'; ?>>
        <label for="example-date-input" class="col-form-label"><b>Date</b></label>
        <div class="col-md-3 col-sm-8">
            <input class="form-control" type="date"  value="<?php date_default_timezone_set('Asia/Kolkata'); echo  date("Y-m-d");?>" id="datePicker" required>
        </div>
    </div>
<div class="card-block">
<blockquote class="card-blockquote">
    <div class="col-md-4 checkbox" <?php if($count==0) echo 'hidden'; ?>>
    <input type="checkbox" onClick="toggle(this)" id="checkBox" /> <div id="check">Check All</div><br/>
    </div>
    <div class="container border border-success">  
    <div id="no-more-tables">
            <table style="width:100%">
            <?php echo $student_list; ?>
            </table>
        </div>
        </div><br><br>
    </div>
</blockquote>
    <button onclick="save_attendance('<?php echo base_url(); ?>')" class="btn btn-primary btn-lg" <?php if($count==0) echo 'hidden'; ?>>Submit</button>
</div>
</center>
</div>
<script language="JavaScript">

//function to check & uncheck all the elements

    function toggle(source) {
          checkboxes = document.getElementsByName('attendanceRecords[]');
          check1=document.getElementsByClassName('btnchk');

                 for(var i=0, n=checkboxes.length;i<n;i++) {
                          checkboxes[i].checked = source.checked;
                    }
                                                    
        if(document.getElementById("check").innerHTML == "Uncheck All")
                {
                    document.getElementById("check").innerHTML = "Check All";
                var x=document.getElementsByName('chk');
                    for (i = 0; i < x.length;i++)
                            x[i].setAttribute("class", 'far fa-square');
                
                   for(var i=0;i<checkboxes.length;i++)
                                check1[i].className = 'btn btn-danger active btnchk';
            }
        else
                {
                    document.getElementById("check").innerHTML = "Uncheck All";
                var x=document.getElementsByName('chk');
                     for (i = 0; i < x.length; i++)
                        x[i].setAttribute("class", 'fas fa-check-square');  
                    for(var i=0;i<checkboxes.length;i++)
                    check1[i].className = 'btn btn-success active btnchk';
            }

}

     $(function () {
        $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'far fa-check-square'
                },
                off: {
                    icon: 'far fa-square'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.svg-inline--fa')
                .removeClass()
                .addClass('svg-inline--fa' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-danger')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-danger');
            }
        }

        // Initialization
        function init() {
            updateDisplay();
            if ($button.find('.svg-inline--fa').length == 0) {
                $button.prepend('<i id="chk" class="' + settings[$button.data('state')].icon + '" name="chk"></i> ');
            }
        }
        init();
    });
});
 
</script>
</body>
</html>


