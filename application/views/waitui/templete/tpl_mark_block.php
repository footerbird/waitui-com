<?php foreach ($mark_block as $mark){ ?>
<li><a href="<?php echo base_url() ?>mark_detail/<?php echo $mark->regno_md; ?>.html" target="_blank">
    <img class="thumb" src="<?php echo $mark->image_path; ?>" />
    <div class="limit">
        <h4 class="price">¥<?php echo $mark->mark_price; ?></h4>
        <h5 class="category"><?php echo $mark->mark_category<10?'0'.$mark->mark_category:$mark->mark_category; ?>类<i></i><?php echo $mark->mark_name; ?></h5>
    </div>
    <p><?php echo $mark->app_range; ?></p>
</a></li>
<?php } ?>