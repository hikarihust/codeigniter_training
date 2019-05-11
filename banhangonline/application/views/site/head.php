<meta http-equiv="Content-Type" content="text/html ;charset=utf-8">
<!-- the CSS -->
<link type="text/css" href="<?php echo public_url() ?>/site/css/reset.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url() ?>/site/css/style.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url() ?>/site/css/menu.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url() ?>/site/css/input.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url() ?>/site/css/product.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url() ?>/site/css/slide-flim.css" rel="stylesheet">
<!-- End CSS -->
<!-- the Javascript -->
<script src="//e.dtscout.com/e/?v=1a&amp;pid=5200&amp;site=1&amp;l=file%3A%2F%2F%2FC%3A%2FUsers%2Fuser%2FDesktop%2Fcodeigniter%2Fp3%2Ftemplate%2Fsite%2Findex.html&amp;j=" async="" type="text/javascript">
</script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>/js/jquery/jquery-ui/custom-theme/jquery-ui-1.8.21.custom.css" type="text/css">
<script src="<?php echo public_url() ?>/site/js/script.js"></script>
<!-- raty -->
<script type="text/javascript" src="<?php echo public_url() ?>/site/raty/jquery.raty.min.js"></script>
<script type="text/javascript">
    $(function() {
       $.fn.raty.defaults.path = '<?php echo public_url() ?>/site/raty/img';
       $('.raty').raty({
        	  score: function() {
        	    return $(this).attr('data-score');
        	  },
            readOnly  : true,
        });
    });
</script>
<style>.raty img{width:16px !important;height:16px; !important;}</style>
<!--End raty -->
<!-- End Javascript -->
<script type="text/javascript">
    $(document).ready(function(){
     $('#back_to_top').click(function() {
         $('html, body').animate({scrollTop:0},"slow");
    });
    // go top
    $(window).scroll(function() {
         if($(window).scrollTop() != 0) {
             $('#back_to_top').fadeIn();
         } else {
             $('#back_to_top').fadeOut();
         }
    });
    });
</script>
<style>
    #back_to_top {
    bottom: 10px;
    color: #666;
    cursor: pointer;
    padding: 5px;
    position: fixed;
    right: 55px;
    text-align: center;
    text-decoration: none;
    width: auto;
    }
</style>
<title>Học lập trình website với PHP và MYSQL</title>