/**
 * cajero/ventas-create.js
 *
 * Lógica del punto de venta (POS) — Vista: cajero/ventas/create.blade.php
 *
 * Responsabilidades:
 *  - Incrementar/decrementar la cantidad de cada producto (respetando stock máximo).
 *  - Recalcular el total de la venta en tiempo real.
 *  - Actualizar el input oculto #input-total que se envía al backend.
 *  - Disparar el evento personalizado 'total-actualizado' para que Alpine.js
 *    actualice la variable `totalVenta` del formulario principal.
 */
document.addEventListener('DOMContentLoaded', function () {
    const tarjetas     = document.querySelectorAll('.producto-card');
    const displayTotal = document.getElementById('display-total-inferior');
    const inputTotal   = document.getElementById('input-total');

    // Variable global accesible también por Alpine.js vía evento
    window.totalVenta = 0;

    function recalcularTotal() {
        let granTotal = 0;

        tarjetas.forEach(tarjeta => {
            // Precio vigente desde data-precio (seteado en el Blade desde precioActual)
            const precio   = parseFloat(tarjeta.getAttribute('data-precio')) || 0;
            const cantidad = parseInt(tarjeta.querySelector('.input-cantidad').value) || 0;
            granTotal += (precio * cantidad);
        });

        // Actualizar display visual
        displayTotal.innerText = '$' + granTotal.toFixed(2);

        // Actualizar input oculto que se enviará al backend
        inputTotal.value = granTotal.toFixed(2);

        // Actualizar variable global y disparar evento para Alpine
        window.totalVenta = granTotal;
        window.dispatchEvent(new CustomEvent('total-actualizado', { detail: granTotal }));
    }

    tarjetas.forEach(tarjeta => {
        const btnSumar      = tarjeta.querySelector('.btn-sumar');
        const btnRestar     = tarjeta.querySelector('.btn-restar');
        const inputCantidad = tarjeta.querySelector('.input-cantidad');
        const maxStock      = parseInt(inputCantidad.getAttribute('max')) || 0;

        btnSumar.addEventListener('click', () => {
            let cantActual = parseInt(inputCantidad.value);
            if (cantActual < maxStock) {
                inputCantidad.value = cantActual + 1;
                recalcularTotal();
            }
        });

        btnRestar.addEventListener('click', () => {
            let cantActual = parseInt(inputCantidad.value);
            if (cantActual > 0) {
                inputCantidad.value = cantActual - 1;
                recalcularTotal();
            }
        });
    });
});
