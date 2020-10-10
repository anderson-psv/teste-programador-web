
/* Mascara para CEP */
function format_cep(elm)
{   
    elm.value = elm.value.replace(/D/g,"").replace(/^(\d{5})(\d)/,"$1-$2").substring(0, 9);

    if(elm.value.length == 9)
    {
        pesquisacep(elm.value)
    }
}

/* Codigo do viaCep */
function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value=("");
    document.getElementById('bairro').value=("");
    document.getElementById('cidade').value=("");
    document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('cidade').value=(conteudo.localidade);
        document.getElementById('uf').value=(conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "")
    {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('cidade').value="...";
            document.getElementById('uf').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};

function busca_produtos(busca)
{
    var div     = document.getElementById('div_busca_prod');
    let error_msg = "<li style='color: red'>Nenhum Produto Encontrado</li>";
    if(busca)
    {   
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                if((retorno = this.responseText) != 0)
                {
                    div.innerHTML = retorno;
                }
                else
                {
                    div.innerHTML = error_msg;
                }
            }
        };

        xmlhttp.open("GET", "ajax/buscar_produtos.php?busca=" + busca);
        xmlhttp.send();
    }
    else
    {
        div.innerHTML = error_msg;
    }
}

function insere_produtos()
{
    var div_prod = document.getElementById('div_produtos');
    let elm     = document.querySelectorAll("input[name='id_produtos_add[]']");

    if(elm)
    {
        ids_prod = '';
        elm.forEach(element => {
            if(element.checked)
            {
                ids_prod += element.value + ', ';
            }
        });

        if(ids_prod.size() > 0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200)
                {

                }
            xmlhttp.open("GET", "ajax/carrega_produtos.php?ids_prod=" + ids_prod);
            xmlhttp.send();
        }
    }

}