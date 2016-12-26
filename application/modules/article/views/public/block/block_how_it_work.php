<div id="round-how-it-work">
    <div class="col-center">
        <p class="title-home">
            <?php echo $this->global_function->show_config_language('lang_how_it_work', $lang) ?>
        </p>
        <ul>
            <?php
            $i=1;
            foreach ($list as $row) { ?>
            <li class="i-work <?php if($i==2) echo 'middle'?>">
                <p class="title"><?php echo $i?>. <?php echo $row->article_name?></p>
                <div class="sum">
                    <?php echo strip_tags($row->article_description) ?>
                </div>
                <?php if ($row->choose_upload == 1) { ?>
                    <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture?>"/>
                <?php } else if ($row->choose_upload == 2) { ?>
                    <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture?>"/>
                <?php } else { ?>
                    <i class="<?php echo $row->picture ?>" ></i>
                <?php } ?>
            </li>
           <?php $i++;}?>
        </ul>
    </div>
</div>