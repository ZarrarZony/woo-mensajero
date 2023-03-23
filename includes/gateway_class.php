<?php
class DemoGateway extends WC_Payment_Gateway {
    public $demo_id = 'woo_demo';

    function __construct() {
          //code removed  
    }

    public function demo_register_gateway( $methods )
    {
        $methods[] = 'DemoGateway';
        return $methods;
    }

    public function init_form_fields(){

        $this->form_fields = array(
            'enabled' => array(
                'title'         => __('Enable/Disable:', $this->demo_id),
                'type'          => 'checkbox',
                'label'         => __('Pay By demo', $this->demo_id),
                'default'       => 'no',
                'description'   => 'Show in the Payment List as a payment option'
            ),
            'title' => array(
                'title'         => __('Title:', $this->demo_id),
                'type'          => 'text',
                'default'       => __('demo', $this->demo_id),
                'description'   => __('This controls the title which the user sees during checkout.', $this->demo_id),
                'desc_tip'      => true
            ),
        );

    }

    public function payment_fields() { ?>
    <section>
    <br>
      <div class="ww-form-row">
        <div class="ww-form-col">
          <label class="ww-label">
            <?= __( 'Seleccione una opción', $this->demo_id ); ?>
          </label>
          <div class="ww-form-holder">
            <select id="woo_demo" name="woo_demo" class="ww-form-control">
                <option value=""></option>
                <option value="Visa, Mastercard, American Express">Visa, Mastercard, American Express</option>
                <option value="Tasa 0 3 meses CREDOMATIC">Tasa 0 3 meses CREDOMATIC</option>
                <option value="Mini Cuotas CREDOMATIC">Mini Cuotas CREDOMATIC</option>
                <option value="CREDIX 6 meses sin interés">CREDIX 6 meses sin interés</option>
                <option value="CREDIX 24 cuotas financiadas">CREDIX 24 cuotas financiadas</option>
            </select>
            </div>
        </div>
      </div>
    </section>
    <script type="text/javascript">
        jQuery(function($){
             $('#place_order').click(function(event) {
                 if(jQuery('#payment_method_woo_demo').is(':checked')) {
                    var option = $('#woo_demo').val();
                    if(!option){
                        event.preventDefault();
                        alert('Seleccione la opción de pago');
                    }
                 }
             });
         });
    </script>
    <?php }

    public function process_payment($order_id){
        //code removed  
    }
}