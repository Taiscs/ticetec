<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicTec - Consultoria em Tecnologia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<style>
    .whatsapp-button {
        position: fixed; /* Fixa a posição do botão na tela */
        bottom: 20px;    /* 20 pixels do rodapé */
        right: 20px;     /* 20 pixels da direita */
        z-index: 1000;   /* Garante que o botão fique acima de outros elementos */
        display: block;  /* Para garantir que a imagem se ajuste corretamente */
        transition: transform 0.3s ease; /* Efeito de transição suave ao passar o mouse */
    }

    .whatsapp-button img {
        width: 60px;     /* Largura do ícone (ajuste conforme necessário) */
        height: 60px;    /* Altura do ícone (ajuste conforme necessário) */
        border-radius: 50%; /* Faz a imagem ficar redonda */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para dar profundidade */
    }

    .whatsapp-button:hover {
        transform: scale(1.1); /* Aumenta ligeiramente o tamanho ao passar o mouse */
    }
</style>
     
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
<a class="navbar-brand d-flex align-items-center" href="#home">
    <i class="fas fa-project-diagram me-2" style="font-size: 1.8rem; color: #17A2B8;"></i> TicTec
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">O que Faz</a>
                    </li>
                 <li class="nav-item">
                        <a class="nav-link" href="#about-me">Quem Faz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero-section d-flex align-items-center text-center text-white">
        <div class="container">
            <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">Na medida certa Pra você não perder o Time da Decisão</h1>
            <p class="lead mt-4 animate__animated animate__fadeInUp">Integração de sistemas, automação de processos e dados para máxima eficiência.</p>
        </div>
    </section>

<section id="about" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-dark-blue fw-bold">Sobre a TicTec</h2>
        <div class="row align-items-center">
<div class="col-md-6">
    <p class="lead">Essa empresa nasce de desejo por desmistificar a tecnologia e transformá-la em uma poderosa ferramenta para o seu negócio. Aqui a missão é otimizar seus processos, integrar suas ferramentas e dar sentido aos seus dados.</p>
    <p>Com expertise em automação de tarefas manuais, integração de e-mails e sistemas diversos, e organização de dados complexos, preparamos sua empresa para um futuro mais eficiente e produtivo. <strong>Acreditamos que a tecnologia deve servir você</strong>, e não o contrário. Trabalhamos com as principais plataformas do mercado:</p>
</div>
            <div class="col-md-6 text-center">
                 
                
                <div class="d-flex justify-content-center align-items-center flex-wrap">
<img src="/img/gmail-logo.png" alt="Logo Gmail" class="img-fluid mx-2 mb-2" style="height: 40px;">
<img src="/img/sharepoint-logo.png" alt="Logo SharePoint" class="img-fluid mx-2 mb-2" style="height: 40px;">
<img src="/img/powerbi-logo.png" alt="Logo Power BI" class="img-fluid mx-2 mb-2" style="height: 40px;">
<img src="/img/microsoft-logo.png" alt="Logo Microsoft" class="img-fluid mx-2 mb-2" style="height: 40px;">
<img src="/img/cahtboot.png" alt="Logo cahtboot" class="img-fluid mx-2 mb-2" style="height: 40px;">
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="services" class="py-5 bg-white">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
<div class="col">
    <div class="card h-100 shadow-sm service-card">
        <div class="card-body text-center">
            <i class="fas fa-code fa-3x text-primary mb-3"></i> <h5 class="card-title fw-bold">Criação de Sistemas Personalizados</h5>
            <p class="card-text">Desenvolvemos sistemas e e-commerces sob medida para as suas necessidades, transformando ideias e processos em soluções digitais robustas e eficientes.</p>
        </div>
    </div>
