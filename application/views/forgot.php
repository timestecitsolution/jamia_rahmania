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
                    background: linear-gradient(90deg, #ecf0ff, #fafbff);
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
         </style>
    </head>  

    <body>     
 
        <!--<div class="login_wrapper">
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
                <section><h1 class="text-center"><?php echo $this->lang->line('reset_password'); ?></h1></section>    
                <section class="login_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <p class="red" style="color:#fff;"><?php echo $this->session->flashdata('error'); ?></p>
                        <p class="green" style="color:#fff;"><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                    <?php echo form_open(site_url('auth/forgotpass'), array('name' => 'login', 'id' => 'login'), ''); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control has-feedback-left" placeholder="<?php echo $this->lang->line('username'); ?>" autocomplete="off">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                   
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input  class="btn btn-primary login-button" type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>"/>
                        <a class="reset_pass btn btn-primary login-button" href="<?php echo site_url('auth/login') ?>"><?php echo $this->lang->line('back_to_login'); ?></a>
                    </div>
                    <div class="clearfix"></div>                        
                    <?php echo form_close(); ?>
                </section>
            </div>
        </div>-->
        
        <section class="auth bg-base d-flex flex-wrap">
            <div class="auth-left d-lg-block d-none">
                <div class="d-flex align-items-center flex-column h-100 vh-100 justify-content-center">
                   <img  src="<?php echo IMG_URL; ?>/auth-img.png">
                </div>
            </div>
            <div class="auth-right p-2 px-24 d-flex flex-column justify-content-center">
                <div class="max-w-464-px mx-auto w-100">
                    
                     <img src="<?php echo IMG_URL; ?>/Proggya-logo.svg" width="200" class="mb-5">
                    
                    <div>
                        <h2 class="mb-3 fs-2">Reset Password</h2>
                        <p class="mb-5 text-secondary-light fs-5">Welcome back! Please enter your details.</p>
                    </div>

                        
                        <?php echo form_open(site_url('auth/forgotpass'), array('name' => 'login', 'id' => 'login'), ''); ?>
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
                        <div class="d-flex gap-3">
                            <input  class="btn btn-primary  px-12 py-3 w-100 radius-12 mt-32 rounded-pill" type="submit" name="submit" value="<?php echo $this->lang->line('submit'); ?>"/>
                        <a class="reset_pass btn btn-primary  px-12 py-3 w-100 radius-12 mt-32 rounded-pill" href="<?php echo site_url('auth/login') ?>"><?php echo $this->lang->line('back_to_login'); ?></a>

                        </div>
                        
                    <?php echo form_close(); ?>
                </div>
            </div>
        </section>
        
    </body>
</html>
