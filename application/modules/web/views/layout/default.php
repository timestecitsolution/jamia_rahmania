<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta charset="ISO-8859-15">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile Specific Meta  -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title><?php echo $title_for_layout; ?></title> 
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="">
        <?php if($this->global_setting->favicon_icon){ ?>
            <link rel="icon" href="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $this->global_setting->favicon_icon; ?>" type="image/x-icon" />             
        <?php }else{ ?>
            <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <?php } ?>
        
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>assets/css/news-ticker.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/animate.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/jquery.fancybox.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/stellarnav.min.css">
        
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>assets/css/all-fontawesome.min.css">


        
        
        <?php if(isset($school->theme_name)){ ?>            
            <?php $this->load->view('layout/theme/'.  $school->theme_name); ?>
        <?php }else{ ?>
            <?php $this->load->view('layout/theme/dodger-blue'); ?>
        <?php } ?>  
            
        
        <?php if($school->enable_rtl){ ?>
            <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/rtl.css">
        <?php }elseif($this->global_setting->enable_rtl){ ?>
            <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/rtl.css">
        <?php } ?>       
            
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>front/responsive.css">        
        
        <script src="<?php echo JS_URL; ?>front/jquery-3.3.1.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery-ui.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->     
        
        <?php if(isset($this->global_setting->google_analytics) && !empty($this->global_setting->google_analytics)){ ?>         
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->global_setting->google_analytics; ?>"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', '<?php echo $this->global_setting->google_analytics; ?>');
            </script>
        <?php } ?>
            
    </head>

    <body class="home-3">
        <div id="preloader"></div>
        
        <?php 
        // $this->load->view('layout/header'); 
            $this->load->view('layout/header1'); 
        ?>  
        
        <!-- page content -->        
        <?php echo $content_for_layout; ?>
        <!-- /page content -->
        
        <!-- footer content -->
        <?php //$this->load->view('layout/footer'); ?>
        <?php $this->load->view('layout/footer1'); ?>   

        <!-- /footer content -->


        <!-- Scripts -->      
        
        
        
        
        <script src="<?php echo JS_URL; ?>front/jquery-3.7.1.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/owl.carousel.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.counterup.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/countdown.js"></script>
        <script src="<?php echo JS_URL; ?>front/stellarnav.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.scrollUp.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.waypoints.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/isotope.pkgd.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.fancybox.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/popper.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/bootstrap.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/theme-front.js"></script>

        <script src="<?php echo JS_URL; ?>front/modernizr.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/bootstrap.bundle.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.appear.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/jquery.easing.min.js"></script>
        <script src="<?php echo JS_URL; ?>front/counter-up.js"></script>
        <script src="<?php echo JS_URL; ?>front/wow.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/news-ticker.js"></script>
       
        <script src="<?php echo JS_URL; ?>front/main.js"></script>
        <script>
            jQuery(document).ready(function ($) {

                $('#newsTicker15').breakingNews({
                    borderWidth: 3,
                    height: 40,
                });
            });
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36251023-1']);
            _gaq.push(['_setDomainName', 'jqueryscript.net']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>


        <!-- js -->
        <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?php echo CSS_URL; ?>assets/js/jquery-3.7.1.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/isotope.pkgd.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/jquery.appear.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/counter-up.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/wow.min.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/contact-form.js"></script>
        <script src="<?php echo CSS_URL; ?>assets/js/main.js"></script>

    

        <script type="text/javascript">
            jQuery.extend(jQuery.validator.messages, {
                required: "<?php echo $this->lang->line('required_field'); ?>",
                email: "<?php echo $this->lang->line('enter_valid_email'); ?>",
                url: "<?php echo $this->lang->line('enter_valid_url'); ?>",
                date: "<?php echo $this->lang->line('enter_valid_date'); ?>",
                number: "<?php echo $this->lang->line('enter_valid_number'); ?>",
                digits: "<?php echo $this->lang->line('enter_only_digit'); ?>",
                equalTo: "<?php echo $this->lang->line('enter_same_value_again'); ?>",
                remote: "<?php echo $this->lang->line('pls_fix_this'); ?>",
                dateISO: "Please enter a valid date (ISO).",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
            
        </script>
    </body>
</html>