<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 16.04.15
 * Time: 23:20
 */ get_header(); ?>

<main >
    <?php $title= get_the_title();
    echo '<h1>'.$title.'</h1>';?>
    <div class="wrap">

    <table>
        <tbody>
        <tr class="day">
            <td class="name"></td>
            <td class="monday">Пн</td>
            <td class="tuesday">Вт</td>
            <td class="wednesday">Ср</td>
            <td class="thursday">Чт</td>
            <td class="friday">Пт</td>
            <td class="saturday">Сб</td>
            <td class="sunday">Вс</td>
        </tr>
        <tr class="vocal">
            <td class="name"><span class="true"></span>Студія вокалу</td>
            <td class="monday true">16:30 - 17:30<br/>17:30 - 18:30</td>
            <td class="tuesday"></td>
            <td class="wednesday true">16:30 - 17:30<br/>17:30 - 18:30</td>
            <td class="thursday"></td>
            <td class="friday"></td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="choreography">
            <td class="name"><span class="true"></span>Студія хореографії</td>
            <td class="monday true">17:00 - 18:00</td>
            <td class="tuesday"></td>
            <td class="wednesday"></td>
            <td class="thursday true">17:00 - 18:00</td>
            <td class="friday"></td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="leading">
            <td class="name"><span class="true"></span>Майстер клас ведучих</td>
            <td class="monday"></td>
            <td class="tuesday"></td>
            <td class="wednesday true">17:00 - 18:00</td>
            <td class="thursday"></td>
            <td class="friday"></td>
            <td class="saturday true">17:00 - 18:00</td>
            <td class="sunday"></td>
        </tr>
        <tr class="art">
            <td class="name"><span class="true"></span>Студія сучасного мистецтва</td>
            <td class="monday"></td>
            <td class="tuesday true">17:00 - 18:00</td>
            <td class="wednesday"></td>
            <td class="thursday"></td>
            <td class="friday true">17:00 - 18:00</td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="actor">
            <td class="name"><span class="true"></span>Студія акторської майстерності</td>
            <td class="monday true">16:30 - 17:30</td>
            <td class="tuesday"></td>
            <td class="wednesday true">16:30 - 17:30</td>
            <td class="thursday"></td>
            <td class="friday"></td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="english">
            <td class="name"><span class="true"></span>Клуб англійської мови</td>
            <td class="monday"></td>
            <td class="tuesday true">17:00 - 18:00</td>
            <td class="wednesday"></td>
            <td class="thursday"></td>
            <td class="friday true">17:00 - 18:00</td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="enlightenment">
            <td class="name"><span class="true"></span>Просвітницькі тренінги</td>
            <td class="monday"></td>
            <td class="tuesday"></td>
            <td class="wednesday"></td>
            <td class="thursday true">17:00 - 18:00</td>
            <td class="friday"></td>
            <td class="saturday"></td>
            <td class="sunday true">17:00 - 18:00</td>
        </tr>
        <tr class="psyho">
            <td class="name"><span class="true"></span>Консультація психолога</td>
            <td class="monday true">17:00 - 18:00</td>
            <td class="tuesday"></td>
            <td class="wednesday"></td>
            <td class="thursday"></td>
            <td class="friday true">17:00 - 18:00</td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        <tr class="step">
            <td class="name"><span class="true"></span>Ранній розвиток “Перші кроки”</td>
            <td class="monday true">17:30 - 18:30</td>
            <td class="tuesday true">17:30 - 18:30</td>
            <td class="wednesday true">17:30 - 18:30</td>
            <td class="thursday"></td>
            <td class="friday"></td>
            <td class="saturday"></td>
            <td class="sunday"></td>
        </tr>
        </tbody>
    </table>
        <!--<ul class="day">
            <li>Студії Студії Студії Студії</li>
            <li>Понеділок</li>
            <li>Вівторок</li>
            <li>Середа</li>
            <li>Четвер</li>
            <li>П'ятниця</li>
            <li>Субота</li>
            <li>Неділя</li>
        </ul>-->

        <?php
        query_posts('post_type=grafic');?>
       <?php global $wpdb?>
        <?php $res=array();?>
        <?php echo "<table border=1>";?>
        <?php if (have_posts()) :?>
            <?php echo "<tr><td></td><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Нд</td></tr>";?>
            <?php echo "";?>
            <?php
            while (have_posts()) : the_post();?>
                <!--<ul>
                    <li>-->
                <?php $myvals=get_post_meta( get_the_ID());?>
                <?php $id=get_the_ID();?>
                <?php $studii=get_post_meta( get_the_ID(), 'select_type', true ); ?>
                <?php $hours=get_post_meta( get_the_ID(), 'hours', true ); ?>
                <?php $val = get_post_meta( get_the_ID(), 'mycheckbox', true );?>
                <?php $week = array(1,2,3,4,5,6,7);?>
                <?php echo '<tr><td>'.$studii.'</td>'; ?>
