<div class="hr-line-dashed clear_both"></div>
<div class="row">
    <div class="col-lg-12">
        
        <div class="form-group col-lg-12 padding-0 m-b-none @if ($errors->has('caixa')) has-error @endif">
            <div class="form-group col-lg-2 padding-0">
                <label class="control-label">Caixa de correio</label>
                <select name="caixa" id="caixa" class="form-control m-b">
                    <option value="">Quantidade</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                @if ($errors->has('caixa'))
                <div class="clear alert alert-danger">
                    @foreach ($errors->get('caixa') as $error)
                        {!! $error !!}
                    @endforeach
                </div>
                @endif
            </div>
            <div class="form-group col-lg-2 @if ($errors->has('retirada_grade')) has-error @endif">
                <label class="control-label">Retirada de grade</label>
                <select name="retirada_grade" id="retirada_grade" class="form-control m-b">
                    <option value="">Selecione</option>
                    <option value="ferro">Ferro</option>
                    <option value="aluminio">Alumínio</option>
                </select>
                @if ($errors->has('retirada_grade'))
                <div class="clear alert alert-danger">
                    @foreach ($errors->get('retirada_grade') as $error)
                        {!! $error !!}
                    @endforeach
                </div>
                @endif
            </div>
            <div class="form-group col-lg-2 @if ($errors->has('montante_movel')) has-error @endif">
                <label class="control-label">Montante móvel</label>
                <select name="montante_movel" id="montante_movel" class="form-control m-b">
                    <option value="">Quantidade</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                @if ($errors->has('montante_movel'))
                <div class="clear alert alert-danger">
                    @foreach ($errors->get('montante_movel') as $error)
                        {!! $error !!}
                    @endforeach
                </div>
                @endif
            </div>
        </div>
            
        <div class="hr-line-dashed clear_both"></div>

        <div class="col-lg-12 padding-0">
            <label>Trilho</label>
        </div>
        <div class="col-lg-6 padding-0 m-b-none">
            <div class="checkbox i-checks col-sm-2">
                <label class="primeiro_produto">
                    <input type="checkbox" name="trilho_reaproveitar" id="trilho_reaproveitar" value="1" /><i></i> Reaproveitar
                </label>
            </div>
            <div class="checkbox i-checks col-sm-2">
                <label>
                    <input type="checkbox" name="trilho_reproduzir" id="trilho_reproduzir" value="1" /><i></i> Produzir
                </label>
            </div>
        </div>
        
    </div>
</div>

<div class="hr-line-dashed clear_both"></div>
<div class="row">
    <div class="col-lg-12">
        
        <div class="form-group col-lg-12 padding-0">
            <div class="form-group col-lg-5 padding-0 @if ($errors->has('pedra_descricao')) has-error @endif">
                <input type="checkbox" name="possui_pedra" id="possui_pedra" class="i-checks" />
                <label class="control-label">Contém pedra de granito, mármore ou acabamento no local?</label>
                <input type="text" name="pedra_descricao" id="pedra_descricao" class="form-control m-t-md pedra-adicional" placeholder="Descreva">
                @if ($errors->has('pedra_descricao'))
                <div class="clear alert alert-danger pedra-adicional">
                    @foreach ($errors->get('pedra_descricao') as $error)
                        {!! $error !!}
                    @endforeach
                </div>
                @endif
            </div>
            <div class="form-group col-lg-2 pedra-adicional @if ($errors->has('pedra_quantidade')) has-error @endif">
                <select name="pedra_quantidade" id="pedra_quantidade" class="form-control m-t-xxl">
                    <option value="">Quantidade</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                @if ($errors->has('pedra_quantidade'))
                <div class="clear alert alert-danger">
                    @foreach ($errors->get('pedra_quantidade') as $error)
                        {!! $error !!}
                    @endforeach
                </div>
                @endif
          </div>
        </div>

        <!--file upload-->
        <div class="btn-group m-b">
            <span class="m upload_label">Faça upload de um arquivo</span>
            <label title="Upload image file" for="inputImage" class=" Upload_wda btn btn-white">
                <input type="file" accept="" name="file" id="inputImage" class="hide">
                <i class="fa fa-upload"></i>&nbsp;&nbsp;Enviar
            </label>
        </div>
        <!--file upload fim-->
        
    </div>
</div>
    
<div class="hr-line-dashed clear_both"></div>
                                
<div class="form-group">
    <div class="col-sm-12">
        <a href="{{ route('tecnico/orcamentos') }}" class="btn btn-white btn_cancel"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</a>
        <button class="btn btn-primary btn-salvar btn_yell col-lg-offset-5 col-md-offset-2" type="submit" value="salvarEFechar"><i class="fa fa-warning"></i>&nbsp;&nbsp;Salvar e fechar</button>
        <button class="btn btn-primary btn-salvar" type="submit" value="salvar"><i class="fa fa-check"></i>&nbsp;&nbsp;Salvar</button>
        <button class="btn btn-primary btn-salvar btn_blue" type="submit" value="salvarELiberar"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Salvar e Liberar orçamento</button>
    </div>
</div>