<?php

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'iforge');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ';PQA;0?P/|-u]Z2})6>iLjFUraPR[<M6r+DR|sn?pq-tTT{>,uMZPyc7]%dOG^* ');
define('SECURE_AUTH_KEY',  'hN&4tKk0zvC*t+]g^3u_C^km7dQ-SN*bEzsLUoqm5!S{6Su<UCb8+tcfGMz9a!xP');
define('LOGGED_IN_KEY',    'wz06zgV~A)3[W1(%6Jn@ |J_Jc:{m i#HP8~>^6*%KT!@f?bL]-}mfc[S1(n|i_^');
define('NONCE_KEY',        '3W#@OOl}PGX{bf%hD*Q}<#vIyoywl3v.EPl/[CBu[<~*8OoV`R6,VNxhtlMRDf~j');
define('AUTH_SALT',        '&vnT4)N6)q>ymkVI3YVb8x|DITx}O(1|9=(WIw1G5a z[<Gwfq5Y D)TF!k^@?! ');
define('SECURE_AUTH_SALT', ':0oKWILG]OR<JDF9LcfqYJNLPiu*rr8j/*Q;gazlDZ5~*RMCge9)LKaF>w2LE7s5');
define('LOGGED_IN_SALT',   '~=6JF[F-||zDh-*9q|~bD-xXaI`}_`J8CV{?t])A-D$L2o|2CD-i-E@Ki8>d5b#c');
define('NONCE_SALT',       '!p?j?n,cUA|ZS)b* &$Tw`mR7(qtzQ5~9bbi~}5}%-z:MO06j_#q?7dECk~w|suA');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
