<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Pedidos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
      <!-- Bootstrap JavaScript -->
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- JavaScript personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>


	<script src="js/scripts.js"></script>

</head>



<body>



<style>
  body {
    font-family: 'Inter', sans-serif;
  }
</style>
    <div class="container mt-4">
        <header class="mb-4">
            
        </header>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=""><b>Logo da Sua Empresa</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=" ">Comercial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Trade Marketing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=" ">Produtos</a></li>
                            <li><a class="dropdown-item" href=" ">Lojas</a></li>
                            <li><a class="dropdown-item" href=" ">Promotor</a></li>
                            <li><a class="dropdown-item" href=" ">Coordenador</a></li>
                            <li><a class="dropdown-item" href="#">Clientes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Breve Módulo do Setor Comercial</a></li>
                        </ul>

                        
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Historico do usuario 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=" ">Historico de Log </a></li>
                            <li><a class="dropdown-item" href=" ">Historico de adição de Produtos em Loja</a></li>
                            <li><a class="dropdown-item" href=" ">Historico de Exclusão de Produtos em Loja</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"> </a></li>
                        </ul>

                        
                    </li>
                </ul>
            </div>
        </div>
    </nav><p></p>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">

         <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Resultado</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="detalhes-tab" data-bs-toggle="tab" href="#detalhes" role="tab" aria-controls="detalhes" aria-selected="false">Lançar Pedido</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Acompanhar Pedido</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="messages-tab" data-bs-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Ocorrências</a>
            </li>

            

           <!-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">A-definir</a>
            </li>-->

          <!---  <li class="nav-item" role="presentation">
                <a class="nav-link" id="tutores-tab" data-bs-toggle="tab" href="#tutores" role="tab" aria-controls="tutores" aria-selected="false">A-definir</a>
            </li>-->
        </ul>

        <!-- Lançamento Rupturas -->
        <div class="tab-content mt-3" id="myTabContent">
               
                <div class="tab-pane fade" id="detalhes" role="tabpanel" aria-labelledby="detalhes-tab">
    <h4>Lançar Novo Pedido</h4>
    <div class="container mt-4">
    <form id="pedidoForm" class="row g-3">

      <div class="col-md-3">
        <label>Data do Pedido</label>
        <input type="date" class="form-control" id="dataPedido" required>
      </div>

      <div class="col-md-3">
        <label>Número do Pedido</label>
        <input type="text" class="form-control" id="numeroPedido" required>
      </div>

      <div class="col-md-3">
        <label>Industria</label>
        <select class="form-select" id="empresa" required>
          <option selected disabled>Selecione</option>
          <option value="Guimarães">Guimarães</option>
          <option value="Marilux">Marilux</option>
          <option value="Pindorama">Pindorama</option>
          <option value="Santa Joana">Santa Joana</option>
        </select>
      </div>

      <div class="col-md-3">
        <label>CNPJ</label>
        <input type="text" class="form-control" id="cnpj" required>
      </div>

      <div class="col-md-6">
        <label>Cliente</label>
        <input type="text" class="form-control" id="cliente" required>
      </div>

      <div class="col-md-3">
        <label>Rede</label>
        <input type="text" class="form-control" id="rede" required>
      </div>

      <div class="col-md-3">
        <label>Cidade</label>
        <input type="text" class="form-control" id="cidade" required>
      </div>

      <div class="col-md-4">
        <label>Produto</label>
        <select class="form-select" id="produto" required>
          <option selected disabled>Selecione um produto</option>
          <option value="Arroz">Arroz</option>
          <option value="Feijão">Feijão</option>
          <option value="Açúcar">Açúcar</option>
        </select>
      </div>

      <div class="col-md-2">
        <label>Quantidade</label>
        <input type="number" class="form-control" id="quantidade" required>
      </div>

      <div class="col-md-2">
        <label>Valor CX ou Fardo</label>
        <input type="text" class="form-control" id="valorUnitario" readonly>
      </div>

      <div class="col-md-2">
        <label>Total</label>
        <input type="text" class="form-control" id="total" readonly>
      </div>

      <div class="col-md-2">
  <label>Paletes</label>
  <input type="text" class="form-control" id="paletes" readonly>
