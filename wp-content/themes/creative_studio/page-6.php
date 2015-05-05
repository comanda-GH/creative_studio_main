<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 16.04.15
 * Time: 12:47
 */
get_header(); ?>
    <main >
        <?php $title= get_the_title();
        echo '<h1>'.$title.'</h1>';?>
        <div class="wrap">


            <ul class="project-list">
                <?php
                the_post();
                the_content();
                ?>
                <?php query_posts('cat=13');?>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <li class="box<?php if( $count%2 == 0 ) { echo '-1'; }; $count++; ?>">
                    <!--<div <?php /*post_class(); */?> id="post-<?php /*the_id();*/?>">-->

                    <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>

                    <!--</div>-->
                </li>



                <?php endwhile; ?>


            <?php else : ?>
            <?php endif; ?>
                </ul>
        </div>
    </main>
<?php get_footer(); ?>