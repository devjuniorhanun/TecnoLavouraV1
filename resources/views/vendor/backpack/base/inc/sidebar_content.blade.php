<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- Cadastros -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Cadastros</a>
	<ul class="nav-dropdown-items">
		<!-- Users, Roles, Permissions -->
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Autorizações</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuários</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Perfis</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permições</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tenant') }}"><i class="nav-icon las la-house-damage"></i> <span>Empresa</span></a></li>
			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Safras</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('safra') }}"><i class="nav-icon la la-question"></i> <span>Safras</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('cultura') }}"><i class="nav-icon la la-question"></i> <span>Culturas</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('variedadecultura') }}"><i class="nav-icon la la-question"></i> <span>Variedade Culturas</span></a></li>
			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Propriedades</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('proprietario') }}"><i class="nav-icon la la-question"></i> <span>Proprietarios</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('produtor') }}"><i class="nav-icon la la-question"></i> <span>Produtores</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('fazenda') }}"><i class="nav-icon la la-question"></i> <span>Fazendas</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('talhao') }}"><i class="nav-icon la la-question"></i> <span>Talhãos</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('locacaotalhao') }}"><i class="nav-icon la la-question"></i> <span>Locação Talhões</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('matrizfrete') }}"><i class="nav-icon la la-question"></i> <span>Matriz Fretes</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('inscricaoestadual') }}"><i class="nav-icon la la-question"></i> <span>Inscrições</span></a></li>



			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Veículos</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('grupofrota') }}"><i class="nav-icon la la-question"></i> <span>Grupos Frotas</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('frota') }}"><i class="nav-icon la la-question"></i> <span>Frotas</span></a></li>


			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Posto</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('postocombustivel') }}"><i class="nav-icon la la-question"></i> <span>Postos</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('postoproduto') }}"><i class="nav-icon la la-question"></i> <span>Posto Produto</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('postotransferencia') }}"><i class="nav-icon la la-question"></i> <span>Transferéncia Posto</span></a></li>


			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Agrícola</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tipooperacaoagricula') }}"><i class="nav-icon la la-question"></i> <span>Tipo Operação</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('operadoragricula') }}"><i class="nav-icon la la-question"></i> <span>Operadores</span></a></li>
			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Fornecedores</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('fornecedor') }}"><i class="nav-icon la la-question"></i> <span>Fornecedores</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('armazem') }}"><i class="nav-icon la la-question"></i> <span>Armazéns</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('colhedor') }}"><i class="nav-icon la la-question"></i> <span>Colhedores</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('motorista') }}"><i class="nav-icon la la-question"></i> <span>Motoristas</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('contratosMotoristas') }}"><i class="nav-icon la la-question"></i> <span>Contratos Motoristas</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('contratosColhedores') }}"><i class="nav-icon la la-question"></i> <span>Contratos Colhedores</span></a></li>

			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Produto</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('grupoproduto') }}"><i class="nav-icon la la-question"></i> <span>Grupo Produtos</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('subgrupoproduto') }}"><i class="nav-icon la la-question"></i> <span>Sub Grupo Produtos</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('produto') }}"><i class="nav-icon la la-question"></i> <span>Produtos</span></a></li>
			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Financiero</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('centroadministrativo') }}"><i class="nav-icon la la-question"></i> <span>Centro Admini.</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('centrocusto') }}"><i class="nav-icon la la-question"></i> <span>Centros Custo</span></a></li>
			</ul>
		</li>
	</ul>
</li>

<!-- Lançamentos -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Lançamentos</a>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Colheita</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentosafra') }}"><i class="nav-icon la la-question"></i> <span>Safra</span></a></li>
			</ul>
		</li>
	</ul>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Financiero</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Contas</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentocontaapagar') }}"><i class="nav-icon la la-question"></i> <span>Apagar</span></a></li>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentos/caixa') }}"><i class="nav-icon la la-question"></i> <span>Caixa</span></a>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentos/folha') }}"><i class="nav-icon la la-question"></i> <span>Folha</span></a>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentos/cheque') }}"><i class="nav-icon la la-question"></i> <span>Cheques</span></a>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentos/transferencia-dia') }}"><i class="nav-icon la la-question"></i> <span>Transferências</span></a>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentocontaapagar/marmitas') }}"><i class="nav-icon la la-question"></i> <span>Marmitas</span></a>
						<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentocontaapagar/romaneioBoletos') }}"><i class="nav-icon la la-question"></i> <span>Romaneios Boletos</span></a> -->

					</ul>
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Adiantamentos</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('adiantamentomotorista') }}"><i class="nav-icon la la-question"></i> <span>Motorista</span></a></li>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/motoristas') }}"><i class="nav-icon la la-question"></i> <span>Motoristas</span></a></li>
						<li class="nav-item"><a class="nav-link" href="{{ backpack_url('adiantamentocolhedo') }}"><i class="nav-icon la la-question"></i> <span>Colhedores</span></a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Agrícola</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('servicoagricola') }}"><i class="nav-icon la la-question"></i> <span>Serviço Agricolas</span></a></li>
			</ul>
		</li>
	</ul>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Posto</a>
			<ul class="nav-dropdown-items">
			<li class='nav-item'><a class='nav-link' href='{{ backpack_url('lancamentocombustivel') }}'><i class='nav-icon la la-question'></i>Lançamento Combustivel</a></li>
			</ul>
		</li>
	</ul>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Sementes</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lancamentos/notasemente') }}"><i class="nav-icon la la-question"></i> <span>Nota</span></a></li>
			</ul>
		</li>
	</ul>

</li>

<!-- Relatorios -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Relatórios</a>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Colheita</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/safra') }}"><i class="nav-icon la la-question"></i> <span>Safra</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/safra') }}"><i class="nav-icon la la-question"></i> <span>Safra 20/21</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/safra') }}"><i class="nav-icon la la-question"></i> <span>Safrinha</span></a></li>
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/mapaProdutividade') }}"><i class="nav-icon la la-question"></i> <span>Mapa Produtividade</span></a></li>
				
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/colhedores') }}"><i class="nav-icon la la-question"></i> <span>Colhedores</span></a></li>
			</ul>
		</li>
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Financeiro</a>
			<ul class="nav-dropdown-items">
			<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/contas') }}"><i class="nav-icon la la-question"></i> <span>Contas</span></a></li>
			<li class="nav-item"><a class="nav-link" href="{{ backpack_url('relatorios/centro-custo') }}"><i class="nav-icon la la-question"></i> <span>Centro Custo</span></a></li>
			</ul>
		</li>
	</ul>
</li>


<!-- Embarque -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Silo</a>
	<ul class="nav-dropdown-items">
		<li class="nav-item nav-dropdown">
			<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Entrada</a>
			<ul class="nav-dropdown-items">
				<li class="nav-item"><a class="nav-link" href="{{ backpack_url('entradasilo') }}"><i class="nav-icon la la-question"></i> <span>Armazém</span></a></li>

			</ul>
		</li>
	</ul>
</li>