</div>


      <div class="col-md-2 d-flex align-items-end">
        <button type="button" class="btn btn-primary w-100" id="adicionarItem">Adicionar Item</button>
      </div>

    </form><p></p>

    <div id="alertaPaletizacao" class="alert alert-danger d-none" role="alert">
  Abaixo da paletização mínima da Indústria. Verifique com o cliente o volume do pedido.
</div>


    <!-- Lista de Itens Adicionados -->
    <div class="mt-4">
      <h5>Itens do Pedido</h5>
      <ul class="list-group" id="listaItens"></ul>
    </div>

    <div class="text-end mt-4">
      <button class="btn btn-success">Lançar Pedido</button>
    </div>

    <!-- Upload do espelho do pedido -->
<div class="mt-4">
  <h5>Espelho do Pedido (PDF)</h5>
  <div class="mb-3">
    <input class="form-control" type="file" id="pdfEspelho" accept="application/pdf">
  </div>
  <div id="nomeArquivo" class="text-muted mb-2"></div>
  <div>
    <button type="button" class="btn btn-outline-secondary" id="verEspelho" style="display: none;">
      Ver Espelho do Pedido
    </button>
  </div>
</div>

  </div>

</div>
               <!--Encerra o Formulario Lançar Pedidos---->

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Conteúdo da aba "Acompanhar Pedido" -->


                <h2>Listar Pedidos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nº do Pedido</th>
                            <th>Data do Pedido</th>
                            <th>Empresa</th>
                            <th>Cliente</th>
                            <th>Rede</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>08/09/2024</td>
                            <td>Pindorama</td>
                            <td>Cliente Exemplo</td>
                            <td>Rede Exemplo</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Detalhes</button>
                            </td>
                        </tr>


                        <tr>
                            <td>2</td>
                            <td>08/09/2024</td>
                            <td>Marilux</td>
                            <td>Cliente Exemplo</td>
                            <td>Rede Exemplo</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Detalhes</button>
                                 
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>08/09/2024</td>
                            <td>Santa Joana</td>
                            <td>Cliente Exemplo</td>
                            <td>Rede Exemplo</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Detalhes</button>
                                 
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>08/09/2024</td>
                            <td>Guimarães</td>
                            <td>Cliente Exemplo</td>
                            <td>Rede Exemplo</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Detalhes</button>
                                 
                            </td>
                        </tr>
                        <!-- Adicione mais linhas conforme necessário -->
                    </tbody>
                </table>

                <!-- Modal -->
 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Detalhes do Pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">

        <p>
          Aqui será exibido os detalhes do pedido e da entrega, como todos os dados inseridos, 
          se o caminhão está completo com os paletes, se será necessário solicitar complemento, 
          ou se será necessária uma nova entrega.
        </p>

        <!-- Detalhes de Entrega -->
<hr class="my-4">

<h5 class="mb-3">Logística da Entrega</h5>

<div class="table-responsive">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Produto</th>
        <th>Qtd. Paletes</th>
        <th>Volume Enviado</th>
        <th>Atendimento (%)</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Produto Exemplo A</td>
        <td>12</td>
        <td>8.200</td>
        <td>
          <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
          </div>
        </td>
        <td><button class="btn btn-outline-primary btn-sm">Agendar Nova Entrega</button></td>
      </tr>
      <tr>
        <td>Produto Exemplo B</td>
        <td>5</td>
        <td>3.000</td>
        <td>
          <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
          </div>
        </td>
        <td><button class="btn btn-outline-primary btn-sm"> Agendar Nova Entrega</button></td>
      </tr>
    </tbody>
  </table>
