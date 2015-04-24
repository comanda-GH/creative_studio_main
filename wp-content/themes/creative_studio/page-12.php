<?php
/*
Template Name: Новини
*/

/**
 * Created by PhpStorm.
 * User: rb
 * Date: 28.03.15
 * Time: 10:54
 */?>
<?php get_header(); ?>
    <main >
        <?php $title= get_the_title();
        echo '<h1>'.$title.'</h1>';?>
        <div class="wrap">
        <ul class="listnews">

            <?php if (have_posts()) : // если имеются записи в блоге.?>
                <?php
                $limit = get_option('posts_per_page');
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                query_posts('cat=11&showposts=' . $limit=3 . '&paged=' . $paged);
                ?>
            <?php    while (have_posts()) : the_post();
                    ?>
						<li>
							<span class="date">
								<?php the_date('d F Y'); ?>
							</span>
							<h3>
								<?php the_title(); ?>
							</h3>
							<p>
								<?php the_content(); ?>
							</p>
						</li>
			<?php endwhile;  // завершаем цикл.?>
                <?php the_posts_pagination( array(
                    'end_size'     => 1,     // количество страниц на концах
                    'mid_size'     => 1,     // количество страниц вокруг текущей
                    'prev_next'    => True,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                    'prev_text'    => __('<'),
                    'next_text'    => __('>'),
                ) );?>
            <?php endif;
            /* Сбрасываем настройки цикла. Если ниже по коду будет идти еще один цикл, чтобы не было сбоя. */
            wp_reset_query();
            ?>

        </ul>

    </div>

</main>

<?php get_footer(); ?>