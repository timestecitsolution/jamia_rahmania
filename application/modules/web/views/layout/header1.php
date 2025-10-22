<header class="header">
    <!-- header area -->


        <!-- header top -->
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrap">
                    <div class="header-top-left">
                        <p class="header-top-news">স্বাগতম! <?=$school->school_name;?> </p>
                    </div>
                    <div class="header-top-right">
                        <div class="header-top-contact">
                            <ul>
                                <li>
                                    <a href="#"><i class="far fa-location-dot"></i> <?=$school->address;?></a>
                                </li>
                                <li>
                                    <a href="mailto:$school->email"><i class="far fa-envelopes"></i>
                                        <?=$school->email;?>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:$school->phone"><i class="far fa-phone-volume"></i> <?=$school->phone;?> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <?php if(isset($school->frontend_logo)){ ?>                             
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                            <?php }elseif(isset($school->logo)){ ?>  
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt=""  />
                            <?php }else{ ?>
                                <img src="<?php echo IMG_URL; ?>default-front-logo.png" alt=""  />
                            <?php } ?> 
                    </a>
                    <div class="mobile-menu-right">
                        <div class="search-btn">
                            <button type="button" class="nav-right-link search-box-outer"><i
                                    class="far fa-search"></i></button>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="<?php echo site_url($school->school_url); ?>"><?php echo $this->lang->line('home'); ?></a></li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">আমাদের
                                    সম্পর্কে</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="web/about">আমাদের সম্পর্কে</a></li>
                                    <li><a class="dropdown-item" href="web/teacher">ওস্তাদ</a></li>
                                    <li><a class="dropdown-item" href="web/staff">কর্মচারী</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="web/notice">নোটিশ</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">বিভাগ সমূহ</a>
                                <ul class="dropdown-menu fade-down">
                                    <?php foreach ($groups as $key => $name): ?>
                                    <li><a class="dropdown-item" href="#"><?php echo $name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">ভর্তি</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="web/application_form">ভর্তি ফর্ম</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?php echo base_url('auth/login'); ?>">লগইন</a></li>
                            <li class="nav-item"><a class="nav-link" href="web/contact">যোগাযোগ</a></li>
                        </ul>
                        <div class="nav-right">
                            <div class="search-btn">
                                <button type="button" class="nav-right-link search-box-outer"><i
                                        class="far fa-search"></i></button>
                            </div>
                            <div class="nav-right-btn mt-2">
                                <a href="web/application_form" class="theme-btn"><span class="fal fa-pencil"></span>আবেদন করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
   
    <!-- header area end -->
</header>