</div>
<hr class="my-4">
<h5 class="mb-3">Ocorrências / Restrições</h5>

<div class="mb-3">
  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" id="semProduto">
    <label class="form-check-label" for="semProduto">
      <i class="bi bi-box"></i> Produto não disponível para envio
    </label>
  </div>

  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" id="semAgenda">
    <label class="form-check-label" for="semAgenda">
      <i class="bi bi-calendar-x"></i> Entrega sem agendamento confirmado
    </label>
  </div>

  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" id="recusaRecebimento">
    <label class="form-check-label" for="recusaRecebimento">
      <i class="bi bi-person-x"></i> Cliente recusou o recebimento
    </label>
  </div>
</div>


<hr class="my-4">

<div>
  <h6><strong>Analista Comercial Responsável:</strong></h6>
  <p id="nomeAnalistaComercial">Exemplo Silva</p>
</div>


</div>

        <hr class="my-4">

        <!-- Etapas do Pedido -->
        <div class="d-flex justify-content-between text-center flex-wrap status-tracker">
          <!-- Recebido -->
          <div class="step completed">
            <div class="circle"><i class="bi bi-check-lg"></i></div>
            <i class="bi bi-clipboard-check fs-3"></i>
            <p class="mt-2">Recebido</p>
          </div>

          <!-- Lançado -->
          <div class="step completed">
            <div class="circle"><i class="bi bi-check-lg"></i></div>
            <i class="bi bi-upload fs-3"></i>
            <p class="mt-2">Lançado</p>
          </div>

          <!-- A Caminho (atual) -->
          <div class="step active">
            <div class="circle"><i class="bi bi-truck"></i></div>
            <i class="bi bi-truck fs-3"></i>
            <p class="mt-2">A Caminho</p>
          </div>

          <!-- Entregue -->
          <div class="step">
            <div class="circle"></div>
            <i class="bi bi-box-seam fs-3"></i>
            <p class="mt-2">Entregue</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Estilos da barra de status (pode ficar fora do modal, no final da página) -->
<style>
  .status-tracker {
    gap: 10px;
  }

  .step {
    flex: 1;
    min-width: 100px;
    opacity: 0.5;
  }

  .step .circle {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #ccc;
    margin: 0 auto 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.75rem;
  }

  .step.completed {
    opacity: 1;
  }

  .step.completed .circle {
    background-color: #198754; /* Verde */
  }

  .step.active {
    opacity: 1;
    font-weight: 600;
  }

  .step.active .circle {
    background-color: #0d6efd; /* Azul */
    box-shadow: 0 0 8px rgba(13, 110, 253, 0.5);
  }
</style>
 


            <!-- Adicione outros conteúdos de abas conforme necessário -->


        <!--- ENCERRA CONTEUDO DE ACOMPANHAR PEDIDO!---->
        

    <!-- Bootstrap JavaScript -->

            


            
            
        
        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">

           
    <!-- Conteúdo da aba "Cadastrar Cliente" -->


          <div class="container mt-4">
  <h3 class="mb-4">Ocorrências de Produtos</h3>
 
  <!-- Filtros -->
  <div class="row mb-3">
    <div class="col-md-3">
      <label for="filtroTipo" class="form-label">Filtrar por Tipo</label>
      <select id="filtroTipo" class="form-select">
        <option value="all" selected>Todos</option>
        <option value="ruptura">Ruptura</option>
        <option value="devolucao">Devolução</option>
        <option value="estoqueBaixo">Estoque Nível Baixo</option>
      </select>
    </div>

    <div class="col-md-3">
      <label for="filtroStatus" class="form-label">Filtrar por Status</label>
      <select id="filtroStatus" class="form-select">
        <option value="all" selected>Todos</option>
        <option value="sinalizado">Sinalizado</option>
        <option value="emAndamento">Em andamento</option>
        <option value="resolvido">Resolvido</option>
      </select>
    </div>

    <div class="col-md-3">
      <label for="filtroLoja" class="form-label">Filtrar por Loja</label>
      <select id="filtroLoja" class="form-select">
        <!-- Opções serão adicionadas dinamicamente -->
      </select>
    </div>
  </div>

  <!-- Tabela de Ocorrências -->
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th scope="col">Produto</th>
          <th scope="col">Tipo</th>
          <th scope="col">Loja</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Status</th>
          <th scope="col" style="width:150px;">Ações</th>
        </tr>
      </thead>
      <tbody id="tabelaOcorrencias">
        <!-- Linhas geradas via JS -->
      </tbody>
    </table>
  </div>
  </div> 
  </div> 



