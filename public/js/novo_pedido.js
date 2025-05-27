// Autocompletar cliente
/**
 * O objeto de resposta retornado pela Fetch API após requisitar os dados do cliente do servidor.
 * @type {Response}
 * @property {string} q - O valor de pesquisa do cliente.
 * @returns {Promise<Array<{id: number, nome: string}>>} - Uma promessa que resolve para um array de objetos de cliente.
 */
const clienteInput = document.getElementById('cliente');
clienteInput.addEventListener('input', async function () {
    const valor = clienteInput.value;
    if (valor.length < 2) return;
    const res = await fetch(`../controllers/buscar_cliente.php?q=${valor}`);
    const usuarios = await res.json();

    const lista = document.getElementById('lista-clientes');
    lista.innerHTML = '';
    usuarios.forEach(usuario => {
        const item = document.createElement('div');
        item.classList.add('list-group-item');
        item.textContent = usuario.nome;
        item.onclick = () => {
            clienteInput.value = usuario.nome;
            document.getElementById('id_usuario').value = usuario.id;
            lista.innerHTML = '';
        };
        lista.appendChild(item);
    });
});

/**
 * O objeto de resposta retornado pela Fetch API após requisitar os dados do produto do servidor.
 * 
 * @type {Response}
 * @property {string} q - O valor de pesquisa do produto.
 * @returns {Promise<Array<{id: number, nome: string, preco: number}>>} - Uma promessa que resolve para um array de objetos de produto.
 */
// Delegar eventos para autocompletar produtos
document.addEventListener('input', async function (e) {
    if (e.target.classList.contains('nome-produto')) {
        const valor = e.target.value;
        const lista = e.target.nextElementSibling.nextElementSibling;
        if (valor.length < 2) return;
        const res = await fetch(`../controllers/buscar_produto.php?q=${valor}`);
        const produtos = await res.json();
        lista.innerHTML = '';
        produtos.forEach(prod => {
            const item = document.createElement('div');
            item.classList.add('list-group-item');
            item.textContent = `${prod.nome} - R$ ${parseFloat(prod.preco).toFixed(2)}`;
            item.onclick = () => {
                e.target.value = prod.nome;
                e.target.parentElement.querySelector('.id-produto').value = prod.id;
                e.target.parentElement.parentElement.querySelector('.preco').value = prod.preco;
                lista.innerHTML = '';
                calcularTotal();
            };
            lista.appendChild(item);
        });
    }

    if (e.target.classList.contains('quantidade')) {
        calcularTotal();
    }
});

// Adicionar produto
/**
 * Adiciona dinamicamente uma nova linha de produto ao DOM dentro do elemento com ID 'produtos-wrapper'.
 * Cada linha inclui campos para nome do produto (com autocomplete), quantidade e preço.
 * A função atribui automaticamente um índice à nova linha de produto e atualiza o DOM.
 */
function addProduto() {
    const wrapper = document.getElementById('produtos-wrapper');
    const index = document.querySelectorAll('.produto-item').length;

    const div = document.createElement('div');
    div.classList.add('row', 'g-2', 'mb-2', 'produto-item');
    div.innerHTML = `
        <div class="col-5 position-relative">
            <input type="text" class="form-control nome-produto" placeholder="Produto" data-index="${index}" autocomplete="off">
            <input type="hidden" name="produtos[]" class="id-produto">
            <div class="lista-produto list-group" style="position:absolute; z-index:10;"></div>
        </div>
        <div class="col-3">
            <input type="number" name="quantidades[]" class="form-control quantidade" placeholder="Qtd" value="1" min="1">
        </div>
        <div class="col-3">
            <input type="text" class="form-control preco" placeholder="Preço" readonly>
        </div>
    `;
    wrapper.appendChild(div);
}



// Calcular total
/**
 * Calcula o preço total de todos os produtos listados no DOM.
 * Percorre os elementos com a classe 'produto-item', obtém a quantidade e o preço
 * de seus respectivos campos de input e soma o total.
 * O resultado é definido como valor do input com o id 'total', formatado com duas casas decimais.
 */
function calcularTotal() {
    let total = 0;
    document.querySelectorAll('.produto-item').forEach(item => {
        const qtd = parseInt(item.querySelector('.quantidade').value);
        const preco = parseFloat(item.querySelector('.preco').value);
        if (!isNaN(qtd) && !isNaN(preco)) {
            total += qtd * preco;
        }
    });
    document.getElementById('total').value = total.toFixed(2);
}
