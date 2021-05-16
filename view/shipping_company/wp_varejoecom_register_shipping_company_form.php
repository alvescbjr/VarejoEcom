<div class="container">

    <div class="jumbotron">
        <h1 class="text-center">
            <?= __($titulo, 'wp_varejoecom');?>
        </h1>
    </div>

   <?php include(__DIR__) . '/../../includes/wp_varejoecom_add_message_section.php'; ?>

    <div class="card">

        <div class="card-body">
            <form method="post" action="<?php menu_page_url( 'cadastrar-transportadora' ); ?>">

                <input type="hidden" name="id" value="<?= $data['id']; ?>" />
        
                <label for="wp_varejoecom_shipping_company_identifier" class="font-weight-bold">
                    <?= __('identifier:', 'wp_varejoecom'); ?>
                </label>
                <input type="number" name="wp_varejoecom_shipping_company_identifier" id="wp_varejoecom_shipping_company_identifier" min="1" class="form-control mb-2" value="<?= $data['identifier']; ?>" required/>

                <label for="wp_varejoecom_shipping_company_name" class="font-weight-bold">
                    <?= __('Shipping Company:', 'wp_varejoecom'); ?>
                </label>
                <input type="text" name="wp_varejoecom_shipping_company_name" id="wp_varejoecom_shipping_company_name" class="form-control mb-2" value="<?= $data['name']; ?>" required/>

                <label for="wp_varejoecom_shipping_company_cnpj" class="font-weight-bold">
                    <?= __('CNPJ:', 'wp_varejoecom'); ?>
                </label>
                <input type="text" name="wp_varejoecom_shipping_company_cnpj" id="wp_varejoecom_shipping_company_cnpj" class="form-control mb-2" value="<?= $data['cnpj']; ?>" pattern="\d{2}.?\d{3}.?\d{3}/?\d{4}-?\d{2}" required/>

                <label for="wp_varejoecom_shipping_company_status" class="font-weight-bold">
                    <?= __('Status:', 'wp_varejoecom'); ?>
                </label>
                <select name="wp_varejoecom_shipping_company_status" id="wp_varejoecom_shipping_company_status" class="form-control" required>
                    <?php
                        $options = ['active', 'disabled'];

                        if (empty($data['status'])) :?>
                            <option disabled="disabled" selected="selected">Escolha uma opção</option>
                        <?php endif;?>

                        <?php foreach ($options as $opt) : ?>
                            <option <?= ($data['status'] === $opt ? 'selected="selected"' : '') ?> value="<?= $opt; ?>"> <?= __($opt, 'wp_varejoecom'); ?> </option>
                    <?php endforeach; ?>
                </select>

                <?php 
                    submit_button();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
    wp_footer();
?>