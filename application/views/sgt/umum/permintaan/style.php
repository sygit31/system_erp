<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.min.css">




<style>
    
    /* // Change the select container width and allow it to take the full parent width */
    .select2 
    {
        width: 100% !important
    }

    /* // Set the select field height, background color etc ... */
    .select2-selection
    {    
        height: 40px !important
        /* background-color: $light-color */
    }

    /* Set selected value position, color , font size, etc  */
    .select2-selection__rendered
    { 
        line-height: 35px !important
        /* color: yellow !important */
    }



    /* =================================================================== */



    [data-tip] {
        position:relative;
    }

    [data-tip]:before {
        content:'';
        /* hides the tooltip when not hovered */
        display:none;
        content:'';
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid #1a1a1a;	
        position:absolute;
        top:30px;
        left:35px;
        z-index:8;
        font-size:0;
        line-height:0;
        width:0;
        height:0;
    }

    [data-tip]:after {
        display:none;
        content:attr(data-tip);
        position:absolute;
        top:35px;
        left:0px;
        padding:5px 8px;
        background:#1a1a1a;
        color:#fff;
        z-index:9;
        font-size: 0.75em;
        /* height:18px; */
        height:28px;
        line-height:18px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        white-space:nowrap;
        word-wrap:normal;
    }

    [data-tip]:hover:before,
    [data-tip]:hover:after {
        display:block;
    }

</style>