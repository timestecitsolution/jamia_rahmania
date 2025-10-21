<div class="page-header-area">
    <div class="container">
        <div class="page-header-content">
            <h2 class="title"><span class="inner"><?php echo $this->lang->line('gallery'); ?></span></h2>
            <ul class="links">
                <li><a href="<?php echo site_url($school->school_url); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                <li><a href="javascript:void(0);"><?php echo $this->lang->line('gallery'); ?></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="page-gallery-area">    
    <div class="container">
        
        
        <div class="gallery-menu">
            <button class="button checked" data-filter="*">All</button>
            <?php foreach($galleries AS $obj){ ?>
                <button class="button" data-filter=".<?php echo $obj->id; ?>Gallery"><?php echo $obj->title; ?></button>                
            <?php } ?>
        </div>
        
        <div class="row justify-content-center grid_container" id="container">
            <div class="col-md-4 col-sm-6 col-12 gallery-box grid <?php echo $obj->id; ?>Gallery" data-category="post-transition">
                <?php foreach($video_gallery AS $obj){ ?>
                <div class="single-gallery">
                    <a href="#" class="link" target="_blank"><i class="fas fa-link"></i></a>
                        <?php echo $obj->embed_code; ?>
                </div>
                <?php } ?>
            </div>    
        </div> 
    </div>
</div>