// JavaScript para cadastro de instituição
document.addEventListener('DOMContentLoaded', function() {
    const instituicaoForm = document.getElementById('instituicaoForm');
    
    // Máscaras para os campos
    function aplicarMascaras() {
        const cnpjInput = document.getElementById('cnpj');
        const telefoneInput = document.getElementById('telefone');
        const cepInput = document.getElementById('cep');
        
        // Máscara CNPJ
        cnpjInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1/$2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
            value = value.replace(/(-\d{2})\d+?$/, '$1');
            e.target.value = value;
        });
        
        // Máscara Telefone
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = value;
        });
        
        // Máscara CEP
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });
    }
    
    // Buscar endereço pelo CEP
    function buscarEnderecoPorCEP() {
        const cepInput = document.getElementById('cep');
        const cidadeInput = document.getElementById('cidade');
        const estadoInput = document.getElementById('estado');
        const enderecoInput = document.getElementById('endereco');
        
        cepInput.addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            cidadeInput.value = data.localidade;
                            estadoInput.value = data.uf;
                            if (data.logradouro) {
                                enderecoInput.value = data.logradouro;
                            }
                        }
                    })
                    .catch(error => {
                        console.log('Erro ao buscar CEP:', error);
                    });
            }
        });
    }
    
    // Validação do formulário
    instituicaoForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(instituicaoForm);
        const data = Object.fromEntries(formData);
        
        // Validações básicas
        if (!validarCNPJ(data.cnpj)) {
            alert('CNPJ inválido!');
            return;
        }
        
        if (!validarEmail(data.email)) {
            alert('Email inválido!');
            return;
        }
        
        if (data.senha.length < 6) {
            alert('A senha deve ter pelo menos 6 caracteres!');
            return;
        }
        
        // Simular envio
        console.log('Dados da instituição:', data);
        alert('Cadastro da instituição realizado com sucesso!');
        window.location.href = 'login.html';
    });
    
    // Aplicar máscaras e funcionalidades
    aplicarMascaras();
    buscarEnderecoPorCEP();
    
    // Função para validar CNPJ
    function validarCNPJ(cnpj) {
        cnpj = cnpj.replace(/[^\d]+/g, '');
        
        if (cnpj == '') return false;
        
        if (cnpj.length != 14)
            return false;
        
        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" || 
            cnpj == "11111111111111" || 
            cnpj == "22222222222222" || 
            cnpj == "33333333333333" || 
            cnpj == "44444444444444" || 
            cnpj == "55555555555555" || 
            cnpj == "66666666666666" || 
            cnpj == "77777777777777" || 
            cnpj == "88888888888888" || 
            cnpj == "99999999999999")
            return false;
        
        // Valida DVs
        let tamanho = cnpj.length - 2;
        let numeros = cnpj.substring(0, tamanho);
        let digitos = cnpj.substring(tamanho);
        let soma = 0;
        let pos = tamanho - 7;
        
        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        
        let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        
        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        
        return true;
    }
    
    // Função para validar email
    function validarEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});