<?php //foreach ($week as $day)
                foreach($myvals as $key=>$vall)
                $res[]=$vall[0];
               // print_r($res);
                    if ($key==1)
                    {$h1=$vall[0];}elseif ($h1='');
                if ($key==2)
                {$h2=$vall[0];}elseif ($h2='');
                if ($key==3)
                {$h3=$vall[0];}elseif($h3='');
                if ($key==4)
                {$h4=$vall[0];}elseif ($h4='');
                    if ($key==5)
                    {$h5=$vall[0];}elseif($h5='');
                    if ($key==6)
                    {$h6=$vall[0];}elseif ($h6='');
                    if ($key==7)
                    {$h7=$vall[0];}elseif ($h7='');
           /*     $h1 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key =1 and post_id=$id");
                var_dump ($h1);*/
                    echo '<td>'.$h1.'</td><td>'.$h2.'</td><td>'.$h3.'</td><td>'.$h4.'</td><td>'.$h5.'</td><td>'.$h6.'</td><td>'.$h7.'</td>';?>
                <?php
//echo 'd'.$day;
                /*echo 'w'.$week[1];
                    $h1 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key =1");
                $h2 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key =2");
                $h3 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key =3");
                $h4 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE meta_key =4");
             //   var_dump ($h);
                        echo '<td>'.$h1.'</td>';
                return '<td>'.$h2.'</td>';
                echo '<td>'.$h3.'</td>';
                echo '<td>'.$h4.'</td>';
                echo '<td>'.$h5.'</td>';
                echo '<td>'.$h6.'</td>';
                echo '<td>'.$h7.'</td>';*/?>
                <?php
                /*$res=array();
$k=array();

                foreach($myvals as $key=>$vall)
                    if ($key==1or$key==2or$key==3or$key==4or$key==5or$key==6or$key==7 ){
                        //echo 'tt'.$key;
                      echo  $k[]=$key;
                        foreach ($week as $day)
                        foreach ($k as $keys)
                            if ($keys == $day){
                                echo '<td>'.$key.'='.$vall[0].'</td>';
                                break;}
                            else echo "<td>пусто</td> ";*/
               /*{

                   $res[]=$vall[0];

                }*/
                   /* }*/
                /*echo '<td>'.$res[3].'</td>';
                echo '<td>'.$res[4].'</td>';
                echo '<td>'.$res[5].'</td>';
                echo '<td>'.$res[6].'</td>';

                echo "<pre>";
                print_r($res);
                echo "</pre>";*/
                /*    if ($key==1or$key==2or$key==3or$key==4 ){


                                echo '<td>';
                        if ($key == $week[0])echo  $key.'='.$vall[0].'</td>';
                        echo '<td>';
                        if ($key == $week[1])echo  $key.'='.$vall[0].'</td>';

                            else echo "<td>пусто</td> ";}*/
               /* foreach($myvals as $key=>$vall)
                    if ($key==1or$key==2or$key==3or$key==4 ){
                        foreach ($week as $day)
                            if ($key == $day){
                        echo '<td>'.$key.'='.$vall[0].'</td>';
                                break;}
                            else echo "<td>пусто</td> ";
                    }*/?>

                <!--</li>
            </ul>-->
            <?php
            endwhile;?>
            <?php echo '</tr>'?>
            <?php echo "</table>";?>
        <?php  endif;
        wp_reset_query();
        ?>

    </div><!-- #content -->
    </div><!-- #primary -->
</main>

<?php get_footer(); ?>