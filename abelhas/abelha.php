<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abelhas PRO - Dashboard Bootstrap</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Estilos Customizados (Mínimos) */
        body {
            background-color: #f8f9fa; /* Fundo cinza bem suave */
        }
        .main-header {
            border-bottom: 5px solid #ffc107; /* Amarelo de Alerta (Mel) no topo */
        }
        .card-title {
            color: #0d6efd; /* Azul primário do Bootstrap */
        }
        .featured-card {
            border: 2px solid #ffc107; /* Borda de destaque amarela */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Sombra mais visível */
            background-color: #fffbe6; /* Fundo amarelo muito claro para o destaque */
        }
        .btn-honey {
            background-color: #ffc107; /* Cor de mel para os botões primários */
            border-color: #ffc107;
            color: #212529; /* Texto escuro no botão amarelo */
            font-weight: bold;
        }
        .btn-honey:hover {
            background-color: #e0a800; /* Tom mais escuro no hover */
            border-color: #e0a800;
        }
        /* Estilo para simular a foto no modal */
        .photo-placeholder {
            height: 200px;
            background-color: #ddd;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    
    <header class="p-4 mb-4 bg-white rounded-3 shadow-sm main-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-dark mb-0">Dashboard de Caixas Próximas 🍯</h2>
            <div class="text-end">
                <p class="mb-0 text-success fw-bold">✔ LOCALIZAÇÃO ATIVA</p>
                <p class="mb-0 text-secondary">3 Resultados Encontrados</p>
            </div>
        </div>
    </header>

    <div class="row g-4" id="producer-grid-bootstrap">
        
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow featured-card">
                <div class="card-body">
                    <span class="badge bg-success position-absolute top-0 end-0 m-2">MELHOR MATCH</span>
                    <h5 class="card-title">Apicultor João (5 km)</h5>
                    <p class="card-text text-muted">Aberto para Polinização Imediata.</p>
                    <ul class="list-unstyled">
                        <li>📦 Caixas: **20**</li>
                        <li>🩺 Saúde: **Excelente**</li>
                        <li class="fw-bold">🚚 Frete Estimado: R$ 85,00</li>
                    </ul>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-honey">SOLICITAR CAIXAS</button>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#boxDetailModal">Ver Perfil 📸</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Produtor Rural Maria</h5>
                    <p class="card-text text-muted">Disponibilidade: Próxima Semana.</p>
                    <ul class="list-unstyled">
                        <li>📦 Caixas: **8**</li>
                        <li class="text-warning">🩺 Saúde: **Boa (Aguardando Imagem)**</li>
                        <li class="fw-bold">🚚 Frete Estimado: R$ 130,00</li>
                    </ul>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-honey">SOLICITAR CAIXAS</button>
                        <button class="btn btn-outline-secondary">Ver Perfil 📸</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Fazenda Esperança</h5>
                    <p class="card-text text-muted">Grandes Volumes disponíveis.</p>
                    <ul class="list-unstyled">
                        <li>📦 Caixas: **35**</li>
                        <li>🩺 Saúde: **Excelente**</li>
                        <li class="fw-bold">🚚 Frete Estimado: R$ 98,00</li>
                    </ul>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-honey">SOLICITAR CAIXAS</button>
                        <button class="btn btn-outline-secondary">Ver Perfil 📸</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="boxDetailModal" tabindex="-1" aria-labelledby="boxDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning-subtle">
        <h5 class="modal-title" id="boxDetailModalLabel">Detalhes do Apicultor João</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <p class="lead">Distância: **5 km** (O mais próximo!)</p>
        <p>Avaliação do Apicultor: ⭐⭐⭐⭐⭐</p>
        
        <hr>
        
        <h4>Fotos das Caixas (Avaliação de Saúde)</h4>
        <p class="text-success fw-bold">Resultado da Análise de Imagem: Saúde Excelente! (Sem pragas)</p>
        
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <div class="col">
                <div class="photo-placeholder">
                    Foto da Colmeia 1
                </div>
            </div>
            <div class="col">
                <div class="photo-placeholder">
                    Foto da Rainha
                </div>
            </div>
            <div class="col">
                <div class="photo-placeholder">
                    Foto da Área de Néctar
                </div>
            </div>
        </div>
        
        <h4 class="mt-4">Detalhes da Oferta</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">**20** Caixas Disponíveis</li>
            <li class="list-group-item">Mel de Florada Silvestre Orgânica</li>
            <li class="list-group-item fw-bold">Frete Estimado: R$ 85,00</li>
        </ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-honey">SOLICITAR CONTRATAÇÃO</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>