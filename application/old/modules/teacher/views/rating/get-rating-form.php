<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 10px 20px;">
        <div class="row">
           <label for="rating" style="display: initial;padding-right: 10px;"> <?php echo $this->lang->line('rating'); ?></label>
            </br>
            <div class="item form-group">  
                <label for="rating" style="display: initial;padding-right: 10px;"> How much importance does your teacher give to everyone's response in the class, including yours? <span class="required">*</span></label>                        
                <span onclick="get_rating('1')" id="rating_1" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating('2')" id="rating_2" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating('3')" id="rating_3" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating('4')" id="rating_4" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating('5')" id="rating_5" class="fa fa-star" style="color:gray;"></span>                        
            </div> 


            <div class="item form-group">  
                <label for="rating1" style="display: initial;padding-right: 10px;"> How capable is your teacher in explaining things to you? <span class="required">*</span></label>                        
                <span onclick="get_rating1('1')" id="rating_11" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating1('2')" id="rating_12" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating1('3')" id="rating_13" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating1('4')" id="rating_14" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating1('5')" id="rating_15" class="fa fa-star" style="color:gray;"></span>                        
            </div> 


            <div class="item form-group">  
                <label for="rating2" style="display: initial;padding-right: 10px;">Does your teacher maintain time in class? <span class="required">*</span></label>                        
                <span onclick="get_rating2('1')" id="rating_21" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating2('2')" id="rating_22" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating2('3')" id="rating_23" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating2('4')" id="rating_24" class="fa fa-star" style="color:gray;"></span>
                <span onclick="get_rating2('5')" id="rating_25" class="fa fa-star" style="color:gray;"></span>                        
            </div> 

            <div class="item form-group">
                <label for="comment"> <?php echo $this->lang->line('comment'); ?></label>  
                <input type="hidden" id="rating" name="rating" value="" />
                <input type="hidden" id="rating1" name="rating1" value="" />
                <input type="hidden" id="rating2" name="rating2" value="" />
                <input type="hidden" id="teacher_id" name="teacher_id" value="<?php echo $teacher_id; ?>" />
                <input type="hidden" id="subject_id" name="subject_id" value="<?php echo $subject_id; ?>" />
                <textarea  class="form-control col-md-7 col-xs-12"  name="comment"  id="comment" style="height: 60px;"></textarea>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <a href="<?php echo site_url('teacher/rating/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                <button id="rating_form" type="button" class="btn btn-success" onclick="save_rating();"><?php echo $this->lang->line('submit'); ?></button>
            </div>
        </div>
    </div>
</div>  