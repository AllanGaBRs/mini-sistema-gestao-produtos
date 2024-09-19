function deleta(event, codProd) {
    event.preventDefault();
    
    if (confirm("Tem certeza que deseja excluir o produto?")) {
        fetch('deletar_produto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ codProd: codProd })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = document.getElementById('row-' + codProd);
                if (row) {
                    row.remove();
                }

                const tableBody = document.querySelector('table tbody');
                if (tableBody && tableBody.rows.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Nenhum produto encontrado.</td></tr>';
                }
            } else {
                alert("Erro ao excluir o produto.");
            }
        })
        .catch(error => console.error('Erro:', error));
    }
}




function edita(event, codProd) { 
    event.preventDefault();

    let novoNome = prompt("Digite o novo nome do produto:");

    if (novoNome) {
        fetch('editar_produto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ codProd: codProd, newName: novoNome })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = document.getElementById('row-' + codProd);
                if (row) {
                    const nameCell = row.querySelector('.product-name');
                    if (nameCell) {
                        nameCell.textContent = novoNome;
                    }
                }
            } else {
                alert("Erro ao editar o produto.");
            }
        })
        .catch(error => console.error('Erro:', error));
    }
}
