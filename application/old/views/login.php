<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $this->lang->line('login'). ' | ' . SMS;  ?></title>
        
        <?php if($this->global_setting->favicon_icon){ ?>
            <link rel="icon" href="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $this->global_setting->favicon_icon; ?>" type="image/x-icon" />             
        <?php }else{ ?>
            <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <?php } ?>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">     
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Custom Theme Style -->
        <!-- <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet"> -->
         <?php $this->load->view('layout/login-css'); ?>  
         <style>
         body{
             background:#ffffff;
             font-family: "Poppins", serif;
         }
             .auth-left {
                    background: linear-gradient(90deg, #f0fff8, #f0fff8);
                    width: 50%;
                }
            .auth-right {
                width: 50%;
            }
            .max-w-464-px {
                max-width: 464px;
            }
            .form-control, .form-select, textarea {
                border: 1px solid #d1d5db;
                color: #4b5563 !important;
                background-color: #f5f6fa;
                padding: .5625rem 1.25rem;
                    border-radius: .75rem;
                -webkit-border-radius: .75rem;
                -moz-border-radius: .75rem;
                -ms-border-radius: .75rem;
                -o-border-radius: .75rem;
            }
            .icon-field .icon {
                position: absolute;
                top: 12px;
                inset-inline-start: 0;
                width: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 1.25rem;
                color: var(--text-secondary-light);
            }
            .h-56-px {
                height: 3.5rem !important;
            }
            .icon-field .form-control {
                -webkit-padding-start: 2.5rem;
                padding-inline-start: 2.5rem;
            }
            @media (max-width: 768px) {
                .auth-right>div {
                    max-width: 95%;
                    width: 95%;
                    text-align:center;
                    width: 100%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    border: 1px solid #cccccc;
                    padding: 50px 20px !important;
                    border-radius:20px;
                }
                
            }
            @media (max-width: 991px) {
                .auth-right {
                    width: 100%;
                }
            }
            .btn-primary {
                color: #fff;
                background-color: #075936;
                border-color: #075936;
            }
            .btn-primary:hover {
                color: #fff;
                background-color: #075936;
                border-color: #075936;
            }
            a{
               color: #075936; 
            }
         </style>
    </head>    
    <body>     

       <!-- <div class="login_wrapper">
            <section>
                <center>
                    <?php  if(UPLOAD_PATH.'logo/'.$this->global_setting->brand_logo){ ?>
                        <img  src="<?php echo UPLOAD_PATH.'logo/'.$this->global_setting->brand_logo; ?>" style="max-width: 100px;" alt="">
                    <?php }else{ ?>
                        <img  width="100" height="100" src="<?php echo IMG_URL; ?>/sms-logo.png">
                    <?php } ?>                    
                </center>
            </section>
            <div class="form login_form">
                <section><h1 class=""><?php echo $this->lang->line('login'); ?></h1></section>    
                <section class="login_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <p class="red" style="color: #fff;"><?php echo $this->session->flashdata('error'); ?></p>
                        <p class="green"  style="color: #fff;"><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                    <?php echo form_open(site_url('auth/login'), array('name' => 'login', 'id' => 'login'), ''); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control has-feedback-left" placeholder="<?php echo $this->lang->line('username'); ?>" autocomplete="off">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="password" name="password" class="form-control has-feedback-left" id="inputSuccess2" placeholder="<?php echo $this->lang->line('password'); ?>" autocomplete="off">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                    </div>                    
                   
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input  class="btn btn-primary login-button" type="submit" name="submit" value="<?php echo $this->lang->line('login'); ?>" />
                        <a class="reset_pass btn btn-primary login-button" href="<?php echo site_url('auth/forgot') ?>"><?php echo $this->lang->line('lost_your_password'); ?></a>
                    </div>
                    <div class="clearfix"></div>                        
                    <?php echo form_close(); ?>
                </section>
            </div>
        </div>-->
        
        <section class="auth bg-base d-flex flex-wrap">
            <div class="auth-left d-lg-block d-none">
                <div class="d-flex align-items-center flex-column h-100 vh-100 justify-content-center ">
                   <img  src="<?php echo IMG_URL; ?>/left-banner.png">
                </div>
            </div>
            <div class="auth-right p-2 px-24 d-flex flex-column justify-content-center text-center">
                <div class="max-w-464-px mx-auto w-100">
                    
                     <img src="<?php echo IMG_URL; ?>/qaomi-sikkha.svg" width="100" class="mb-5">
                    
                    <div>
                        <h2 class="mb-3 fs-2">অ্যাকাউন্টে সাইন ইন করুন</h2>
                        <p class="mb-5 text-secondary-light fs-5">আবার স্বাগতম! আপনার বিস্তারিত লিখুন.</p>
                    </div>

                        
                        <?php echo form_open(site_url('auth/login'), array('name' => 'login', 'id' => 'login'), ''); ?>
                        <div class="position-relative mb-3">
                            <div class="icon-field mb-16">
                                <span class="icon top-50 translate-middle-y">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect width="18.5" height="17" x="2.682" y="3.5" rx="4"></rect>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.729 7.59l7.205 4.13a3.96 3.96 0 0 0 3.975 0l7.225-4.13"></path>
                                        </g>
                                    </svg>
                                </span>
                                <input type="text" name="username" class="form-control h-56-px bg-neutral-50 has-feedback-left" placeholder="<?php echo $this->lang->line('username'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="position-relative mb-20">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M9 16a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2"></path>
                                        <path fill="currentColor" fill-rule="evenodd" d="M5.25 8v1.303q-.34.023-.642.064c-.9.12-1.658.38-2.26.981c-.602.602-.86 1.36-.981 2.26c-.117.867-.117 1.97-.117 3.337v.11c0 1.367 0 2.47.117 3.337c.12.9.38 1.658.981 2.26c.602.602 1.36.86 2.26.982c.867.116 1.97.116 3.337.116h8.11c1.367 0 2.47 0 3.337-.116c.9-.122 1.658-.38 2.26-.982s.86-1.36.982-2.26c.116-.867.116-1.97.116-3.337v-.11c0-1.367 0-2.47-.116-3.337c-.122-.9-.38-1.658-.982-2.26s-1.36-.86-2.26-.981a10 10 0 0 0-.642-.064V8a6.75 6.75 0 0 0-13.5 0M12 2.75A5.25 5.25 0 0 0 6.75 8v1.253q.56-.004 1.195-.003h8.11q.635 0 1.195.003V8c0-2.9-2.35-5.25-5.25-5.25"></path>
                                    </svg>
                                </span>
                                <input type="password" name="password" class="form-control h-56-px has-feedback-left" id="inputSuccess2" placeholder="<?php echo $this->lang->line('password'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-2 my-4">
                            <div class="form-check style-check d-flex align-items-center gap-2">
                                <input class="form-check-input border border-neutral-300 mt-0" type="checkbox" id="remember" value="">
                                <label class="form-check-label" for="remember">রিমেম্বার </label>
                            </div>
                            <a class="text-primary-600 fw-medium" href="<?php echo site_url('auth/forgot'); ?>">পাসওয়ার্ড ভুলে গেছেন?</a>
                        </div>
                        
                        <input  class="btn btn-primary  px-12 py-3 w-100 radius-12 mt-32 rounded-pill" type="submit" name="submit" value="<?php echo $this->lang->line('login'); ?>" />
                    <?php echo form_close(); ?>
                    
                    <div class="text-center mt-3">
                        <p>Powered by <a href="https://proggya.net/">Proggya</a></p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
