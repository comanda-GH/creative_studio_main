<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 16.04.15
 * Time: 22:50
 */ ?>
<?php get_header(); ?>
    <main >
        <?php $title= get_the_title();
        echo '<h1>'.$title.'</h1>';?>
        <div class="wrap">
            <?php
            query_posts('cat=15');   // указываем ID рубрик, которые необходимо вывести.
            if ( have_posts() ) : // если имеются записи в блоге.
                while (have_posts()) : the_post();  // запускаем цикл обхода материалов блога
                    ?>

                    <li>
                        <?php if ( has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php endif;?>
                        <?php the_content(); ?>
                    </li>

                <?php endwhile;  // завершаем цикл.
            endif;
            /* Сбрасываем настройки цикла. Если ниже по коду будет идти еще один цикл, чтобы не было сбоя. */
            wp_reset_query();
            ?>

        </div>

    </main>

<?php get_footer(); ?>