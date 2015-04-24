<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 16.04.15
 * Time: 10:02
 */
get_header(); ?>
<main>
<?php $title= get_the_title();
echo '<h1>'.$title.'</h1>';?>
    <div class="wrap">
        <?php query_posts('cat=12');?>

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>


        <?php else : ?>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>