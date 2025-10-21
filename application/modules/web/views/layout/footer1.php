<footer class="footer-area">
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="#" class="footer-logo">
                                <?php if(isset($school->frontend_logo)){ ?>                             
                                <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                                <?php }elseif(isset($school->logo)){ ?>  
                                    <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt=""  />
                                <?php }else{ ?>
                                    <img src="<?php echo IMG_URL; ?>default-front-logo.png" alt=""  />
                                <?php } ?>
                            </a>
                            <ul class="footer-contact">
                                <li><a href="tel:+8801973259393"><i class="far fa-phone"></i> <?=$school->phone;?></a></li>
                                <li><i class="far fa-map-marker-alt"></i> <?=$school->address;?></li>
                                <li><i class="far fa-envelope"></i> <?=$school->email;?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">কুইক লিংকস</h4>
                            <ul class="footer-list">
                                <li><a href="web/notice"><i class="fas fa-caret-right"></i>
                                        নোটিশ</a></li>
                                <li><a href="web/galleries"><i class="fas fa-caret-right"></i>
                                        ফটো গ্যালারী</a></li>
                                </li>
                                <li><a href="web/video_galleries"><i class="fas fa-caret-right"></i> ভিডিও গ্যালারি</a></li>
                                <li><a href="web/application_form"><i class="fas fa-caret-right"></i> অনলাইন এডমিশন</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">নিউজ লেটার</h4>
                            <div class="footer-newsletter">
                                <p>সর্বশেষ আপডেট এবং খবর পেতে আমাদের নিউজলেটার সাবস্ক্রাইব করুন</p>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="আপনার ইমেইল দিন">
                                        <button class="theme-btn" type="submit">
                                            সাবস্ক্রাইব করুন <i class="far fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-wrapper">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p class="copyright-text">
                                © ২০২৫ <?=$school->school_name;?>। সর্বস্বত্ব সংরক্ষিত।
                            </p>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="footer-social">
                                <?php if(isset($school->facebook_url) && !empty($school->facebook_url)){ ?>
                                    <li><a href="<?php echo $school->facebook_url; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <?php } ?> 
                                <?php if(isset($school->twitter_url)  && !empty($school->twitter_url)){ ?>
                                    <li><a href="<?php echo $school->twitter_url; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <?php } ?>                             
                                <?php if(isset($school->linkedin_url)  && !empty($school->linkedin_url)){ ?>
                                    <li><a href="<?php echo $school->linkedin_url; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                <?php } ?>                   
                                <?php if(isset($school->youtube_url)  && !empty($school->youtube_url)){ ?>
                                    <li><a href="<?php echo $school->youtube_url; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <?php } ?>                              
                                <?php if(isset($school->instagram_url)  && !empty($school->instagram_url)){ ?>
                                    <li><a href="<?php echo $school->instagram_url; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <?php } ?>                              
                                <?php if(isset($school->pinterest_url)  && !empty($school->pinterest_url)){ ?>
                                    <li><a href="<?php echo $school->pinterest_url; ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                                <?php } ?>    
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>