<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
   
 <div class="row text-center mb-4">
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Pedidos Realizados</h5>
        <h2 class="text-primary">650</h2>
        <i class="bi bi-bag-fill fs-1 text-primary"></i>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Pedidos Entregues</h5>
        <h2 class="text-success">620</h2>
        <i class="bi bi-truck fs-1 text-success"></i>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Parcialmente Entregues</h5>
        <h2 class="text-info">18</h2>
        <i class="bi bi-exclamation-circle fs-1 text-info"></i>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Ocorrências Resolvidas</h5>
        <h2 class="text-warning">85</h2>
        <i class="bi bi-tools fs-1 text-warning"></i>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <!-- Analista 1 -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img src="img\Analista comercial 1.png" alt="João Silva" class="rounded-circle me-3" width="60" height="60">
          <div>
            <h6 class="mb-0">Analista comercial 1</h6>
            <p class="mb-1">Ocorrência principal: Devolução de Produto</p>
            <span class="badge bg-success">Resolvido</span>
          </div>
        </div>
        <ul class="list-group list-group-flush small">
          <li class="list-group-item d-flex justify-content-between">
            Pedido Atrasado <span class="text-muted">25%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Cliente recusou <span class="text-muted">30%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Estoque Baixo <span class="text-muted">20%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Ruptura <span class="text-muted">25%</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Analista 2 -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img src="img\Analista comercial 2.png" alt="Maria Oliveira" class="rounded-circle me-3" width="60" height="60">
          <div>
            <h6 class="mb-0">Analista comercial 2</h6>
            <p class="mb-1">Ocorrência principal: Ruptura de Estoque</p>
            <span class="badge bg-warning text-dark">Em andamento</span>
          </div>
        </div>
        <ul class="list-group list-group-flush small">
          <li class="list-group-item d-flex justify-content-between">
            Pedido Atrasado <span class="text-muted">15%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Cliente recusou <span class="text-muted">10%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Estoque Baixo <span class="text-muted">35%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Ruptura <span class="text-muted">40%</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Analista 3 -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img src="img\Analista comercial 3.png" alt="Analista comercial 3 Ruana " class="rounded-circle me-3" width="60" height="60">
          <div>
            <h6 class="mb-0">Analista comercial 3 Ruana</h6>
            <p class="mb-1">Ocorrência principal: Pedido Atrasado</p>
            <span class="badge bg-danger">Não Resolvido</span>
          </div>
        </div>
        <ul class="list-group list-group-flush small">
          <li class="list-group-item d-flex justify-content-between">
            Pedido Atrasado <span class="text-muted">50%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Cliente recusou <span class="text-muted">20%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Estoque Baixo <span class="text-muted">15%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Ruptura <span class="text-muted">15%</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Analista 4 -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img src="img\Analista comercial 4.png" alt="Fernanda Costa" class="rounded-circle me-3" width="60" height="60">
          <div>
            <h6 class="mb-0">Analista comercial 4</h6>
            <p class="mb-1">Ocorrência principal: Estoque Baixo</p>
            <span class="badge bg-secondary">Sinalizado</span>
          </div>
        </div>
        <ul class="list-group list-group-flush small">
          <li class="list-group-item d-flex justify-content-between">
            Pedido Atrasado <span class="text-muted">10%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Cliente recusou <span class="text-muted">20%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Estoque Baixo <span class="text-muted">40%</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            Ruptura <span class="text-muted">30%</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>



