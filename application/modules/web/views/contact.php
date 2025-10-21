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
                <h2 class="breadcrumb-title">যোগাযোগ করুন</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="<?php echo site_url($school->school_url); ?>">Home</a></li>
                    <li class="active">যোগাযোগ করুন</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- contact area -->
        <div class="contact-area py-120">
            <div class="container">
                <div class="contact-content">
                    <div class="row">
                        <?php if(isset($school->address) && !empty($school->address)){ ?>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-map-location-dot"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5><?php echo $this->lang->line('address'); ?></h5>
                                    <p><?php echo $school->address; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(isset($school->phone) && !empty($school->phone)){ ?>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-phone-volume"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5><?php echo $this->lang->line('phone'); ?></h5>
                                    <p><?php echo $school->phone; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(isset($school->email) && !empty($school->email)){ ?>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-envelopes"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5><?php echo $this->lang->line('email'); ?></h5>
                                    <p><?php echo $school->email; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if (!empty($opening_hours) && isset($opening_hours[0])): ?>
                        <?php
                        $opening_data = $opening_hours[0];

                        $days = [
                            'saturday'  => 'Saturday',
                            'sunday'    => 'Sunday',
                            'monday'    => 'Monday',
                            'tuesday'   => 'Tuesday',
                            'wednesday' => 'Wednesday',
                            'thursday'  => 'Thursday',
                            'friday'    => 'Friday'
                        ];

                        $grouped = [];

                        foreach ($days as $key => $label) {
                            $time = isset($opening_data->$key) ? trim($opening_data->$key) : '';
                            if ($time !== '') {
                                $grouped[$time][] = $label;
                            }
                        }

                        // Helper function to group consecutive days
                        function group_days($days_array) {
                            $day_order = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                            $ordered = array_flip($day_order);
                            usort($days_array, function($a, $b) use ($ordered) {
                                if ($ordered[$a] == $ordered[$b]) return 0;
                                return ($ordered[$a] < $ordered[$b]) ? -1 : 1;
                            });

                            $ranges = [];
                            $start = $prev = null;

                            foreach ($days_array as $i => $day) {
                                if ($start === null) {
                                    $start = $prev = $day;
                                } elseif ($ordered[$day] === $ordered[$prev] + 1) {
                                    $prev = $day;
                                } else {
                                    $ranges[] = ($start === $prev) ? $start : "$start - $prev";
                                    $start = $prev = $day;
                                }
                            }

                            if ($start !== null) {
                                $ranges[] = ($start === $prev) ? $start : "$start - $prev";
                            }

                            return $ranges;
                        }
                        ?>
                        
                        <?php if (!empty($grouped)): ?>
                            <div class="col-md-3">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-alarm-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>চালু সময়</h5>
                                        <?php foreach ($grouped as $time => $days_array): ?>
                                            <?php foreach (group_days($days_array) as $day_range): ?>
                                                <p><?= $day_range ?> (<?= $time ?>)</p>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="contact-img">
                                <!-- <img src="assets/img/contact/01.jpg" alt=""> -->
                                <img src="<?php echo base_url('assets/css/assets/img/contact/01.jpg')?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page randomised words which don't look even slightly when looking at its layout. </p>
                                </div>
                                <form method="post" action="#" id="contact-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Your Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Your Subject" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" cols="30" rows="5" class="form-control"
                                            placeholder="Write Your Message"></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn">Send
                                        Message <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-messege text-success"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact area -->

        <!-- map -->
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

    </main>
