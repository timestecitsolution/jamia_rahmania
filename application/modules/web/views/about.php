<div class="page-header-area">
    <div class="container">
        <div class="page-header-content">
            <h2 class="title"><span class="inner"><?php echo $this->lang->line('about_school'); ?></span></h2>
            <ul class="links">
                <li><a href="<?php echo site_url($school->school_url); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                <li><a href="javascript:void(0);"><?php echo $this->lang->line('about_school'); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<?php if(isset($school->about_text) && !empty($school->about_text)){ ?>
   <div class="welcome-area">
        <div class="container">
            <div class="row">
                <?php if(isset($school->about_image) && !empty($school->about_image)){ ?>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- <div class="welcome-banner">
                        <?php
                        $about_images = []; 
                        if(isset($school->about_image) && !empty($school->about_image)){ 
                            $about_images = explode(',', $school->about_image);
                            foreach($about_images as $img){
                            ?>
                        <img class="wb-banner" src="<?php echo UPLOAD_PATH; ?>about/<?php echo $img; ?>" alt="">
                        <?php }
                        }
                        else{ ?>
                            <img class="wb-banner" src="<?php echo IMG_URL; ?>about-image.jpg" alt="">
                        <?php } ?>  
                    </div> -->
                    <div class="about-img">
                        <div class="row g-4">
                            <?php
                            $default_image = base_url('assets/uploads/about/default-image.jpg');

                            $images = [];
                            if (!empty($school->about_image)) {
                                $images = explode(',', $school->about_image);
                            }

                            while (count($images) < 4) {
                                $images[] = 'default';
                            }

                            $col1 = array_slice($images, 0, 2);
                            $col2 = array_slice($images, 2, 2);
                            ?>

                            <div class="col-md-6">
                                <img class="img-1" src="<?php echo $col1[0] !== 'default' ? base_url('assets/uploads/about/' . $col1[0]) : $default_image; ?>" alt="">
                                <img class="img-2 mt-5" src="<?php echo $col1[1] !== 'default' ? base_url('assets/uploads/about/' . $col1[1]) : $default_image; ?>" alt="">
                            </div>

                            <div class="col-md-6">
                                <img class="img-2" src="<?php echo $col2[0] !== 'default' ? base_url('assets/uploads/about/' . $col2[0]) : $default_image; ?>" alt="">
                                <img class="img-3 mt-4" src="<?php echo $col2[1] !== 'default' ? base_url('assets/uploads/about/' . $col2[1]) : $default_image; ?>" alt="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 offset-lg-1_ col-md-6 col-12">
                    <div class="welcome-content">
                        <h2 class="title"><?php echo $this->lang->line('welcome_to'); ?></h2>
                        <h2 class="title-2">
                            <?php if(isset($school->school_name)){ ?>
                                <?php echo $school->school_name; ?>
                            <?php }else{ ?>
                                  <?php echo SMS; ?>
                            <?php } ?>
                        </h2>
                        <p class="text">
                            <?php echo nl2br($school->about_text); ?>  
                        </p>                        
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                        <div class="welcome-content">
                            <h2 class="title"><?php echo $this->lang->line('welcome_to'); ?></h2>
                            <h2 class="title-2">
                                <?php if(isset($school->school_name)){ ?>
                                    <?php echo $school->school_name; ?>
                                <?php }else{ ?>
                                      <?php echo SMS; ?>
                                <?php } ?>
                            </h2>
                            <p class="text">
                                <?php echo nl2br($school->about_text); ?>  
                            </p>                        
                        </div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
<?php } ?>
