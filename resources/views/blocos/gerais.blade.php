<!--
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Dados gerais</h5>
        </div>
        <div class="ibox-content">
            <div class="form-group col-lg-12 padding-0 m-b-none">
                <div class="col-lg-2 padding-0">
                    <label class="control-label">Cliente</label>
                    <input type="text" class="form-control" disabled placeholder="{{ $orcamento->cliente }}">
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Bairro</label>
                    <input type="text" class="form-control" disabled placeholder="{{ $orcamento->bairro }}">
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Responsável pelo pedido</label>
                    <input type="text" class="form-control" disabled placeholder="{{ $orcamento->responsavel }}">
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Nº do pedido</label>
                    <input type="text" class="form-control" disabled placeholder="#MF{{ $orcamento->label }}">
                </div>
                <div class="col-lg-1">
                    <label class="control-label">Versão</label>
                    <select class="form-control m-b" name="account">
                        <option>v.1</option>
                        <option>v.2</option>
                        <option>v.3</option>
                        <option>v.4</option>
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed clear_both visibility_none" style="margin: 10px 0;"></div>
        </div>
    </div>
</div>
-->
<div class="col-lg-12">
    <div class="row">
        <div class="col-sm-4">
            <h2 class="orcamento">
                Orçamento: <span class="text-navy"> #MF {{ $orcamento->label }}</span> <span class="version">(Versão 01)</span>
            </h2>
            <br />
            <address>
                <strong>{{ $orcamento->cliente }}</strong>
                <br> {{ $orcamento->endereco }}, {{ $orcamento->numero }}
                @if($orcamento->complemento)
                    <br> {{ $orcamento->complemento }}
                @endif
                <br> {{ $orcamento->cidade }}, {{ $orcamento->uf }} - {{ $orcamento->bairro }}
                <br>
                <abbr title="Phone">Telefone:</abbr> {{ $orcamento->telefone }}
            </address>
        </div>
        <div class="col-sm-8 text-right">
            <p>
                <span><strong>Responsável pelo pedido:</strong> {{ $orcamento->responsavel }}</span>
                <br>
                <abbr title="Phone">Telefone:</abbr> {{ $orcamento->telefone }}
                <br>
            </p>
            <br />
            <p>
                <span><strong>Data realização:</strong> {{ $orcamento->created_at }}</span>
                <br/>
                <span><strong>Data limite de aprovação:</strong> {{ $orcamento->telefone }}</span>
            </p>
        </div>
    </div>
</div>