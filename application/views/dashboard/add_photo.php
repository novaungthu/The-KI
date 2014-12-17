<div class="row">
    <div class="col-lg-12">
        <?php foreach ($photoOutput->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($photoOutput->js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <div>
            <?php
            echo $photoOutput->output;
            ?>
            <div class="first-photo-message">* Your first photo appears in search results.<br>&nbsp;&nbsp;Maximum  size limit is <?php echo ini_get('upload_max_filesize'); ?>B</div>
        </div>
    </div>
</div>