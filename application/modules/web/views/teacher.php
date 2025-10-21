<!-- preloader -->
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
        </div>
    </div>
    <!-- preloader end -->

    <!-- popup search -->
    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" placeholder="Search Here..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- popup search end -->



    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">শিক্ষকগণ </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="<?php echo site_url($school->school_url); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                    <li class="active">শিক্ষকগণ </li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        
        <!-- team-area -->
        <div class="team-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our Teachers</span>
                            <h2 class="site-title">Meet With Our <span>Teachers</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php if(isset($teachers) && !empty($teachers)){ ?>
                <?php foreach($teachers as $obj){ ?> 
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="team-img">
                                <!-- <img src="assets/img/team/01.jpg" alt="thumb"> -->
                                 <?php if(isset($obj->photo) && !empty($obj->photo)){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>teacher-photo/<?php echo $obj->photo; ?>" alt="">
                                    <?php }else{ ?>
                                        <img src="<?php echo IMG_URL; ?>default-user.png" alt="">
                                    <?php } ?>
                            </div>
                            <div class="team-social">
                                <?php if($obj->facebook_url){ ?>
                                    <a target="_blank" href="<?php echo $obj->facebook_url; ?>"><i class="fab fa-facebook-f"></i></a>
                                <?php } ?>
                                <?php if($obj->linkedin_url){ ?> 
                                    <a target="_blank" href="<?php echo $obj->linkedin_url; ?>"><i class="fab fa-linkedin-in"></i></a>
                                <?php } ?>
                                <?php if($obj->youtube_url){ ?>
                                    <a target="_blank" href="<?php echo $obj->youtube_url; ?>"><i class="fab fa-youtube"></i></a>
                                <?php } ?>
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#"><?php echo $obj->name; ?></a></h5>
                                    <span><?php echo $obj->department; ?></span>
                                </div>
                            </div>
                            <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                        </div>
                    </div>
                    <?php } ?>   
            <?php }else{ ?>
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="text-center"><strong><?php echo $this->lang->line('no_data_found'); ?></strong></p>
                </div>
            <?php } ?>
                </div>
            </div>
        </div>
        <!-- team-area end -->

    </main>