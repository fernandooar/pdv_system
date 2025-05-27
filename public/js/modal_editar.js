// public/assets/js/dashboard.js

document.addEventListener("DOMContentLoaded", function () {
    // Lógica para o modal de exclusão (já existente)
    document.querySelectorAll(".excluir-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const nome = btn.dataset.nome; // Para o ID do pedido, que você está usando como 'nome'
            document.getElementById("excluir-id-pedido").value = id;
            document.getElementById("pedido-info").textContent = nome;
        });
    });

    // Nova lógica para o modal de edição
    document.querySelectorAll(".editar-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const cliente = btn.dataset.cliente;
            const data = btn.dataset.data;
            const total = btn.dataset.total;
            const status = btn.dataset.status;

            document.getElementById("editar-id-pedido").value = id;
            document.getElementById("editar-cliente").value = cliente;
            document.getElementById("editar-data").value = data;
            document.getElementById("editar-total").value = total;
            document.getElementById("editar-status").value = status;
        });
    });
});