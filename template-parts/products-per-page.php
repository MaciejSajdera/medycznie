<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<form class="vg-sort-show" method="get">
    <label>Pokaż:
        <select id="products-per-page" name="show" class="show" aria-label="<?php esc_attr_e('Pokaż', 'woocommerce'); ?>">
            <option value="24" <?php selected(get_query_var('show'), 24) ?> <?php selected(get_query_var('show'), ''); ?>>24</option>
            <option value="48" <?php selected(get_query_var('show'), 48) ?>>48</option>
            <option value="72" <?php selected(get_query_var('show'), 72) ?>>72</option>
            <option value="-1" <?php selected(get_query_var('show'), -1) ?>>All</option>
        </select>
    </label>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, array('show', 'submit', 'paged', 'product-page')); ?>
</form>