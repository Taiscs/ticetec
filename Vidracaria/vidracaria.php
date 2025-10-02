<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Métricas de Conversão | Modelo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{--brand:#0d6efd;--muted:#6c757d}
    body{background:#f6f7fb;font-family:Inter,system-ui,Arial,Helvetica,sans-serif}
    .card-compact{border-radius:12px;box-shadow:0 6px 18px rgba(20,24,40,0.06)}
    .metric{font-weight:700;font-size:1.5rem}
    .metric-sub{color:var(--muted);font-size:0.85rem}
    .small-muted{color:var(--muted);font-size:0.85rem}
    .chart-card{min-height:260px}
    .kpi-badge{font-weight:600;padding:.35rem .6rem;border-radius:999px;background:rgba(13,110,253,0.1);color:var(--brand)}
    .filter-pill{min-width:140px}
    @media (max-width:767px){.metric{font-size:1.2rem}}
  </style>
</head>
<body>
<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0">Dashboard de Conversão — Vidraçaria</h4>
      <div class="small-muted">Resumo das oportunidades, orçamentos e taxa de conversão</div>
    </div>
    <div class="d-flex gap-2">
      <select id="dateRange" class="form-select form-select-sm filter-pill">
        <option value="7">Últimos 7 dias</option>
        <option value="30" selected>Últimos 30 dias</option>
        <option value="90">Últimos 90 dias</option>
        <option value="365">Último ano</option>
      </select>
      <button id="exportBtn" class="btn btn-outline-secondary btn-sm">Exportar PDF</button>
    </div>
  </div>

  <!-- KPIs -->
  <div class="row g-3 mb-3">
    <div class="col-12 col-md-3">
      <div class="card card-compact p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="small-muted">Leads recebidos</div>
            <div id="kpiLeads" class="metric">0</div>
            <div class="metric-sub">Total de contatos</div>
          </div>
          <div class="text-end">
            <div class="kpi-badge" id="kpiLeadsDelta">+0%</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="card card-compact p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="small-muted">Orçamentos enviados</div>
            <div id="kpiQuotes" class="metric">0</div>
            <div class="metric-sub">Propostas</div>
          </div>
          <div class="text-end">
            <div class="kpi-badge" id="kpiQuotesDelta">-</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="card card-compact p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="small-muted">Conversões</div>
            <div id="kpiConversions" class="metric">0</div>
            <div class="metric-sub">Orçamentos aprovados</div>
          </div>
          <div class="text-end">
            <div class="kpi-badge" id="kpiConvRate">0%</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="card card-compact p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="small-muted">Ticket médio</div>
            <div id="kpiAvgTicket" class="metric">R$ 0,00</div>
            <div class="metric-sub">Valor médio por conversão</div>
          </div>
          <div class="text-end">
            <div class="kpi-badge" id="kpiRevenue">R$ 0,00</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts and table -->
  <div class="row g-3">
    <div class="col-12 col-lg-7">
      <div class="card card-compact p-3 chart-card">
        <h6 class="mb-3">Tendência: Leads vs Orçamentos vs Conversões</h6>
        <canvas id="trendChart" style="max-height:320px"></canvas>
      </div>
    </div>
    <div class="col-12 col-lg-5">
      <div class="card card-compact p-3">
        <h6 class="mb-3">Top 5 serviços por conversão</h6>
        <ul id="topServices" class="list-group list-group-flush">
          <!-- populated by JS -->
        </ul>
      </div>
      <div class="card card-compact p-3 mt-3">
        <h6 class="mb-3">Resumo rápido</h6>
        <div class="small-muted">Taxa de conversão = Orçamentos aprovados / Orçamentos enviados</div>
        <div class="mt-2"><strong>Meta mensal:</strong> 20% de conversão</div>
      </div>
    </div>
  </div>

  <div class="row g-3 mt-3">
    <div class="col-12">
      <div class="card card-compact p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6 class="mb-0">Últimos orçamentos</h6>
          <div class="small-muted">(últimos 20)</div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-sm mb-0">
            <thead class="table-light">
              <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Valor</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="quotesTable">
              <!-- populated by JS -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <footer class="mt-3 text-center small-muted">Modelo de dashboard criado por você — personalize com logo e dados reais antes de enviar.</footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Sample dataset generator (for demo only). Replace with real data or API.
function genSampleData(days){
  const data = [];
  const now = new Date();
  for(let i=days-1;i>=0;i--){
    const d = new Date(now);
    d.setDate(now.getDate()-i);
    const leads = Math.max(0, Math.round(5 + Math.random()*12));
    const quotes = Math.round(leads * (0.6 + Math.random()*0.3));
    const conv = Math.round(quotes * (0.1 + Math.random()*0.4));
    const revenue = conv * (200 + Math.round(Math.random()*1200));
    data.push({date: d.toISOString().slice(0,10), leads, quotes, conv, revenue});
  }
  return data;
}

// UI helpers
function formatCurrency(v){ return v.toLocaleString('pt-BR', {style:'currency',currency:'BRL'}); }
function calcKPIs(dataset){
  const leads = dataset.reduce((s,r)=>s+r.leads,0);
  const quotes = dataset.reduce((s,r)=>s+r.quotes,0);
  const conv = dataset.reduce((s,r)=>s+r.conv,0);
  const revenue = dataset.reduce((s,r)=>s+r.revenue,0);
  const avgTicket = conv? Math.round(revenue/conv) : 0;
  const convRate = quotes? Math.round((conv/quotes)*100) : 0;
  return {leads, quotes, conv, revenue, avgTicket, convRate};
}

// populate UI
let trendChart=null;
function render(dataset){
  const kpis = calcKPIs(dataset);
  $('#kpiLeads').text(kpis.leads);
  $('#kpiQuotes').text(kpis.quotes);
  $('#kpiConversions').text(kpis.conv);
  $('#kpiAvgTicket').text(formatCurrency(kpis.avgTicket));
  $('#kpiConvRate').text(kpis.convRate + '%');
  $('#kpiLeadsDelta').text((Math.round((Math.random()-0.5)*20)) + '%');
  $('#kpiQuotesDelta').text((Math.round((Math.random()-0.5)*15)) + '%');
  $('#kpiRevenue').text(formatCurrency(kpis.revenue));

  // trend chart
  const labels = dataset.map(r=>r.date);
  const leads = dataset.map(r=>r.leads);
  const quotes = dataset.map(r=>r.quotes);
  const convs = dataset.map(r=>r.conv);
  if(trendChart) trendChart.destroy();
  const ctx = document.getElementById('trendChart');
  trendChart = new Chart(ctx,{
    type:'line',
    data:{labels, datasets:[
      {label:'Leads', data:leads, tension:0.35, borderWidth:2, borderColor:'rgb(13,110,253)', pointRadius:2, fill:false},
      {label:'Orçamentos', data:quotes, tension:0.35, borderWidth:2, borderColor:'rgb(25,135,84)', pointRadius:2, fill:false},
      {label:'Conversões', data:convs, tension:0.35, borderWidth:2, borderColor:'rgb(220,53,69)', pointRadius:2, fill:false}
    ]},
    options:{responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom'}}}
  });

  // top services (dummy)
  const services = [
    {name:'Box de vidro', conv:12}, {name:'Porta de correr', conv:9}, {name:'Espelho sob medida', conv:6}, {name:'Guarda-corpo', conv:4}, {name:'Outros', conv:2}
  ];
  $('#topServices').empty();
  services.forEach(s=>$('#topServices').append(`<li class="list-group-item d-flex justify-content-between align-items-center">${s.name}<span class="badge bg-primary rounded-pill">${s.conv}</span></li>`));

  // quotes table (last 20 simulated)
  const rows = [];
  for(let i=0;i<20;i++){
    const r = dataset[Math.max(0, dataset.length-1 - i)];
    if(!r) continue;
    const statuses=['Pendente','Aprovado','Reprovado'][Math.floor(Math.random()*3)];
    rows.push(`<tr><td>${r.date}</td><td>Cliente ${i+1}</td><td>Serviço ${((i%5)+1)}</td><td>${formatCurrency( (100 + Math.round(Math.random()*3000)) )}</td><td>${statuses}</td></tr>`);
  }
  $('#quotesTable').html(rows.join('\n'));
}

// init
$(function(){
  function update(){
    const days = Number($('#dateRange').val());
    const data = genSampleData(days);
    render(data);
  }
  $('#dateRange').on('change', update);
  $('#exportBtn').on('click', ()=>window.print());
  update();
});
</script>
</body>
</html>