<div class="container">

    <div class="jumbotron">
        <h1 class="text-center"><?= __($titulo, 'wp_varejoecom');?></h1>
    </div>

   <?php include(__DIR__) . '/../../includes/wp_varejoecom_add_message_section.php'; ?>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><?= __('Id', 'wp_varejoecom'); ?></th>
                        <th scope="col"><?= __('Shipping Name', 'wp_varejoecom'); ?></th>
                        <th scope="col"><?= __('CNPJ', 'wp_varejoecom'); ?></th>
                        <th scope="col"><?= __('Status', 'wp_varejoecom'); ?></th>
                        <th scope="col"><?= __('Change', 'wp_varejoecom'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($companies as $shipping_company) : ?>
                    <?php $query_args = array( 'page' => 'cadastrar-transportadora', 'id' => $shipping_company['identifier'] ); ?>
                        <tr>
                            <td><?= $shipping_company['identifier']; ?></th>
                            <td><?= $shipping_company['name']; ?></td>
                            <td><?= $shipping_company['cnpj']; ?></td>
                            <td><?= __($shipping_company['status'], 'wp_varejoecom'); ?></td>
                            <td>
                                <a href="<?= add_query_arg($query_args, admin_url('/admin.php'));?>" title="<?=__('Change', 'wp_varejoecom'); ?> <?=$shipping_company['name'];?>" class="btn btn-warning">
                                    <?=__('Change', 'wp_varejoecom'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
    include __DIR__ . '/../../includes/wp_varejoecom_destroys_messaging_session.php';
