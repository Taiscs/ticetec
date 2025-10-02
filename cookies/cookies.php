<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🍪 Cookies Inc. - Teen Edition ✨</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&family=Sacramento&display=swap" rel="stylesheet">

<style>
/* Paleta de cores e variáveis */
:root {
    --cor-principal: #6F4E37;
    --cor-secundaria: #F8F8F8;
    --cor-acento: #D4AF37;
    --cor-acento2: #8e44ad;
    --cor-texto: #222;
    --espacamento: 30px;
    --transicao: 0.4s;
}

/* Reset */
* {box-sizing: border-box; margin: 0; padding: 0;}
body {font-family: 'Poppins', sans-serif; line-height: 1.6; color: var(--cor-texto); background: var(--cor-secundaria); scroll-behavior: smooth;}

/* Header e Navbar */
header {
    background: var(--cor-principal);
    padding: 16px var(--espacamento);
    display: flex; justify-content: space-between; align-items: center;
    position: sticky; top: 0; z-index: 1000;
    box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
}
.logo {font-family: 'Sacramento', cursive; font-size: 2.4em; color: #fff; letter-spacing: 2px;}
nav a {color: #fff; text-decoration: none; margin-left: 30px; padding: 8px 0; font-size: 1.1em; transition: color var(--transicao);}
nav a:hover {color: var(--cor-acento);}

/* Botões */
.btn-principal, .btn-secundario {
    padding: 12px 30px; border-radius: 8px; font-weight: 600; font-size: 1.1em; cursor: pointer;
    border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all var(--transicao);
}
.btn-principal {background: var(--cor-acento); color: #fff;}
.btn-principal:hover {background: var(--cor-acento2); transform: translateY(-2px);}
.btn-secundario {background: var(--cor-principal); color: #fff;}
.btn-secundario:hover {background: var(--cor-acento2); transform: translateY(-2px);}
.btn-contato {background: var(--cor-acento); color: var(--cor-principal);}

/* Hero / Carrossel */
.hero {position: relative; min-height: 550px; overflow: hidden;}
.carousel-item {position: absolute; width: 100%; height: 100%; background-size: cover; background-position: center; opacity: 0; transition: opacity 1s;}
.carousel-item.active {opacity: 1;}
.carousel-caption {position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%); text-align: center;
    background: rgba(0,0,0,0.45); padding: 25px; border-radius: 12px;}
.carousel-caption h1 {font-size: 3.5em; color: #fff; margin-bottom: 15px;}
.carousel-caption p {font-size: 1.4em; margin-bottom: 20px; color: #fff;}

/* Seções */
section {padding: 60px var(--espacamento); text-align: center; margin: 24px 0; opacity: 0; transform: translateY(30px); transition: all 0.8s;}
section.visible {opacity: 1; transform: translateY(0);}
h2 {font-size: 3em; margin-bottom: 50px; color: var(--cor-principal);}

/* Catálogo */
.produtos-grid {display: flex; flex-wrap: wrap; justify-content: center; gap: 25px;}
.produto-card {background: #fff; padding: 24px; border-radius: 12px; max-width: 300px; transition: transform 0.3s, box-shadow 0.3s; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.08);}
.produto-card:hover {transform: translateY(-6px); box-shadow: 0 8px 25px rgba(212,175,55,0.15);}
.produto-img {height: 200px; background-size: cover; background-position: center; border-radius: 8px; margin-bottom: 15px; border: 2px solid #EBDCB2;}
.preco {color: var(--cor-acento); font-size: 1.6em; font-weight: 700; margin: 15px 0;}

/* Clube VIP */
.clube {background: var(--cor-fundo-claro);}
.eventos-grid {display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;}
.evento-card {background: #fff; padding: 20px; border-radius: 12px; flex: 1 1 300px; text-align: left; border-left: 4px solid var(--cor-acento); position: relative; transition: transform 0.3s, box-shadow 0.3s;}
.evento-card:hover {transform: translateY(-4px); box-shadow: 0 6px 18px rgba(212,175,55,0.12);}
.evento-icone {font-size: 2em; color: var(--cor-acento2); position: absolute; top: 16px; right: 18px; opacity: 0.15;}
.evento-titulo {font-size: 1.25em; font-weight: 700; color: var(--cor-principal); margin-bottom: 4px; display: flex; align-items: center; gap: 8px;}
.evento-data {font-size: 1em; color: var(--cor-acento2); font-weight: 600; margin-bottom: 2px; display: flex; align-items: center; gap: 6px;}
.evento-descricao {font-size: 1em; color: var(--cor-texto); margin-top: 8px;}

/* Contato */
#form-contato {max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 20px; text-align: left; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);}
#form-contato input, #form-contato textarea {padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em;}

/* Footer */
footer {background: var(--cor-principal); color: white; padding: 32px var(--espacamento); text-align: center; border-top-left-radius: 16px; border-top-right-radius: 16px;}
.social a {color: var(--cor-acento); margin: 0 15px; text-decoration: none; font-size: 1.1em; transition: color var(--transicao);}
.social a:hover {color: var(--cor-acento2);}

/* Responsividade */
@media(max-width:768px){nav{flex-direction:column;}nav a{margin:5px 10px;}.produtos-grid,.eventos-grid{flex-direction:column;}.produto-card,.evento-card{flex:1 1 100%;}.carousel-caption h1{font-size:2em;}}
</style>
</head>
<body>

<header>
    <div class="logo">Cookies Inc. <span style="font-size:0.7em;">Jovem</span></div>
    <nav>
        <a href="#home">Início</a>
        <a href="#clube">Clube VIP</a>
        <a href="#catalogo">Catálogo</a>
        <a href="#contato" class="btn-contato">Fale Conosco</a>
    </nav>
</header>

<section id="home" class="hero">
    <div class="carousel-item active" style="background-image: url('https://i.panelinha.com.br/i1/bk-3044-blog-ayu2251.webp');">
        <div class="carousel-caption">
            <h1>Bem-vindo ao Clube Jovem dos Cookies</h1>
            <p>Sabores exclusivos, descontos e experiências para quem curte o melhor da vida.</p>
            <button class="btn-principal">Quero ser VIP</button>
        </div>
    </div>
    <div class="carousel-item" style="background-image: url('https://www.allrecipes.com/thmb/mmQk2_9J5dqKVpyvwMzpiN2hLrs=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/15295-soft-sugar-cookies-iv-ddmfs-Beauty-3x4-e1660f5907af41e09f01bd815cc14deb.jpg');">
        <div class="carousel-caption">
            <h1>Cookies Clássicos, Estilo Jovem</h1>
            <p>Receita especial, crocância e maciez na medida. Experimente!</p>
            <button class="btn-principal">Ver Detalhes</button>
        </div>
    </div>
    <div class="carousel-item" style="background-image: url('https://www.seara.com.br/wp-content/uploads/2025/09/R0525-DR-cookie-de-framboesa-com-chocolate-branco-1200x675-1.webp');">
        <div class="carousel-caption">
            <h1>Sabor Sazonal: Edição Limitada</h1>
            <p>Outono chegou! Abóbora com especiarias, só para quem é jovem de verdade.</p>
            <button class="btn-principal">Menu de Outono</button>
        </div>
    </div>
</section>

<section id="clube" class="clube">
    <h2>Seja VIP Jovem e Ganhe Vantagens</h2>
    <p>Receitas secretas, degustações exclusivas, Cookie Box mensal e muito mais. Só para quem curte exclusividade.</p>
    <button class="btn-secundario">Quero os Benefícios VIP</button>
    <div class="eventos-grid">
        <div class="evento-card">
            <span class="evento-icone">👨‍🍳</span>
            <div class="evento-titulo">Próximo Evento: Degustação do Chef</div>
            <div class="evento-data">📅 25/11/2025</div>
            <div class="evento-descricao">Prove os lançamentos antes de todo mundo. Exclusivo para VIPs Jovens.</div>
        </div>
        <div class="evento-card">
            <span class="evento-icone">💸</span>
            <div class="evento-titulo">Super Oferta: Cookie da Semana</div>
            <div class="evento-data">📅 De 01 a 07/11</div>
            <div class="evento-descricao">50% OFF no sabor Maçã com Canela para pedidos acima de R$50.</div>
        </div>
    </div>
</section>

<section id="catalogo" class="catalogo">
<h2>Sabores Que Bombam</h2>
<div class="produtos-grid">
    <div class="produto-card">
        <div class="produto-img" style="background-image:url('https://i.panelinha.com.br/i1/bk-3044-blog-ayu2251.webp');"></div>
        <h3>Chocolate & M&M's</h3>
        <p>Clássico, colorido e divertido. Pra comer ouvindo música!</p>
        <span class="preco">R$ 6,50</span>
        <button class="btn-principal">Adicionar</button>
    </div>
    <div class="produto-card">
        <div class="produto-img" style="background-image:url('https://www.allrecipes.com/thmb/mmQk2_9J5dqKVpyvwMzpiN2hLrs=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/15295-soft-sugar-cookies-iv-ddmfs-Beauty-3x4-e1660f5907af41e09f01bd815cc14deb.jpg');"></div>
        <h3>Sugar Cookie Suave</h3>
        <p>Massa amanteigada, baunilha e vibe comfort. Jovem ama!</p>
        <span class="preco">R$ 7,90</span>
        <button class="btn-principal">Adicionar</button>
    </div>
    <div class="produto-card">
        <div class="produto-img" style="background-image:url('https://www.seara.com.br/wp-content/uploads/2025/09/R0525-DR-cookie-de-framboesa-com-chocolate-branco-1200x675-1.webp');"></div>
        <h3>Sabor Sazonal</h3>
        <p>Surpresa a cada estação. Sempre novidade!</p>
        <span class="preco">R$ 7,00</span>
        <button class="btn-principal">Adicionar</button>
    </div>
</div>
</section>

<section id="contato" class="contato">
<h2>Fale com a Gente!</h2>
<form id="form-contato">
    <input type="text" placeholder="Seu Nome Completo" required>
    <input type="email" placeholder="Seu Melhor E-mail" required>
    <textarea placeholder="Sua mensagem ou feedback..." rows="5" required></textarea>
    <button type="submit" class="btn-principal">Enviar Mensagem</button>
    <p id="mensagem-feedback" style="display:none;"></p>
</form>
</section>

<footer>
<div class="social">
    <a href="#">Instagram</a> |
    <a href="#">Facebook</a> |
    <a href="#">Área do Cliente</a>
</div>
<p>&copy; 2025 Cookies Inc. | Todos os direitos reservados.</p>
</footer>

<script>
// Carrossel Fade
let slides = document.querySelectorAll('.carousel-item'), index=0;
function showSlide(i){slides.forEach(s=>s.classList.remove('active')); slides[i].classList.add('active');}
setInterval(()=>{index=(index+1)%slides.length; showSlide(index);},4000);

// Scroll reveal
const sections = document.querySelectorAll('section');
window.addEventListener('scroll', ()=>{
    sections.forEach(sec=>{
        const top = sec.getBoundingClientRect().top;
        if(top<window.innerHeight-100){sec.classList.add('visible');}
    });
});

// Form feedback
document.getElementById('form-contato').addEventListener('submit', function(e){
    e.preventDefault();
    const f=document.getElementById('mensagem-feedback');
    f.style.display='block'; f.style.color='green'; f.style.fontWeight='bold'; f.innerText='✨ Mensagem enviada! Agradecemos o contato. ✨';
    setTimeout(()=>{this.reset(); f.style.display='none';},3500);
});
</script>
</body>
</html>
