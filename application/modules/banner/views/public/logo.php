<section id="partner">
    <h3><?php echo $l->lang_partner_links[$lang]?></h3>

    <div class="bg-partner">
        <div class="row">
            <div class="twelve">
                <ul id="owl-demo" class="owl-carousel owl-demo">
                    <?php
                    $x=1;
                    foreach($banner as $b){
                    $content=strip_tags($b->images_summary);
                    ?>
                    <li class="owl-item">
                        <div class="item">
                        <img class="lazyOwl" src="<?php echo base_url()?>uploads/quang-cao/<?php echo $b->name?>" alt="<?php echo $b->images_name?>">
                        </div>
                    </li>
                  <?php }?>
                </ul>
            </div>
        </div>
    </div>
</section>