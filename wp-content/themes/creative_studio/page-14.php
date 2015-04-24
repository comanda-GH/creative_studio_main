<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 30.03.15
 * Time: 23:56
 */?>
<?php get_header(); ?>
    <main >
        <?php $title= get_the_title();
        echo '<h1>'.$title.'</h1>';?>
        <div class="wrap">
            <?php
            $date_today_server = date("y.m.d");  // получаем дату сервера
            //query_posts('cat=14');   // указываем ID рубрик, которые необходимо вывести.
            query_posts('post_type=afisha'); // задаем параметры для вывода записей
            if ( have_posts() ) : // если имеются записи в блоге.
                while (have_posts()) : the_post();  // запускаем цикл обхода материалов блога
                    ?>
                       <?php $data = get_post_meta($post->ID, 'data_end_gg_mm_dd', true); // получаем произвольное поле?>
                       <?php $hours = get_post_meta($post->ID, 'hours', true); // получаем произвольное поле?>
                        <?php list($yearpost, $monthpost, $daypost) = explode(".", $data); // преобразуем дату в человечный вид
                        $arrpost = array(1 => "січня", 2 => "лютого", 3 => "березня", 4 => "квітня", 5 => "травня", 6 => "червня", 7 => "липня", 8 => "серпня", 9 => "вересня", 10 => "жовтня", 11 => "листопада", 12 => "грудня"); // преобразуем дату в человечный вид
                        if(preg_match("|^d{2}$|", $yearpost)) $yearpost = "20$yearpost"; // преобразуем дату в человечный вид?>
                        <?php  "$daypost ".$arrpost[intval($monthpost)]." $yearpost"; ?>
                    <ul class="slide">
                        <li><?php the_post_thumbnail(); ?></li>
                        <li><h4><?php the_title();?></h4></li>
                        <li class="data"><?php echo $data.'  '.$hours?></li>
                        <li><?php the_content(); ?></li>
                    </ul>
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

        </div>

    </main>

<?php get_footer(); ?>