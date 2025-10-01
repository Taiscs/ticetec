<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo - Plataforma Web + App (Mockup)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
:root{--brand:#0069d9;--muted:#6c757d}
body{background:#f5f7fb;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial}
.login-bg{background:linear-gradient(180deg,rgba(0,105,217,0.08),transparent)}
.card-rounded{border-radius:16px}
.nav-brand{font-weight:700;color:var(--brand)}
.tree-node{background:#fff;border-radius:16px;padding:8px 12px;border:1px solid #e6e9ef;box-shadow:0 1px 4px rgba(20,20,50,0.04);text-align:center;display:flex;flex-direction:column;align-items:center;gap:4px;}
.tree-node img{width:36px;height:36px;object-fit:cover;border-radius:50%;}
.tree{display:flex;flex-direction:column;gap:16px;align-items:center}
.tree .level{display:flex;gap:14px;align-items:flex-start}
.stat-card{border-left:4px solid var(--brand);}
@media (max-width:768px){.hide-mobile{display:none}}
</style>
</head>
<body>

<!-- Single-file mockup with 3 views: login, home, dashboard -->

<!-- LOGIN VIEW -->
<section id="view-login" class="vh-100 d-flex align-items-center login-bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card card-rounded shadow-sm overflow-hidden">
          <div class="row g-0">
            <div class="col-md-5 bg-white p-4 d-flex flex-column align-items-center justify-content-center">
              <h3 class="nav-brand mb-2">[Sua Marca]</h3>
              <p class="text-muted">Mini marketplace + escritório virtual (unilevel)</p>
              <img src="https://images.unsplash.com/photo-1532619675605-6f97a0d11b3c?q=80&w=600&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" alt="mock" class="img-fluid rounded" style="max-height:160px;object-fit:cover">
            </div>
            <div class="col-md-7 p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <h5 class="mb-0">Entrar na plataforma</h5>
                <small class="text-muted">Demo sem backend</small>
              </div>
              <form id="form-login" onsubmit="fakeLogin(event)">
                <div class="mb-3">
                  <label class="form-label">E-mail</label>
                  <input id="login-email" type="email" class="form-control" required placeholder="seu@exemplo.com">
                </div>
                <div class="mb-3">
                  <label class="form-label">Senha</label>
                  <input id="login-pass" type="password" class="form-control" required placeholder="••••••">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Manter conectado</label>
                  </div>
                  <a href="#" class="small">Esqueci a senha</a>
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary">Entrar</button>
                </div>
              </form>

              <div class="mt-4 text-center">
                <small class="text-muted">Ou acesse como</small>
                <div class="mt-2">
                  <button class="btn btn-outline-secondary btn-sm me-2" onclick="previewHome()"><i class="fa fa-eye me-1"></i>Visitante</button>
                  <button class="btn btn-outline-success btn-sm" onclick="previewDashboard()"><i class="fa fa-tachometer-alt me-1"></i>Dashboard (demo)</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <p class="text-center text-muted mt-3 small">Abra este arquivo localmente no seu navegador para demonstrar a proposta ao cliente.</p>
      </div>
    </div>
  </div>
</section>

<!-- HOME VIEW -->
<section id="view-home" class="d-none py-4">
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand nav-brand" href="#">[Sua Marca]</a>
      <div class="d-flex gap-2">
        <button class="btn btn-sm btn-outline-primary" onclick="showView('view-login')">Sair</button>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row gy-3">
      <div class="col-md-8">
        <div class="card card-rounded p-4 shadow-sm">
          <h5>Bem-vindo à plataforma</h5>
          <p class="text-muted">Apresentei um resumo da loja, promoções em destaque e acesso rápido ao escritório virtual.</p>

          <div class="row g-2">
            <div class="col-6 col-md-4">
              <div class="card card-rounded p-3 text-center">
                <img src="https://muraldoparana.com.br/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-18-at-09.40.31-1-min-e1684452515266.jpeg" class="img-fluid mb-2" alt="produto">
                <div class="small">Produto A</div>
                <strong>R$ 79,90</strong>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <div class="card card-rounded p-3 text-center">
                <img src="https://conteudo.solutudo.com.br/wp-content/uploads/2022/07/capa-wrodpress-30.png" class="img-fluid mb-2" alt="produto">
                <div class="small">Produto B</div>
                <strong>R$ 129,90</strong>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <div class="card card-rounded p-3 text-center">
                <img src="https://i.etsystatic.com/24149682/r/il/a80ffd/5209433035/il_1080xN.5209433035_hzuk.jpg" class="img-fluid mb-2" alt="produto">
                <div class="small">Produto C</div>
                <strong>R$ 39,90</strong>
              </div>
            </div>
          </div>

        </div>

        <div class="card card-rounded p-3 shadow-sm mt-3">
          <h6>Seção "Como funciona"</h6>
          <ol>
            <li>Cadastro e ativação</li>
            <li>Comprar na loja / indicar para sua rede</li>
            <li>Receber cashback e bonificações</li>
          </ol>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-rounded p-3 shadow-sm mb-3">
          <h6>Atalhos</h6>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-primary" onclick="showView('view-dashboard')">Ir para Escritório Virtual</button>
            <button class="btn btn-outline-secondary">Abrir Loja</button>
            <button class="btn btn-outline-success">Meu Perfil</button>
          </div>
        </div>

        <div class="card card-rounded p-3 shadow-sm">
          <h6>Contato</h6>
          <p class="small text-muted mb-0">Suporte@exemplo.com<br>+55 (71) 9 9999-9999</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DASHBOARD VIEW (ESCRITÓRIO VIRTUAL) -->
<section id="view-dashboard" class="d-none py-4">
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
    <div class="container-fluid">
      <a class="navbar-brand nav-brand" href="#">[Sua Marca]</a>
      <div class="d-flex align-items-center">
        <div class="me-3 text-end hide-mobile">
          <div class="small text-muted">Usuário</div>
          <div><strong>Maria Demo</strong></div>
        </div>
        <button class="btn btn-sm btn-outline-secondary me-2" onclick="showView('view-home')">Voltar</button>
        <button class="btn btn-sm btn-outline-danger" onclick="showView('view-login')">Sair</button>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row gy-3">
      <div class="col-lg-3">
        <div class="card card-rounded p-3 shadow-sm">
          <div class="d-flex align-items-center gap-3 mb-3">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGszkcLVbfseDSyEvs8yW2dJhZl67cs7DkBw&s" class="rounded-circle" alt="avatar">
            <div>
              <div class="small text-muted">Olá</div>
              <div><strong>Maria Demo</strong></div>
            </div>
          </div>
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action" href="#">Resumo</a>
            <a class="list-group-item list-group-item-action active" href="#">Minha Rede</a>
            <a class="list-group-item list-group-item-action" href="#">Pedidos</a>
            <a class="list-group-item list-group-item-action" href="#">Financeiro</a>
            <a class="list-group-item list-group-item-action" href="#">Material</a>
            <a class="list-group-item list-group-item-action" href="#">Editar Perfil</a>
          </div>
        </div>

        <div class="card card-rounded p-3 shadow-sm mt-3">
          <h6>Saldo disponível</h6>
          <div class="h4">R$ 1.250,30</div>
          <div class="d-grid mt-2">
            <button class="btn btn-outline-primary btn-sm">Solicitar Saque</button>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card card-rounded p-3 shadow-sm stat-card">
              <small class="text-muted">Volume de Vendas (30d)</small>
              <div class="h5 mt-2">R$ 12.840,00</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-rounded p-3 shadow-sm stat-card">
              <small class="text-muted">Comissões pendentes</small>
              <div class="h5 mt-2">R$ 420,00</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-rounded p-3 shadow-sm stat-card">
              <small class="text-muted">Meus Indicados</small>
              <div class="h5 mt-2">24</div>
            </div>
          </div>
        </div>

        <div class="card card-rounded p-3 shadow-sm mt-3">
          <h6>Visualização da Rede (unilevel)</h6>
          <div class="tree p-3">
           <div class="level">
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Você">
Você<br><small class="text-muted">Nível 0</small>
</div>
</div>
<div class="level">
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Ana">
Ana<br><small class="text-muted">Nível 1</small>
</div>
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Carlos">
Carlos<br><small class="text-muted">Nível 1</small>
</div>
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/women/15.jpg" alt="Beatriz">
Beatriz<br><small class="text-muted">Nível 1</small>
</div>
</div>
<div class="level">
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/men/34.jpg" alt="Fulano">
Fulano<br><small class="text-muted">Nível 2</small>
</div>
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/men/78.jpg" alt="Ciclano">
Ciclano<br><small class="text-muted">Nível 2</small>
</div>
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/women/27.jpg" alt="Beltrano">
Beltrano<br><small class="text-muted">Nível 2</small>
</div>
<div class="tree-node">
<img src="https://randomuser.me/api/portraits/women/91.jpg" alt="Outra">
Outra<br><small class="text-muted">Nível 2</small>
</div>
          </div>
        </div>

        <div class="card card-rounded p-3 shadow-sm mt-3">
          <h6>Últimos Pedidos</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Pedido</th>
                  <th>Valor</th>
                  <th>Status</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>1</td><td>#2025-001</td><td>R$ 199,90</td><td><span class="badge bg-success">Concluído</span></td><td>01/10/2025</td></tr>
                <tr><td>2</td><td>#2025-002</td><td>R$ 79,90</td><td><span class="badge bg-warning text-dark">Em trânsito</span></td><td>28/09/2025</td></tr>
                <tr><td>3</td><td>#2025-003</td><td>R$ 129,90</td><td><span class="badge bg-secondary">Pendente</span></td><td>25/09/2025</td></tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Funções simples para trocar views no mockup
  function showView(id){
    document.querySelectorAll('section[id^="view-"]').forEach(s=>s.classList.add('d-none'));
    document.getElementById(id).classList.remove('d-none');
    window.scrollTo(0,0);
  }

  function fakeLogin(e){
    e && e.preventDefault();
    // simula autenticação e abre dashboard
    const email = document.getElementById('login-email').value || 'usuario@demo.com';
    // personalizar nome
    document.querySelectorAll('.nav-brand').forEach(el=>el.textContent='[Sua Marca]');
    showView('view-dashboard');
  }

  function previewHome(){ showView('view-home'); }
  function previewDashboard(){ showView('view-dashboard'); }

  // inicia na tela de login
  showView('view-login');
</script>
</body>
</html>
