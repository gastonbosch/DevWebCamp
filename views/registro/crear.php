<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete_nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripcion Gratis">
            </form>
        </div>
        <div class="paquete">
            <h3 class="paquete_nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del evento</li>
                <li class="paquete__elemento">Comidas y bebidas</li>
            </ul>
            <p class="paquete__precio">$199</p>
            <div id="smart-button-container">
                <div style="text-align: center;">
                <form method="POST" action="/finalizar-registro/presencial">
                  <input class="paquetes__submit" type="submit" value="Inscripcion Presencial">
                </form>
                    <!--<div id="paypal-button-container">Comprar</div>-->
                </div>
            </div>
        </div>
        <div class="paquete">
            <h3 class="paquete_nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>
            <div id="smart-button-container">
                <div style="text-align: center;">
                <form method="POST" action="/finalizar-registro/virtual">
                  <input class="paquetes__submit" type="submit" value="Inscripcion Virtual">
                </form>
                    <!--<div id="paypal-button-container-virtual">Comprar</div>-->
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<!--<script src="https://www.paypal.com/sdk/js?client-id=AZn4aJmwb_yxH7skU_Sm_uKpCqnGF6pG8qTA2ethWW3vsanDHF8Q_tNt_pbmT54bZV8UqVaTdSDi5FZF&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>-->
 
<script>
    /*function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            //console.log(orderData);
            //return;
            const datos = new FormData();
            datos.append('paquete_id',orderData.purchase_units[0].description);
            datos.append('pago_id',orderData.purchase_units[0].payments.captures[0].id);

            
            fetch('/finalizar-registro/pagar',{  
              method:'POST',
              body: datos
            })
            .then(respuesta => respuesta.json())
            .then(resultado => {
                if(resultado.resultado){
                  const url = window.location.href + '/conferencias';
                  actions.redirect(url);
                }
            });
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');

      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            //console.log(orderData);
            //return;
            const datos = new FormData();
            datos.append('paquete_id',orderData.purchase_units[0].description);
            datos.append('pago_id',orderData.purchase_units[0].payments.captures[0].id);

            
              fetch('/finalizar-registro/pagar',{  
                method:'POST',
                body: datos
            })
            .then(respuesta => respuesta.json())
            .then(resultado => {
                if(resultado.resultado){
                  const url = window.location.href + '/conferencias';
                  actions.redirect(url);
                }
            });
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-virtual');
    }
 
  initPayPalButton();*/
</script>