<!-- Seção de gráficos por analista -->
<div class="row mt-5">
  <div class="col-md-3 text-center">
    <h6>Analista comercial 1</h6>
    <canvas id="graficoOcorrenciasAnalistacomercial1" height="200"></canvas>
  </div>
  <div class="col-md-3 text-center">
    <h6>Analista comercial 2</h6>
    <canvas id="graficoOcorrenciasAnalistacomercial2" height="200"></canvas>
  </div>
  <div class="col-md-3 text-center">
    <h6>Analista comercial 3</h6>
    <canvas id="graficoOcorrenciasAnalistacomercial3" height="200"></canvas>
  </div>
  <div class="col-md-3 text-center">
    <h6>Analista comercial 4</h6>
    <canvas id="graficoOcorrenciasAnalistacomercial4" height="200"></canvas>
  </div>
</div>

<div id="alerta-abastecimento" class="mt-5">
  <h5 class="text-danger fw-bold mb-3 text-center">
    Estas lojas precisam de abastecimento, para que não haja ruptura!
  </h5>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead class="table-danger">
        <tr>
          <th>Loja</th>
          <th>Data do Último Abastecimento</th>
          <th>Dias Desde o Último Abastecimento</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Loja Centro</td>
          <td>10/05/2025</td>
          <td>45 dias</td>
          <td><span class="detalhes-pedido" data-loja="Centro" title="Necessita abastecimento" style="cursor:pointer;">🚨</span></td>
        </tr>
        <tr>
          <td>Loja Norte</td>
          <td>12/05/2025</td>
          <td>60 dias</td>
          <td><span class="detalhes-pedido" data-loja="Norte" title="Necessita abastecimento" style="cursor:pointer;">🚨</span></td>
        </tr>
        <tr>
          <td>Loja Leste</td>
          <td>15/05/2025</td>
          <td>98 dias</td>
          <td><span class="detalhes-pedido" data-loja="Leste" title="Necessita abastecimento" style="cursor:pointer;">🚨</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>



<div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detalhesModalLabel">Detalhes do Último Pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" id="conteudo-detalhes">
        <!-- Conteúdo será inserido via JS -->
      </div>
    </div>
  </div>
</div>
<script>
  // Dados fictícios por loja com produtos não alimentícios
  const dadosPedidos = {
    Centro: [
      { produto: "Fone de Ouvido Bluetooth", quantidade: 5, preco: 89.90 },
      { produto: "Carregador Turbo USB-C", quantidade: 10, preco: 39.90 }
    ],
    Norte: [
      { produto: "Secador de Cabelo", quantidade: 3, preco: 129.99 },
      { produto: "Escova Elétrica", quantidade: 4, preco: 199.50 }
    ],
    Leste: [
      { produto: "Kit Ferramentas 40 peças", quantidade: 2, preco: 149.00 },
      { produto: "Lanterna LED Recarregável", quantidade: 6, preco: 69.90 }
    ]
  };

  // Evento ao clicar no ícone 🚨
  document.querySelectorAll('.detalhes-pedido').forEach(icone => {
    icone.addEventListener('click', () => {
      const loja = icone.dataset.loja;
      const pedidos = dadosPedidos[loja];

      if (!pedidos) return;

      let html = `<h6><strong>Loja:</strong> ${loja}</h6>`;
      html += `<table class="table table-sm table-bordered mt-3">
        <thead class="table-light">
          <tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Total</th></tr>
        </thead>
        <tbody>`;

      let totalGeral = 0;

      pedidos.forEach(p => {
        const total = p.quantidade * p.preco;
        totalGeral += total;
        html += `<tr>
          <td>${p.produto}</td>
          <td>${p.quantidade}</td>
          <td>R$ ${p.preco.toFixed(2)}</td>
          <td>R$ ${total.toFixed(2)}</td>
        </tr>`;
      });

      html += `</tbody></table>`;
      html += `<p class="text-end fw-bold">Total do Pedido: R$ ${totalGeral.toFixed(2)}</p>`;

      document.getElementById('conteudo-detalhes').innerHTML = html;

      // Exibe o modal (Bootstrap 5)
      const modal = new bootstrap.Modal(document.getElementById('detalhesModal'));
      modal.show();
    });
  });
