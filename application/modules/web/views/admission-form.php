

    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(<?php echo CSS_URL; ?>assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">আবেদন ফর্ম</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="<?php echo site_url($school->school_url); ?>">Home</a></li>
                    <li class="active">আবেদন ফর্ম</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- application -->
        <div class="application py-120">
            <div class="container">
                <div class="application-form">
                    <h3>আবেদন ফর্ম</h3>
                    <form action="<?php echo base_url('web/admission_online');?>" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <h5 class="mb-3">শিক্ষার্থীর প্রাথমিক তথ্য</h5>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>শিক্ষার্থীর নাম</label>
                                    <input type="text" class="form-control" name="name" placeholder="শিক্ষার্থীর নাম">
                                    <div class="help-block"><?php echo form_error('name'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>জন্ম তারিখ</label>
                                    <input type="date" class="form-control" name="dob" placeholder="জন্ম তারিখ">
                                    <div class="help-block"><?php echo form_error('dob'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>লিঙ্গ</label>
                                    <select class="form-select" name="gender">
                                        <option value="">লিঙ্গ নির্বাচন করুন</option>
                                        <option value="1">পুরুষ</option>
                                        <option value="2">নারী</option>
                                        <option value="3">অন্যান্য</option>
                                    </select>
                                    <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>বর্তমান ঠিকানা</label>
                                    <input type="text" class="form-control" name="present_address" placeholder="বর্তমান ঠিকানা">
                                    <div class="help-block"><?php echo form_error('present_address'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <input type="text" class="form-control" name="premanent_address" placeholder="স্থায়ী ঠিকানা">
                                    <div class="help-block"><?php echo form_error('premanent_address'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>রক্তের গ্রুপ</label>
                                    <select  class="select2_mamun form-control" name="blood_group" id="blood_group">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        <?php $bloods = get_blood_group(); ?>
                                        <?php foreach($bloods as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label>শিক্ষার্থীর ছবি</label>
                                  <input type="file" class="form-control" name="photo" aria-describedby="photohelp">
                                  <div id="photohelp" class="form-text">Your Photo Must be in Passport (PP) Size. Max Upload Size 1MB.</div>
                                 <div class="help-block"><?php echo form_error('photo'); ?></div> 
                                </div>
                            </div>
                            <h5 class="mt-4 mb-3">অভিভাবকের তথ্য:</h5>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>বাবার নাম</label>
                                    <input type="text" class="form-control" name="father_name" placeholder="পিতার নাম">
                                    <div class="help-block"><?php echo form_error('father_name'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>বাবার পেশা</label>
                                    <input type="text" class="form-control" name="father_profession" placeholder="বাবার পেশা">
                                    <div class="help-block"><?php echo form_error('father_profession'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>বাবার ফোন</label>
                                    <input type="text" class="form-control" name="father_phone" placeholder="বাবার ফোন">                                
                                    <div class="help-block"><?php echo form_error('father_phone'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>মায়ের নাম</label>
                                    <input type="text" class="form-control" name="mother_name" placeholder="মায়ের নাম">
                                    <div class="help-block"><?php echo form_error('mother_name'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>মায়ের পেশা</label>
                                    <input type="text" class="form-control" name="mother_profession" placeholder="মায়ের পেশা">
                                    <div class="help-block"><?php echo form_error('mother_profession'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>মায়ের ফোন</label>
                                    <input type="text" class="form-control" name="mother_phone" placeholder="মায়ের ফোন">
                                    <div class="help-block"><?php echo form_error('mother_phone'); ?></div> 
                                </div>
                            </div>
                            <h5 class="mt-4 mb-3">একাডেমিক তথ্য</h5>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>পূর্ববর্তী মাদ্রাসা:</label>
                                    <input type="text" class="form-control" name="previous_school" placeholder="পূর্ববর্তী মাদ্রাসা">
                                    <div class="help-block"><?php echo form_error('previous_school'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>পূর্ববর্তী শ্রেণী:</label>
                                    <input type="text" class="form-control" name="previous_class" placeholder="পূর্ববর্তী শ্রেণী">
                                    <div class="help-block"><?php echo form_error('previous_class'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ভর্তির শ্রেণি নির্বাচন করুন:</label>
                                    <select  class="select2_mamun form-control col-md-7 col-xs-12 quick-field" name="class_id" required="required">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        <?php foreach($classes as $obj){ ?>
                                            <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block"><?php echo form_error('class_id'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label>ট্রান্সফার সার্টিফিকেট</label>
                                  <input type="file" class="form-control" name="document" aria-describedby="dochelp">
                                  <div id="dochelp" class="form-text">Upload File Must Be Zip File. Max Upload Size 1MB.</div>
                                  <div class="help-block"><?php echo form_error('document'); ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="agree" value="1" required>
                                  <label class="form-check-label" for="agree">
                                    By Submitting This Form You Agree To The <a href="#">Terms & Conditions</a> And <a href="#">Privacy Policy</a>.
                                  </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="theme-btn">Submit Application<i class="fas fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- application end-->

    </main>



