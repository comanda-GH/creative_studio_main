<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 16.04.15
 * Time: 9:40
 */ ?>
<?php get_header(); ?>
<main class="conta">
    <?php $title= get_the_title();
    echo '<h1>'.$title.'</h1>';?>
    <div class="wrap">
        <ul class="cont_wrapp">
            <li class="adress_wrapp">
                <ul class="cont">
                    <li class="address">
                        <dl>
                            <dt>
                                Адреса:
                            </dt>
                            <dd>
                                м.Черкаси, вул. Смілянська, 100
                            </dd>
                        </dl>
                    </li>
                    <li class="email">
                        <dl>
                            <dt>
                                e-mail:
                            </dt>
                            <dd>
                                youth-organization@mail.com
                            </dd>
                        </dl>
                    </li>
                </ul>
            </li>
            <li class="phone_wrapp">
                <ul class="phon">
                    <li class="mobile">
                        <p>067-389-25-51</p>
                    </li>
                    <li class="phone">
                        <p>0472-63-64-24</p>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
    <img class="map" src="<?php bloginfo('template_url')?>/images/map.jpg">
</main>
<?php get_footer(); ?>