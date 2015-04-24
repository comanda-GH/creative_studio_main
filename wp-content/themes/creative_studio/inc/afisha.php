<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 19.04.15
 * Time: 17:23
 */ ?>
<?php
add_action( 'init', 'true_register_afisha' ); // Использовать функцию только внутри хука init

function true_register_afisha() {
    $labels = array(
        'name' => 'Афіші',
        'singular_name' => 'Афіші', // админ панель Добавить->Функцию
        'add_new' => 'Добавити афішу',
        'add_new_item' => 'Добавити афішу', // заголовок тега <title>
        'edit_item' => 'Редагувати афішу',
        'new_item' => 'Нова афіша',
        'all_items' => 'Всі афіші',
        'view_item' => 'Пререгляд афіш на сайте',
        'search_items' => 'Шукати афішу',
        'not_found' =>  'Афіші не знайдено.',
        'not_found_in_trash' => 'В кошику нема афіш.',
        'menu_name' => 'Афіші' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true, // благодаря этому некоторые параметры можно пропустить
        'menu_icon' => 'dashicons-exerpt-view', // иконка
        'menu_position' => 5,
        'has_archive' => true,
         'supports' => array( 'title', 'editor','thumbnail'),
        'taxonomies' => array('post_tag')
    );
    register_post_type('afisha',$args);
}
// Добавляем дополнительное поле
function afisha_meta_box() {
    add_meta_box(
        'afisha_meta_box', // Идентификатор(id)
        'Afisha Meta Box', // Заголовок области с мета-полями(title)
        'show_afisha_metabox', // Вызов(callback)
        'afisha', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal',
        'high');
}
add_action('add_meta_boxes', 'afisha_meta_box'); // Запускаем функцию
//Опишем в массиве требуемые нам поля
$afisha_meta_fields = array(
    array(
        'label' => 'Дата',
        'desc'  => '',
        'id'    => 'data_end_gg_mm_dd', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(
        'label' => 'Час',
        'desc'  => '',
        'id'    => 'hours', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )
);
function show_afisha_metabox()
{
    global $afisha_meta_fields; // Обозначим наш массив с полями глобальным
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';
// Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';
    foreach ($afisha_meta_fields as $field) {
        // Получаем значение если оно есть для этого поля
        $meta = get_post_meta($post->ID, $field['id'], true);
        // Начинаем выводить таблицу
        echo '<tr>
                <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
                <td>';
        switch ($field['type']) {
            // Текстовое поле
            case 'checkbox_group':
                foreach ($field['options'] as $option) {
                    echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
            <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
                }
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
function save_my_afisha_meta_fields($post_id) {
    global $afisha_meta_fields;  // Массив с нашими полями

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
    foreach ($afisha_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }
    } // end foreach
}
add_action('save_post', 'save_my_afisha_meta_fields'); // Запускаем функцию сохранения
?>