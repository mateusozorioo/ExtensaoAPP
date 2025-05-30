{{-- Logo +Link Portal --}}
<div class="d-flex align-items-center">
    <img src="{{ asset('images/logoUnifil.png') }}" alt="Logo Unifil" height="40" class="me-2">
    <a href="https://portal.unifil.br/" class="fw-bold text-decoration-underline text-primary-emphasis" target="_blank">
        Acesso ao Portal da UniFil.
    </a>
</div>

{{-- Contato por e-mail--}}
<div class="fw-bold text-white">
    Fale conosco:
    <span id="emailText" class="text-decoration-underline text-white"
        style="cursor: pointer; background: none; border: none;" data-bs-toggle="popover" data-bs-placement="bottom"
        data-bs-content="E-mail copiado!">
        mateus.ozorio@edu.unifil.br
    </span>
</div>

<!-- Bootstrap JS (inclui Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.querySelector('[data-bs-toggle="popover"]');
    const popover = new bootstrap.Popover(trigger);

    trigger.addEventListener('click', () => {
        navigator.clipboard.writeText("mateus.ozorio@edu.unifil.br");
        popover.show();

        setTimeout(() => {
            popover.hide();
        }, 2000); // Fecha após 2 segundos
    });
});
</script>