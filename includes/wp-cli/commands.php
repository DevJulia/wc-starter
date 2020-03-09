<?php

include 'command-cancel_orders.php';

if (class_exists('WP_CLI')) {
    $_SERVER['SERVER_NAME'] = 'UNKNOW';

    WP_CLI::add_command('cancel-orders', 'command_cancel_orders');
}