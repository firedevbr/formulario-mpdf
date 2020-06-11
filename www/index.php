<?php

require_once 'mpdf/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('

<h1>Ficha Cadastral</h1>

<form action="#" method="post">
    <fieldset>
        <fieldset class="grupo">
            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" style="width: 10em" value="">
            </div>
            <div class="campo">
                <label for="snome">Sobrenome</label>
                <input type="text" id="snome" name="snome" style="width: 10em" value="">
            </div>
        </fieldset>
        <div class="campo">
            <label>Sexo</label>
            <label>
                <input type="radio" name="sexo" value="masculino"> Masculino
            </label>
            <label>
                <input type="radio" name="sexo" value="feminino"> Feminino
            </label>
        </div>
        <div class="campo">
            <label for="email">Documento</label>
            <input type="text" id="email" name="email" style="width: 10em" value="">
        </div>

        <fieldset class="grupo">
            <div class="campo">
                <label for="cidade">Endereço</label>
                <input type="text" id="cidade" name="cidade" style="width: 20em" value="">
            </div>
            <div class="campo">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" style="width: 10em" value="">
            </div>
            <div class="campo">
                <label for="cidade">Cep</label>
                <input type="text" id="cidade" name="cidade" style="width: 8em" value="">
            </div>
        </fieldset>

        <div class="campo">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" style="width: 10em" value="">
        </div>
        <div class="campo">
        <label for="cidade">Cidade</label>
        <input type="text" id="cidade" name="cidade" style="width: 10em" value="">
    </div>

        <div class="campo">
            <label>Dermatite de contato?</label>
            <label>
                <input type="radio" name="dermatite" value="sim"> Sim
            </label>
            <label>
                <input type="radio" name="dermatite" value="nao"> Não
            </label>
        </div>

        <div class="campo">
            <label>Termo de consentimento assinado?</label>
            <label>
                <input type="radio" name="termo" value="sim"> Sim
            </label>
            <label>
                <input type="radio" name="termo" value="nao"> Não
            </label>
        </div>

        <div class="campo">
            <label>Aceita exposição de caso clínico?</label>
            <label>
                <input type="radio" name="exposicao" value="sim"> Sim
            </label>
            <label>
                <input type="radio" name="exposicao" value="nao"> Não
            </label>
        </div>

        <div class="campo">
            <label>Produto Aplicado</label>
            <label>
                <input type="radio" name="toxina" value="sim"> Toxina
            </label>
            <label>
                <input type="radio" name="acido" value="nao"> Acido Hialurônico
            </label>
        </div>

        <div class="campo">
            <label>Marca Aplicada</label>
            <label>
                <input type="radio" name="allergan" value="sim"> Allergan
            </label>
            <label>
                <input type="radio" name="galderma" value="nao"> Galderma
            </label>
        </div>

        <div class="campo">
            <label>Região Aplicada</label>
            <label>
                <input type="radio" name="testa" value="sim"> Testa
            </label>
            <label>
                <input type="radio" name="full" value="nao"> Full
            </label>
            <label>
                <input type="radio" name="retoque" value="nao"> Retoque
            </label>
        </div>

        <div class="campo">
            <label for="data">Data Aplicação</label>
            <input type="text" placeholder="00/00/0000" id="data" name="data" style="width: 10em" value="">
        </div>

        <div class="campo">
            <label for="lote">Lote</label>
            <input type="text" placeholder="" id="lote" name="lote" style="width: 10em" value="">
        </div>


        <div class="campo">
            <label for="data">Data Vencimento</label>
            <input type="text" placeholder="00/00/0000" id="data" name="data" style="width: 10em" value="">
        </div>
        
        <div class="campo">
            <label>Pós Clínico</label>
            <label>
                <input type="radio" name="conformidade" value="conformidade"> Conformidade
            </label>
            <label>
                <input type="radio" name="intercorrencia" value="intercorrencia"> Intercorrência
            </label>
        </div>

        <div class="campo">
            <label>Efeito</label>
            <label>
                <input type="radio" name="conformidade" value="conformidade"> Sim
            </label>
            <label>
                <input type="radio" name="intercorrencia" value="intercorrencia"> Não
            </label>
        </div>


        <div class="campo">
            <label for="data">Data do Procedimento</label>
            <input type="text" placeholder="00/00/0000" id="data" name="data" style="width: 10em" value="">
        </div>
    </fieldset>
</form>
');
$mpdf->Output();
