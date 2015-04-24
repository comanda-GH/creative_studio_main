<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 18.04.15
 * Time: 15:32
 */ ?>
<?php
add_action( 'init', 'true_register_grafic' ); // Использовать функцию только внутри хука init

function true_register_grafic() {
    $labels = array(
        'name' => 'Розклад',
        'singular_name' => 'Розклад', // админ панель Добавить->Функцию
        'add_new' => 'Добавити розклад',
        'add_new_item' => 'Добавити розклад', // заголовок тега <title>
        'edit_item' => 'Редагувати розклад',
        'new_item' => 'Новий розклад',
        'all_items' => 'Весь розклад',
        'view_item' => 'Пререгляд розкладу на сайте',
        'search_items' => 'Шукати розклад',
        'not_found' =>  'Розклад не знайдено.',
        'not_found_in_trash' => 'В кошику нема розкладу.',
        'menu_name' => 'Розклад' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true, // благодаря этому некоторые параметры можно пропустить
        'menu_icon' => 'dashicons-calendar-alt', // иконка
        'menu_position' => 5,
        'has_archive' => true,
       // 'supports' => array( 'title', 'editor'),
        'taxonomies' => array('post_tag')
    );
    register_post_type('grafic',$args);
}
// Добавляем дополнительное поле
function grafic_meta_box() {
    add_meta_box(
        'grafic_meta_box', // Идентификатор(id)
        'Grafic Meta Box', // Заголовок области с мета-полями(title)
        'show_grafic_metabox', // Вызов(callback)
        'grafic', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal',
        'high');
}
add_action('add_meta_boxes', 'grafic_meta_box'); // Запускаем функцию
//Опишем в массиве требуемые нам поля
$red_meta_fields = array(
    array(
        'label' => 'Студії',
        'desc'  => 'Оберіть студію.',
        'id'    => 'select_type',
        'type'  => 'select',
        'options' => array (  // Параметры, всплывающие данные
            '1' => array (
                'label' => 'Ранній розвиток “Перші кроки”',  // Название поля
                'value' => 'Ранній розвиток “Перші кроки”'  // Значение
            ),
            '2' => array (
                'label' => 'Консультація психолога',  // Название поля
                'value' => 'Консультація психолога'  // Значение
            ),
            '3' => array (
                'label' => 'Просвітницькі тренінги',  // Название поля
                'value' => 'Просвітницькі тренінги'  // Значение
            ),
            '4' => array (
                'label' => 'Студія хореографії',  // Название поля
                'value' => 'Студія хореографії'  // Значение
            )
        )
    ),
    array(
        'label' => 'День тижня',
        'desc'  => 'Оберіть день тижня.',
        'id'    => 'mycheckbox',  // даем идентификатор.
        'type'  => 'checkbox_group',
        'options' => array (
            '1' => array (
                'label' => 'Понеділок',
                'value' => '1'
            ),
            '2' => array (
                'label' => 'Вівторок',
                'value' => '2'
            ),
            '3' => array (
                'label' => 'Середа',
                'value' => '3'
            ),

            '4' => array (
                'label' => 'Четвер',
                'value' => '4'
            ),
            '5' => array (
                'label' => "П'ятниця",
                'value' => '5'
            ),
            '6' => array (
                'label' => 'Субота',
                'value' => '6'
            ),
            '7' => array (
                'label' => 'Неділя',
                'value' => '7'
            ),
        )
    ),
    array(
        'label' => 'Пн',
        'desc'  => '',
        'id'    => '1', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Вт',
        'desc'  => '',
        'id'    => '2', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Ср',
        'desc'  => '',
        'id'    => '3', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Пн',
        'desc'  => '',
        'id'    => '4', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Вт',
        'desc'  => '',
        'id'    => '5', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Ср',
        'desc'  => '',
        'id'    => '6', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
);
function show_grafic_metabox()
{
    global $red_meta_fields; // Обозначим наш массив с полями глобальным
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';
// Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';
    foreach ($red_meta_fields as $field) {
        // Получаем значение если оно есть для этого поля
        $meta = get_post_meta($post->ID, $field['id'], true);
        // Начинаем выводить таблицу
        echo '<tr>
                <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
                <td>';
        switch ($field['id']) {
            // Текстовое поле
            /*case 'checkbox_group':
                foreach ($field['options'] as $option) {
                    echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
            <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
                }
                break;*/
            case '1':

                echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
					        <br /><span class="description">' . $field['desc'] . '</span>';
                break;
            case 'text':

                echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
					        <br /><span class="description">' . $field['desc'] . '</span>';
                break;
            // Список
            case 'select':
                echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
                }
                echo '</select><br /><span class="description">' . $field['desc'] . '</span>';
                break;
        }
        echo '</td></tr>';
    }
    echo '</table>';
}
// Пишем функцию для сохранения
function save_my_red_meta_fields($post_id) {
    global $red_meta_fields;  // Массив с нашими полями

    // проверяем наш проверочный код
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // Проверяем авто-сохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // Проверяем права доступа
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Если все отлично, прогоняем массив через foreach
    foreach ($red_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }
    } // end foreach
}
add_action('save_post', 'save_my_red_meta_fields'); // Запускаем функцию сохранения
?>