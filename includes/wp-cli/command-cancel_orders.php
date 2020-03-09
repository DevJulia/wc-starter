<?php

function command_cancel_orders()
{
    $now = new \DateTime();

    $orders = wc_get_orders([
        'status'         => ['wait_pay_bank', 'wait_pay_estimate'],
        'posts_per_page' => -1,
    ]);

    $progress = \WP_CLI\Utils\make_progress_bar('Cancel orders', count($orders));

    $count = 0;

    if ($orders) {
        foreach ($orders as $order) {
            $notes = wc_get_order_notes(['order_id' => $order->get_id()]);

            foreach ($notes as $note) {
                if (strpos($note->content, 'Order status set to') !== false || strpos($note->content, 'Order status changed from') !== false || strpos($note->content, 'État de la commande modifié') !== false) {
                    $date_status = $note->date_created;

                    $interval = $date_status->diff($now);

                    $days = $interval->days;

                    if ($days >= 7) {
                        $order_lang = pll_get_post_language($order->get_id());
                        PLL()->curlang = PLL()->model->get_language( $order_lang );

                        $order->set_status('cancelled');
                        $order->save();

                        $count++;
                    }

                    break;
                }
            }

            $progress->tick();
        }
    }

    $progress->finish();

    WP_CLI::success($count . ' commande(s) passée(s) au statut Annulée');

    update_option('cron_cancel_orders', ['date' => $now->format('Y-m-d H:i:s'), 'count' => $count]);
}