</script>

</div>




 


            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <!-- Conteúdo da aba "Trade Marketing" -->
 
                     Os Responsáveis definirão quais funcionalidades devem ser postas aqui de acordo com sua necessidade
          </div>
     
 
                   <div class="tab-pane fade" id="tutores" role="tabpanel" aria-labelledby="tutores-tab">
                <!-- Conteúdo da aba "Trade Marketing" -->
                      Os Responsáveis definirão quais funcionalidades devem ser postas aqui de acordo com sua necessidade
        
          </div>      

        <!-- Campos manualmente preenchidos -->
 

</div>
 
 
 
</body>
</html>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  

     
<script>
  const produtos = {
    "Arroz": 5.50,
    "Feijão": 7.20,
    "Açúcar": 4.30
  };


const unidadesPorPalete = 4 * 12; // 48 unidades por palete
const totalUnidades = quantidade;
const paletes = Math.ceil(totalUnidades / unidadesPorPalete);

  document.getElementById("produto").addEventListener("change", function() {
    const valor = produtos[this.value];
    document.getElementById("valorUnitario").value = valor.toFixed(2);
    atualizarTotal();
  });

  document.getElementById("quantidade").addEventListener("input", atualizarTotal);

function atualizarTotal() {
  const quantidade = parseFloat(document.getElementById("quantidade").value) || 0;
  const valorUnitario = parseFloat(document.getElementById("valorUnitario").value) || 0;
  const total = quantidade * valorUnitario;
  const unidadesPorPalete = 4 * 12; // 48 unidades por palete
  const paletes = Math.ceil(quantidade / unidadesPorPalete);

  document.getElementById("total").value = total.toFixed(2);
  document.getElementById("paletes").value = paletes;
}


 document.getElementById("adicionarItem").addEventListener("click", function() {
  const produto = document.getElementById("produto").value;
  const qtd = parseFloat(document.getElementById("quantidade").value) || 0;
  const valor = parseFloat(document.getElementById("valorUnitario").value) || 0;
  const total = qtd * valor;
  const unidadesPorPalete = 4 * 12; // 48 unidades por palete
  const paletes = Math.ceil(qtd / unidadesPorPalete);

  if (produto && qtd > 0 && valor > 0) {
    // Mostrar alerta se paletes <= 4
    if (paletes <= 4) {
      Swal.fire({
        icon: 'warning',
        title: 'Atenção',
        text: 'Abaixo da paletização mínima da Indústria. Verifique com o cliente o volume do pedido.',
        confirmButtonText: 'Entendi'
      });
    }

    // Adiciona item à lista
    const itemHTML = `<li class="list-group-item d-flex justify-content-between align-items-center">
      ${produto} - ${qtd} und. x R$${valor.toFixed(2)} = R$${total.toFixed(2)}
      <span class="badge bg-secondary">Paletes: ${paletes}</span>
      <span class="badge bg-danger rounded-pill" style="cursor:pointer;" onclick="this.parentElement.remove()">Remover</span>
    </li>`;
    
    document.getElementById("listaItens").insertAdjacentHTML("beforeend", itemHTML);

    // Limpar campos
    document.getElementById("produto").selectedIndex = 0;
    document.getElementById("quantidade").value = '';
    document.getElementById("valorUnitario").value = '';
    document.getElementById("total").value = '';
    document.getElementById("paletes").value = '';
  }
});

 
  // Dados simulados de ocorrências
  const ocorrencias = [
    {
      id: 1,
      produto: "Produto A",
      tipo: "ruptura",
      loja: "Loja 1",
      quantidade: 0,
      status: "sinalizado"
    },
    {
      id: 2,
      produto: "Produto B",
      tipo: "devolucao",
      loja: "Loja 3",
      quantidade: 12,
      status: "emAndamento"
    },
    {
      id: 3,
      produto: "Produto C",
      tipo: "estoqueBaixo",
      loja: "Loja 2",
      quantidade: 5,
      status: "sinalizado"
    },
    {
      id: 4,
      produto: "Produto D",
      tipo: "ruptura",
      loja: "Loja 1",
      quantidade: 0,
      status: "resolvido"
    },
    {
      id: 5,
      produto: "Produto E",
      tipo: "devolucao",
      loja: "Loja 2",
      quantidade: 3,
      status: "sinalizado"
    }
  ];

  // Ícones FontAwesome para os tipos
  const iconesTipo = {
    ruptura: '<i class="fas fa-exclamation-triangle text-danger" title="Ruptura"></i>',
    devolucao: '<i class="fas fa-undo-alt text-warning" title="Devolução"></i>',
    estoqueBaixo: '<i class="fas fa-box-open text-primary" title="Estoque Nível Baixo"></i>'
  };

  // Labels coloridas para status
  const labelsStatus = {
    sinalizado: '<span class="badge bg-secondary">Sinalizado</span>',
    emAndamento: '<span class="badge bg-info text-dark">Em andamento</span>',
    resolvido: '<span class="badge bg-success">Resolvido</span>'
  };

  // Função para renderizar tabela conforme filtros
  function renderTabela() {
    const filtroTipo = document.getElementById('filtroTipo').value;
    const filtroStatus = document.getElementById('filtroStatus').value;
    const tbody = document.getElementById('tabelaOcorrencias');
    tbody.innerHTML = '';

    const filtrados = ocorrencias.filter(o => {
      const tipoOk = filtroTipo === 'all' || o.tipo === filtroTipo;
      const statusOk = filtroStatus === 'all' || o.status === filtroStatus;
      return tipoOk && statusOk;
    });

    if(filtrados.length === 0) {
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Nenhuma ocorrência encontrada.</td></tr>';
      return;
    }

    filtrados.forEach(o => {
      // Dropdown para status
      const selectStatus = `
        <select class="form-select form-select-sm status-select" data-id="${o.id}">
          <option value="sinalizado" ${o.status === 'sinalizado' ? 'selected' : ''}>Sinalizado</option>
          <option value="emAndamento" ${o.status === 'emAndamento' ? 'selected' : ''}>Em andamento</option>
          <option value="resolvido" ${o.status === 'resolvido' ? 'selected' : ''}>Resolvido</option>
        </select>
      `;

      const linha = `
        <tr>
          <td>${o.produto}</td>
          <td>${iconesTipo[o.tipo]} ${capitalize(o.tipo)}</td>
          <td>${o.loja}</td>
          <td>${o.quantidade}</td>
          <td>${labelsStatus[o.status]}</td>
          <td>${selectStatus}</td>
        </tr>
      `;
      tbody.insertAdjacentHTML('beforeend', linha);
    });

    // Adicionar event listener para selects de status
    document.querySelectorAll('.status-select').forEach(select => {
      select.addEventListener('change', e => {
        const id = parseInt(e.target.getAttribute('data-id'));
        const novoStatus = e.target.value;

        // Atualiza no array de ocorrências (simulação)
        const ocorrencia = ocorrencias.find(o => o.id === id);
        if(ocorrencia) {
          ocorrencia.status = novoStatus;
          renderTabela();
        }
      });
    });
  }

  function capitalize(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
  }

  // Render inicial
  renderTabela();



 
  // Dados de exemplo para os gráficos
  const dadosPedidosRealizados = {
    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
    datasets: [{
      label: 'Pedidos Realizados',
      data: [120, 150, 180, 200],
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };

  const dadosPedidosEntregues = {
    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
    datasets: [{
      label: 'Pedidos Entregues',
      data: [110, 140, 170, 190],
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1
    }]
  };

  const dadosOcorrenciasAtendidas = {
    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
    datasets: [{
      label: 'Ocorrências Atendidas',
      data: [30, 50, 70, 90],
      backgroundColor: 'rgba(255, 159, 64, 0.2)',
      borderColor: 'rgba(255, 159, 64, 1)',
      borderWidth: 1
    }]
  };

  // Configuração dos gráficos
const configBar = (data, titulo) => ({
  type: 'bar',
  data: data,
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: titulo,
        font: { size: 18 }
      }
    },
    scales: {
      y: { beginAtZero: true }
    }
  }
});
new Chart(document.getElementById('graficoPedidosRealizados'), configBar(dadosPedidosRealizados, "Pedidos Realizados"));


  // Inicialização dos gráficos
  new Chart(document.getElementById('graficoPedidosRealizados').getContext('2d'), config(dadosPedidosRealizados));
  new Chart(document.getElementById('graficoPedidosEntregues').getContext('2d'), config(dadosPedidosEntregues));
  new Chart(document.getElementById('graficoOcorrenciasAtendidas').getContext('2d'), config(dadosOcorrenciasAtendidas));
 
 // Função de configuração genérica para gráfico de pizza


