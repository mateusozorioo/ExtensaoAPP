{{-- Logo + Link para o Portal da UniFil --}}
<div class="d-flex align-items-center">
    {{-- Imagem da logo da UniFil, com espaçamento à direita (me-2) --}}
    <img src="{{ asset('images/logoUnifil.png') }}" alt="Logo Unifil" height="40" class="me-2">

    {{-- Link estilizado para abrir o Portal da UniFil em uma nova aba --}}
    <a href="https://portal.unifil.br/" class="fw-bold text-decoration-underline text-primary-emphasis" target="_blank">
        Acesso ao Portal da UniFil.
    </a>
</div>

{{-- Texto de contato por e-mail --}}
<div class="fw-bold text-white">
    Fale conosco:

    {{-- E-mail clicável com sublinhado e popover de "E-mail copiado!" --}}
    <span id="emailText" class="text-decoration-underline text-white"
        style="cursor: pointer; background: none; border: none;" data-bs-toggle="popover" data-bs-placement="top"
        data-bs-content="E-mail copiado!">
        mateus.ozorio@edu.unifil.br
    </span>
</div>

<!-- Inclusão do Bootstrap JS (com Popper.js incluso) via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
//É aqui que o popover vai ser formado e ganhar funcionalidade
//Espera a página carregar completamente.
document.addEventListener('DOMContentLoaded', function() {
    // Criando a constante que vai "disparar" o atributo data-bs-toggle="popover"
    const trigger = document.querySelector('[data-bs-toggle="popover"]');

    // Cria o popover na constante selecionada
    const popover = new bootstrap.Popover(trigger);

    // Evento de clique no e-mail
    trigger.addEventListener('click', () => {
        // Copia o e-mail para a área de transferência
        navigator.clipboard.writeText("mateus.ozorio@edu.unifil.br");

        // Mostra o popover com o texto "E-mail copiado!"
        popover.show();

        // Esconde o popover após 2 segundos
        setTimeout(() => {
            popover.hide();
        }, 2000);
    });
});
</script>