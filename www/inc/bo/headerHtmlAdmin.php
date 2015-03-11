
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>TOTO</title>

  
    
<!-- Cascading Style Sheets -->
		
        <link href="css/v3.css" rel="stylesheet" type="text/css" />	
        <link href="css/wizardCss.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
                
	
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery-ui-1.8.20.custom.min.js"></script>
        
        <script type="text/javascript" src="js/adminScripts.js"></script>
        
        
        
        
        <!-- Template Admin LOGIN-->
            <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
            <!--  jquery core 
            <script src="js/admin-jquery/jquery-1.4.1.min.js" type="text/javascript"></script>-->

            <!-- Custom jquery scripts -->
            <script src="js/admin-jquery/custom_jquery.js" type="text/javascript"></script>

            <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
            <script src="js/admin-jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

            <script type="text/javascript">
                $(document).ready(function(){
                $(document).pngFix( );
                });
            </script>

       <!-- Template Admin Table -->
       
         <script src="js/admin-jquery/ui.core.js" type="text/javascript"></script>
        <script src="js/admin-jquery/ui.checkbox.js" type="text/javascript"></script>
        <script src="js/admin-jquery/jquery.bind.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
                $('input').checkBox();
                $('#toggle-all').click(function(){
                $('#toggle-all').toggleClass('toggle-checked');
                $('#mainform input[type=checkbox]').checkBox('toggle');
                return false;
                });
        });
        </script>  


        <![if !IE 7]>

        <!--  styled select box script version 1 -->
        <script src="js/admin-jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
        });
        </script>


        <![endif]>


        <!--  styled select box script version 2 --> 
        <script src="js/admin-jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
                $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
        });
        </script>

        <!--  styled select box script version 3 --> 
        <script src="js/admin-jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
                $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
        });
        </script>

        <!--  styled file upload script --> 
        <script src="js/admin-jquery/jquery.filestyle.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
        $(function() {
                $("input.file_1").filestyle({ 
                image: "images/forms/upload_file.gif",
                imageheight : 29,
                imagewidth : 78,
                width : 300
                });
        });
        </script>

        <!-- Custom jquery scripts -->
        <script src="js/admin-jquery/custom_jquery.js" type="text/javascript"></script>

        <!-- Tooltips -->
        <script src="js/admin-jquery/jquery.tooltip.js" type="text/javascript"></script>
        <script src="js/admin-jquery/jquery.dimensions.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(function() {
                $('a.info-tooltip ').tooltip({
                        track: true,
                        delay: 0,
                        fixPNG: true, 
                        showURL: false,
                        showBody: " - ",
                        top: -35,
                        left: 5
                });
        });
        </script> 

        <!--  date picker script -->
        <link rel="stylesheet" href="css/datePicker.css" type="text/css" />
        <script src="js/admin-jquery/date.js" type="text/javascript"></script>
        <script src="js/admin-jquery/jquery.datePicker.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
                $(function()
        {

        // initialise the "Select date" link
        $('#date-pick')
                .datePicker(
                        // associate the link with a date picker
                        {
                                createButton:false,
                                startDate:'01/01/2005',
                                endDate:'31/12/2020'
                        }
                ).bind(
                        // when the link is clicked display the date picker
                        'click',
                        function()
                        {
                                updateSelects($(this).dpGetSelected()[0]);
                                $(this).dpDisplay();
                                return false;
                        }
                ).bind(
                        // when a date is selected update the SELECTs
                        'dateSelected',
                        function(e, selectedDate, $td, state)
                        {
                                updateSelects(selectedDate);
                        }
                ).bind(
                        'dpClosed',
                        function(e, selected)
                        {
                                updateSelects(selected[0]);
                        }
                );

        var updateSelects = function (selectedDate)
        {
                var selectedDate = new Date(selectedDate);
                $('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
                $('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
                $('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
        }
        // listen for when the selects are changed and update the picker
        $('#d, #m, #y')
                .bind(
                        'change',
                        function()
                        {
                                var d = new Date(
                                                        $('#y').val(),
                                                        $('#m').val()-1,
                                                        $('#d').val()
                                                );
                                $('#date-pick').dpSetSelected(d.asString());
                        }
                );

        // default the position of the selects to today
        var today = new Date();
        updateSelects(today.getTime());

        // and update the datePicker to reflect it...
        $('#d').trigger('change');
        });
        </script>
        
</head>

<body>
 