</script>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const configPie = (data, titulo) => ({
    type: 'doughnut',
    data: data,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: titulo,
          font: { size: 14 }
        },
        legend: {
          position: 'bottom'
        }
      }
    }
  });

  const dadosOcorrenciasAnalistacomercial1 = {
    labels: ['Pedido Atrasado', 'Cliente recusou', 'Estoque Baixo', 'Ruptura'],
    datasets: [{
      data: [25, 30, 20, 25],
      backgroundColor: ['#f94144', '#f3722c', '#f9c74f', '#90be6d']
    }]
  };

  const dadosOcorrenciasAnalistacomercial2 = {
    labels: ['Pedido Atrasado', 'Cliente recusou', 'Estoque Baixo', 'Ruptura'],
    datasets: [{
      data: [15, 10, 35, 40],
      backgroundColor: ['#f94144', '#f3722c', '#f9c74f', '#90be6d']
    }]
  };

  const dadosOcorrenciasAnalistacomercial3 = {
    labels: ['Pedido Atrasado', 'Cliente recusou', 'Estoque Baixo', 'Ruptura'],
    datasets: [{
      data: [50, 20, 15, 15],
      backgroundColor: ['#f94144', '#f3722c', '#f9c74f', '#90be6d']
    }]
  };

  const dadosOcorrenciasAnalistacomercial4 = {
    labels: ['Pedido Atrasado', 'Cliente recusou', 'Estoque Baixo', 'Ruptura'],
    datasets: [{
      data: [10, 20, 40, 30],
      backgroundColor: ['#f94144', '#f3722c', '#f9c74f', '#90be6d']
    }]
  };

new Chart(document.getElementById('graficoOcorrenciasAnalistacomercial1'), configPie(dadosOcorrenciasAnalistacomercial1, 'Ocorrências - Analista comercial 1'));
new Chart(document.getElementById('graficoOcorrenciasAnalistacomercial2'), configPie(dadosOcorrenciasAnalistacomercial2, 'Ocorrências - Analista comercial 2'));
new Chart(document.getElementById('graficoOcorrenciasAnalistacomercial3'), configPie(dadosOcorrenciasAnalistacomercial3, 'Ocorrências - Analista comercial 3'));
new Chart(document.getElementById('graficoOcorrenciasAnalistacomercial4'), configPie(dadosOcorrenciasAnalistacomercial4, 'Ocorrências - Analista comercial 4'));

</script>