</div>
                <div class="col">
                    <div class="card h-100 shadow-sm service-card">
                        <div class="card-body text-center">
                            <i class="fas fa-robot fa-3x text-success mb-3"></i>
                            <h5 class="card-title fw-bold">Automação de Processos</h5>
                            <p class="card-text">Transformamos tarefas manuais repetitivas em processos automatizados, liberando sua equipe para focar no que realmente importa.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm service-card">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                            <h5 class="card-title fw-bold">Gestão e Análise de Dados</h5>
                            <p class="card-text">Organizamos e analisamos seus dados, transformando números brutos em insights valiosos para decisões estratégicas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section id="our-systems" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-dark-blue fw-bold">Nossos Sistemas e Soluções</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm system-card">
                    <a href="https://ticetec.com.br/Escala/index.php">
                    <img src="/img/Escala.png" class="card-img-top" alt="Sistema de Gerenciamento de Escala"></a>
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark-blue">Sistema de Gerenciamento de Escala</h5>
                        <p class="card-text">Otimize a gestão de equipes e horários com nossa solução intuitiva. Planeje, distribua e acompanhe escalas de trabalho de forma eficiente, garantindo a cobertura ideal e Dentro das Regras legais, Respeitando Intrajornada, Jornada Máxima de Trabalho, Intervalo Obrigatório, E descanso dominical</p>
                    </div>
                </div>
            </div>

<div class="col">
    <div class="card h-100 shadow-sm system-card">
        <a href="https://ticetec.com.br/comercial/comercial.php">
            <img src="/img/Pedidos.png" class="card-img-top" alt="Sistema de Controle de Pedidos e PDV">
        </a>
        <div class="card-body">
            <h5 class="card-title fw-bold text-dark-blue">Controle de Pedidos e Acompanhamento de PDV</h5>
            <p class="card-text">Agilize suas vendas e tenha total controle sobre o fluxo de pedidos e operações de Ponto de Venda. Monitore o desempenho em tempo real e tome decisões estratégicas com dados precisos.</p>
        </div>
    </div>
</div>




            <div class="col">
                <div class="card h-100 shadow-sm system-card">
                    <img src="/img/bi.jpg">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark-blue">Análises de Power BI Personalizadas</h5>
                        <p class="card-text">Transforme seus dados brutos em dashboards interativos e relatórios visuais poderosos. Oferecemos análises aprofundadas com Power BI para insights que impulsionam o crescimento do seu negócio.</p>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-sm system-card d-flex align-items-center justify-content-center text-center p-4" style="min-height: 250px;">
                    <i class="fas fa-plus-circle fa-5x text-muted mb-3"></i>
                    <h5 class="card-title fw-bold text-muted">Sua Próxima Solução Aqui!</h5>
                    <p class="card-text text-muted">Desenvolvemos sistemas sob medida para suas necessidades específicas.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="about-me" class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="text-center mb-5 text-white fw-bold">SIM! Eu Posso Ajudar</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="img/Taiscampos.jpg" alt="Sua Foto de Perfil" class="img-fluid rounded-circle shadow-lg mb-3 my-photo">
            </div>
            <div class="col-md-6">
                <p class="lead">Olá! Eu sou Taís, Sua parceira na transformação digital. Como **Analista de Sistemas**, minha jornada profissional é impulsionada pela paixão em otimizar processos e criar soluções eficientes.</p>
                <p>Sou **graduada em Sistemas de Informação** e possuo um **MBA em Projetos de TI e Metodologias Ágeis**, o que me permite unir visão estratégica à execução prática. Ao longo da minha carreira, acumulei **experiência sólida tanto em empresas públicas quanto privadas**, lidando com desafios variados e entregando resultados que realmente fazem a diferença.</p>
                <p>Estou pronta para usar meu conhecimento e dedicação para levar seus projetos ao próximo nível com a TicTec!</p>
            </div>
        </div>
    </div>
</section>

    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-dark-blue fw-bold">Fale Comigo</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="contactForm" class="p-4 border rounded shadow-sm bg-white">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 TicTec Consultoria. Todos os direitos reservados.</p>
            <div class="social-icons mt-3">
                <a href="https://www.linkedin.com/in/tais-campos-ba370522" class="text-white mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
                <a href="https://www.instagram.com/tic.etec?igsh=MWg4MTE3NnBsemoy" class="text-white mx-2"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook-square fa-2x"></i></a>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/JS/script.js"></script>
    
       <a href="https://api.whatsapp.com/send?phone=5571996758800" class="whatsapp-button" target="_blank">
    <img src="/img/whatsapp-icon.png" alt="">
</a>
 
</body>
</html>