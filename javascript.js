// File: javascript.js

// Abrir e fechar o modal de cadastro
const abrirModalCadastro = document.getElementById('abrirModalCadastro');
const fecharModalCadastro = document.getElementById('fecharModalCadastro');
const modalForm = document.getElementById('modalForm');

if (abrirModalCadastro && modalForm) {
    abrirModalCadastro.onclick = function() {
        modalForm.style.display = 'flex';
    };
}
if (fecharModalCadastro && modalForm) {
    fecharModalCadastro.onclick = function() {
        modalForm.style.display = 'none';
    };
}
if (modalForm) {
    modalForm.onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    }
}

// Fecha o modal ao pressionar a tecla ESC de cadastro
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalForm.style.display === 'flex') {
        modalForm.style.display = 'none';
    }
});

// Abrir modal de edição
document.querySelectorAll('.abrirModalEdicao').forEach(function(btn) {
    btn.onclick = function() {
        document.getElementById('modalEdit').style.display = 'flex';
        document.getElementById('edit_id').value = btn.getAttribute('data-id');
        document.getElementById('edit_patrimonio').value = btn.getAttribute('data-patrimonio');
        document.getElementById('edit_usuario').value = btn.getAttribute('data-usuario');
        document.getElementById('edit_setor').value = btn.getAttribute('data-setor');
        document.getElementById('edit_marca').value = btn.getAttribute('data-marca');
        document.getElementById('edit_modelo').value = btn.getAttribute('data-modelo');
    }
});
const fecharModalEdicao = document.getElementById('fecharModalEdicao');
const modalEdit = document.getElementById('modalEdit');
if (fecharModalEdicao && modalEdit) {
    fecharModalEdicao.onclick = function() {
        modalEdit.style.display = 'none';
    };
    modalEdit.onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modalEdit.style.display === 'flex') {
            modalEdit.style.display = 'none';
        }
    });
}