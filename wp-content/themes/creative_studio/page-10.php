<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 24.04.15
 * Time: 21:13
 */?>
<?php get_header()?>
<!-- header -->
<?php $title= get_the_title();
echo '<h1>'.$title.'</h1>';?>
<main>



            <?php
            the_post();
            the_content();
            ?>



</main>
<!--footer-->
<?php get_footer();?>
