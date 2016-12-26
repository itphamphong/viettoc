<div id="info-user">
    <?PHP $this->load->view("public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_point[$lang] ?></div>
        <div class="form-log" style="width: 95%">
            <?php if(isset($item->id)){?>
            <table  class="t-info">
                <tr>
                    <td><?php echo $l->lang_number_card[$lang]?>: </td>
                    <td><?php echo $item->number_card ?></td>
                </tr>
                <tr>
                    <td><?php echo $l->lang_type_card[$lang]?> </td>
                    <td><?php echo $item->type_card ?></td>
                </tr>
                <tr>
                    <td><?php echo $l->lang_point_begin[$lang]?> </td>
                    <td class="red bold"><?php echo $item->point_begin ?></td>
                </tr>
                <tr>
                    <td><?php echo $l->lang_point_used[$lang]?></td>
                    <td class="red bold"><?php echo $item->point_used ?></td>
                </tr>
                <tr>
                    <td><?php echo $l->lang_point_no_used[$lang]?></td>
                    <td class="red bold"><?php echo $item->point_not_used ?></td>
                </tr>
                <tr>
                    <td><?php echo $l->lang_point_end_date[$lang]?></td>
                    <td class="red bold"><?php echo $item->point_end_date ?></td>
                </tr>



            </table>
            <?php }else{?>
                <p class="red bold" style="width: 100%; text-align: center"><?php echo $l->lang_false_code[$lang]?></p>
            <?php }?>
        </div><!-- form-log-->
    </div><!-- right-col-user-->
</div><!-- info-user-->