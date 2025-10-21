<div class="hero-area">
    <div class="hero-carousel owl-carousel">
        <?php if(isset($sliders) && !empty($sliders)){ ?>    
            <?php foreach($sliders AS $obj ){ ?>
                <div class="hero-single" style="background-image: url('<?php echo UPLOAD_PATH; ?>slider/<?php echo $obj->image; ?>');">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-12 col-lg-10">
                                <div class="hero-content text-center">
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        <?=$school->school_name;?>
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        <?=$school->address;?>
                                    </p>
                                    <div class="hero-btn d-table m-auto" data-animation="fadeInUp" data-delay="1s">
                                        <a href="web/about" class="theme-btn">আমাদের সম্পর্কে<i
                                                class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php }else{ ?>
                <div class="single-hero-carousel">
                    <div class="img">
                        <img src="<?php echo IMG_URL; ?>default-slider.jpg" alt="">
                    </div>
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-12 col-lg-10">
                                <div class="hero-content text-center">
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        <?=$school->school_name;?>
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        <?=$school->address;?>
                                    </p>
                                    <div class="hero-btn d-table m-auto" data-animation="fadeInUp" data-delay="1s">
                                        <a href="web/about" class="theme-btn">আমাদের সম্পর্কে<i
                                                class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
</div>


<!-- latest news -->
<section class="demo-section-box py-3">
    <div class="container">
        <div class="section-container">

            <div class="demo-box">

                <!-- DEMO15 HTML STARTS HERE *-->
                <!-- *********************** -->
                <div class="breaking-news-ticker" id="newsTicker15">
                    <div class="bn-label">জরুরী এলান</div>
                    <div class="bn-news">
                        <ul>
                            <?php if(isset($notices) && !empty($notices)){
                                foreach($notices as $notice){
                                ?>
                            <li><a href="#"><?php echo $notice->notice; ?></a>
                            </li>
                            <?php 
                                }
                            }else{
                                ?>
                            <li>
                                <a href="#">
                                    বিশেষ বিজ্ঞপ্তি: No notice....... 
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="bn-controls">
                        <button><span class="bn-arrow bn-prev"></span></button>
                        <button><span class="bn-action"></span></button>
                        <button><span class="bn-arrow bn-next"></span></button>
                    </div>
                </div>
                <!-- *********************** -->
                <!-- DEMO15 HTML END HERE *** -->

            </div>
        </div>
    </div>
</section>
<!-- latest news -->
<!-- feature area -->
<div class="feature-area mt-80">
    <div class="container">
        <div class="m-auto">
            <div class="feature-wrapper">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                            <span class="count">01</span>
                            <div class="feature-icon">
                                <img src="<?php echo base_url('assets/icon/data.svg')?>" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">স্থায়ী ভবন</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item active wow fadeInDown" data-wow-delay=".25s">
                            <span class="count">02</span>
                            <div class="feature-icon">
                                <img src="<?php echo base_url('assets/icon/teacher.svg')?>" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">অভিজ্ঞ ওস্তাদ</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                            <span class="count">03</span>
                            <div class="feature-icon">
                                <img src="<?php echo base_url('assets/icon/human.svg')?>" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">দক্ষ ব্যবস্থাপনা</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item wow fadeInDown" data-wow-delay=".25s">
                            <span class="count">04</span>
                            <div class="feature-icon">
                                <img src="<?php echo base_url('assets/icon/course-material.svg')?>" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">আধুনিক পাঠ্যক্রম</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- feature area end -->
 <!-- about area -->
<div class="about-area py-120">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                    <div class="about-img">
                        <div class="row g-4">
                            <?php
                            $default_image = base_url('assets/uploads/about/default-image.jpg'); 

                            $images = array();
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
            </div>


            <div class="col-lg-6">
                <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                    <div class="site-heading mb-3">
                        <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> আমাদের
                            সম্পর্কে</span>
                        <h2 class="site-title">
                            <?php echo $school->about_title;?>
                        </h2>
                    </div>
                    <p class="about-text">
                        <?php echo $school->about_text;?>
                    </p>
                    <div class="about-bottom">
                        <a href="web/about" class="theme-btn">বিস্তারিত<i class="fas fa-arrow-right-long"></i></a>
                        <div class="about-phone">
                            <div class="icon"><i class="fal fa-headset"></i></div>
                            <div class="number">
                                <span>ফোন করুন</span>
                                <h6><a href="tel:<?php echo $school->phone;?>"><?php echo $school->phone;?></a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about area end -->
<!-- counter area -->
<div class="counter-area pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($groups as $key => $name): ?>
                <div class="col-lg-2 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="<?php echo base_url('assets/icon/teacher-2.svg'); ?>" alt="">
                        </div>
                        <div>
                            <span class="counter" 
                                  data-count="+" 
                                  data-to="<?php echo isset($student_count[$key]) ? $student_count[$key] : 0; ?>" 
                                  data-speed="3000">
                                <?php echo isset($student_count[$key]) ? $student_count[$key] : 0; ?>
                            </span>
                            <h6 class="title">+ <?php echo $name; ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- counter area end -->
<!-- testimonial area -->
<div class="testimonial-area bg pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline"><i class="far fa-comments"></i> বার্তা</span>
                    <h2 class="site-title">প্রতিষ্ঠাতা পরিচালক ও মুহতামিম এর <span>বাণী</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="message-slider owl-carousel owl-theme">
            <div class="testimonial-item">
                <div class="testimonial-content d-block text-center">
                    <div class="testimonial-author-img d-block m-auto">
                        <img src="<?php echo base_url('assets/uploads/about/' . $muhtamim_message->img); ?>" alt="">
                    </div>
                    <div class="testimonial-author-info">
                        <h4><?php echo $muhtamim_message->name; ?></h4>
                        <p>মুহতামিম - <?php echo $school->school_name; ?></p>
                    </div>
                </div>
                <div class="testimonial-quote">
                    <p>بِسْمِ اللَّهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                    <p><?php echo $muhtamim_message->message; ?></p>
                    <span><b><?php echo $muhtamim_message->name; ?></b><br>
                    <span>মুহতামিম - <?php echo $school->school_name;; ?> </span><br>
                    <span><?php echo $school->address; ?></span><br>
                    <span>মোবাইল : <?php echo $school->phone;?></span>

                </div>

                <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-content  d-block text-center">
                    <div class="testimonial-author-img  d-block m-auto">
                        <img src="<?php echo base_url('assets/uploads/about/' . $founder_director_message->img); ?>" alt="">
                    </div>
                    <div class="testimonial-author-info">
                        <h4><?php echo $founder_director_message->name; ?></h4>
                        <p>প্রতিষ্ঠাতা পরিচালক <?php echo $school->school_name; ?></p>
                    </div>
                </div>
                <div class="testimonial-quote">
                    <p>بِسْمِ اللَّهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                    <p><?php echo $founder_director_message->message; ?></p>
                    <span><b><?php echo $founder_director_message->name; ?></b><br>
                    <span>প্রতিষ্ঠাতা ও পরিচালক - <?php echo $school->school_name; ?></span><br>
                    <span><?php echo $school->address; ?></span><br>
                    <span>মোবাইল : <?php echo $school->phone;?></span>
                </div>

                <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
            </div>
        </div>
    </div>
</div>
<!-- testimonial area end -->

<!-- gallery-area -->
<div class="gallery-area py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> গ্যালারি</span>
                    <h2 class="site-title">আমাদের ফটো <span>গ্যালারি </span></h2>
                    <p>আমাদের ফটো গ্যালারিতে আমাদের মাদ্রাসার ইভেন্ট এবং কৃতিত্বের হাইলাইট</p>
                </div>
            </div>
        </div>
        <div class="row popup-gallery">
            <?php if (!empty($gallery_images)) : ?>
                <?php foreach ($gallery_images as $obj) : ?>
                    <?php if (!empty($obj->image)) : ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="gallery-item" data-wow-delay=".25s">
                                <div class="gallery-img">
                                    <img src="<?php echo base_url('assets/uploads/gallery/' . $obj->image); ?>" alt="">
                                </div>
                                <div class="gallery-content">
                                    <a class="popup-img gallery-link" href="<?php echo base_url('assets/uploads/gallery/' . $obj->image); ?>">
                                        <i class="fal fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <p>No gallery images found.</p>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</div>
<!-- gallery-area end -->

<!-- testimonial area -->
<div class="testimonial-area bg pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> প্রশংসাপত্র</span>
                    <h2 class="site-title">আমাদের অভিভাবকরা আমাদের সম্পর্কে যা বলেন</h2>
                    <p>আমাদের মূল্যবান অভিভাবকদের হৃদয়স্পর্শী প্রতিক্রিয়া এবং অভিজ্ঞতা জানুন।</p>
                </div>
            </div>
        </div>

        <div class="testimonial-slider owl-carousel owl-theme">
            <?php foreach($guardian_message as $data){ ?>
            <div class="testimonial-item">
                <div class="testimonial-rate">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-quote">
                    <p><?php echo  $data->feedback;?></p>
                </div>
                <div class="testimonial-content">
                    <div class="testimonial-author-img">
                        <img src="assets/images/testimonial/1.jpg" alt="">
                    </div>
                    <div class="testimonial-author-info">
                        <h4><?php echo  $data->name;?></h4>
                        <p>গার্ডিয়ান</p>
                    </div>
                </div>
                <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- testimonial area end -->


<!-- <?php if(isset($news) && !empty($news)){ ?>
<div class="news-area">
    <div class="container">
        <div class="section-title">
            <h2 class="title">
                <img src="<?php echo IMG_URL; ?>front/icon/heading-<?php echo $school->theme_name; ?>.png" alt=""> 
                <?php echo $this->lang->line('latest_news'); ?>
            </h2>
        </div>
        <div class="row justify-content-center">
            <?php foreach($news AS $obj){ ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-news">
                        <div class="img">
                            <?php if(isset($obj->image) && !empty($obj->image)){ ?>
                                <img src="<?php echo UPLOAD_PATH; ?>news/<?php echo $obj->image; ?>" alt="">
                            <?php }else{ ?>
                                <img src="<?php echo IMG_URL; ?>news-image.jpg" alt="">
                            <?php } ?>  
                        </div>
                        <ul class="meta">
                            <li><span class="icon"><i class="fas fa-user-circle"></i></span> <?php echo $this->lang->line('by'); ?> / <?php echo $obj->name; ?></li>
                            <li><span class="icon"><i class="fas fa-calendar-alt"></i></span> <?php echo date($this->global_setting->date_format, strtotime($obj->date)); ?></li>
                        </ul>
                        <div class="content">
                            <a href="<?php echo site_url($school->school_url.'/news-detail/'.$obj->id); ?>">
                                <h2 class="title"><?php echo strip_tags(substr($obj->title, 0, 20)); ?> ...</h2>
                            </a>
                            <p class="text">
                               <?php echo strip_tags(substr($obj->news, 0, 160)); ?> ...
                            </p>
                            <div class="more-wrapper">
                                <a href="<?php echo site_url($school->school_url.'/news-detail/'.$obj->id); ?>" class="more"><?php echo $this->lang->line('read_more'); ?></a>
                            </div>
                        </div>
                    </div>
                </div> 
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<?php if(isset($feedbacks) && !empty($feedbacks)){ ?>
<div class="testimonial-area">
    <div class="container">
        <div class="section-title white">
            <h2 class="title">
                <img src="<?php echo IMG_URL; ?>front/icon/heading-<?php echo $school->theme_name; ?>.png" alt="">
                <?php echo $this->lang->line('what_guardian_say'); ?>
            </h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel owl-carousel">
                    <?php foreach($feedbacks AS $obj){ ?> 
                        <div class="single-testimonial">
                            <div class="author-thumb">
                                <?php if(isset($obj->photo) && !empty($obj->photo)){ ?>
                                    <img src="<?php echo UPLOAD_PATH; ?>guardian-photo/<?php echo $obj->photo; ?>" alt="">
                                <?php }else{ ?>
                                    <img src="<?php echo IMG_URL; ?>default-user.png" alt="">
                                <?php } ?>
                            </div>
                            <h4 class="author-name"><span class="inner"><?php echo $obj->name; ?></span></h4>
                            <p class="text">
                                <?php echo $obj->feedback; ?>
                            </p>
                        </div>  
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?> -->

