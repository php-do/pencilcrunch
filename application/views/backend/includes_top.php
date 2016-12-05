<link rel="stylesheet" href="<?php echo site_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/css/font-icons/entypo/css/entypo.css'); ?>">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/css/neon-core.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/css/neon-theme.css'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/css/neon-forms.css'); ?>">

<link rel="stylesheet" href="assets/css/custom.css">

<?php
    $skin_colour = $this->db->get_where('settings' , array(
        'type' => 'skin_colour'
    ))->row()->description; 
    if ($skin_colour != ''):?>

    <link rel="stylesheet" href='<?php echo site_url("assets/css/skins/$skin_colour.css"); ?>'>

<?php endif;?>

<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/neon-rtl.css'); ?>">
<?php endif; ?>
<script src="<?php echo site_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>

        <!--[if lt IE 9]>
            <script src="<?php echo site_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script>
        <![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon.png'); ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/css/font-icons/font-awesome/css/font-awesome.min.css'); ?>">

<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">


<!--Amcharts-->
<script src="<?php echo site_url('assets/js/amcharts/amcharts.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/pie.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/serial.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/gauge.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/funnel.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/radar.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/amexport.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/rgbcolor.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/canvg.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/jspdf.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/filesaver.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/amcharts/exporting/jspdf.plugin.addimage.js'); ?>"></script>

<script>
    function checkDelete()
    {
        var chk=confirm("Are You Sure To Delete This !");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
</script>