<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sincronizador de Diretórios</title>
    <!-- Carregamento do Tailwind CSS para estilo e responsividade -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root { font-family: 'Inter', sans-serif; }
        /* Estilo customizado */
        .card { box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .btn-primary { transition: all 0.2s; }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .loading-overlay { display: flex; align-items: center; justify-content: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 50; }
        .spinner { border: 4px solid rgba(0, 0, 0, 0.1); border-top: 4px solid #3b82f6; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        /* Cores para status */
        .status-success { border-left-color: #10b981; } /* emerald-500 */
        .status-error { border-left-color: #ef4444; } /* red-500 */
        .status-pending { border-left-color: #f59e0b; } /* amber-500 */
        .status-processing { border-left-color: #3b82f6; } /* blue-500 */
    </style>
    <!-- Importações dos módulos do Firebase (apenas para simulação de estrutura) -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, doc, addDoc, setDoc, deleteDoc, onSnapshot, collection, query, where, Timestamp, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Variáveis globais (fornecidas pelo ambiente Canvas)
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        // Inicialização do Firebase (APENAS PARA VERIFICAÇÃO DE CONFIGURAÇÃO - O SISTEMA ESTÁ EM MODO DE SIMULAÇÃO)
        let app, db, auth, isFirebaseAvailable = false;
        try {
            if (firebaseConfig && firebaseConfig.projectId) {
                app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                auth = getAuth(app);
                isFirebaseAvailable = true;
                setLogLevel('Debug');
                console.log("Firebase inicializado (não usado, modo simulação ativo).");
            } else {
                console.warn("Aviso: Configuração do Firebase incompleta. O sistema está rodando em MODO DE SIMULAÇÃO (dados não persistem).");
            }
        } catch (error) {
            console.error("Erro ao inicializar Firebase:", error);
        }

        // Configurações de simulação
        const simulatedAdminId = 'admin-teste-12345';
        const simulatedAdminEmail = 'admin@syncpro.com'; 

        // Estado global da aplicação
        const state = {
            // INICIALIZAÇÃO DIRETA NO DASHBOARD ADMINISTRATIVO
            view: 'admin', // Alterado para 'admin'
            userId: simulatedAdminId, // Definido para admin
            userEmail: simulatedAdminEmail, // Definido para admin
            isAuthReady: false,
            userRole: 'admin', // Definido para admin
            // FIM DA INICIALIZAÇÃO

            loading: false,
            message: '',
            isSigningUp: false,
            
            // NOVO ESTADO PARA SINCRONIZAÇÃO
            businesses: [], // Lista de empresas cadastradas
            
            // Estrutura modular de diretórios (Requirement 5)
            directories: [
                { id: 'google', name: 'Google Business Profile', icon: 'G', status: 'live' },
                { id: 'apple_maps', name: 'Apple Maps', icon: '🍎', status: 'live' },
                { id: 'facebook', name: 'Facebook Pages', icon: '📘', status: 'live' },
                { id: 'bing', name: 'Bing Places', icon: '🔎', status: 'live' },
                { id: 'foursquare', name: 'Foursquare', icon: '📍', status: 'live' },
                { id: 'kekanto', name: 'Kekanto', icon: '🗣️', status: 'beta' },
                { id: 'apontador', name: 'Apontador', icon: '📝', status: 'beta' },
            ],
            // As configurações de simulação foram movidas para variáveis const acima para fácil acesso
            simulatedAdminId,
            simulatedAdminEmail, 
        };

        // Simulação de dados iniciais (para ver algo no painel admin)
        state.businesses.push({
            id: 'b-1',
            ownerId: 'client-123',
            name: 'Café Expresso Bar',
            address: 'Av. Paulista, 1000',
            phone: '(11) 5555-1234',
            website: 'www.cafeexpressobar.com',
            description: 'Melhor café da região.',
            status: 'live', // draft, syncing, live, error
            syncStatus: {
                google: { status: 'success', log: 'Publicado em 2025-09-28' },
                apple_maps: { status: 'success', log: 'Publicado em 2025-09-28' },
                facebook: { status: 'error', log: 'Erro de imagem' },
                bing: { status: 'pending', log: 'Aguardando validação' },
                foursquare: { status: 'success', log: 'Publicado em 2025-09-28' },
                kekanto: { status: 'processing', log: 'Em análise' },
                apontador: { status: 'success', log: 'Publicado em 2025-09-28' },
            }
        });


        // --- UTILIDADES DE STATUS E SINCRONIZAÇÃO ---

        function getRandomSyncStatus() {
            const statuses = ['pending', 'success', 'error', 'processing'];
            const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
            let logMessage = '';
            
            switch (randomStatus) {
                case 'pending':
                    logMessage = `Aguardando o ciclo de sincronização (${new Date().toLocaleTimeString()}).`;
                    break;
                case 'success':
                    logMessage = `Publicado com sucesso em ${new Date().toLocaleDateString('pt-BR')} às ${new Date().toLocaleTimeString()}.`;
                    break;
                case 'error':
                    logMessage = 'Erro de conexão ou dados inválidos. Revisar credenciais.';
                    break;
                case 'processing':
                    logMessage = 'Processando dados. Validação pendente.';
                    break;
            }
            
            return { status: randomStatus, log: logMessage };
        }

        // Simula o processo de sincronização para uma empresa (Requirement 4 & 6)
        window.simulateSyncProcess = (businessId) => {
            const businessIndex = state.businesses.findIndex(b => b.id === businessId);
            if (businessIndex === -1) return;

            let business = state.businesses[businessIndex];
            business.status = 'syncing'; // Status geral
            
            showMessage(`Iniciando sincronização para '${business.name}'...`);
            updateUI();
            
            // Atualiza o status de cada diretório
            state.directories.forEach(dir => {
                business.syncStatus[dir.id] = { 
                    status: 'processing', 
                    log: `Enviando dados para ${dir.name}...`
                };
            });
            
            updateUI();

            // Simula o tempo de processamento e resultados (1.5s)
            setTimeout(() => {
                let successCount = 0;
                
                state.directories.forEach(dir => {
                    const result = getRandomSyncStatus();
                    business.syncStatus[dir.id] = result;
                    if (result.status === 'success') {
                        successCount++;
                    }
                });

                // Determina o status geral
                if (successCount === state.directories.length) {
                    business.status = 'live';
                } else if (successCount > 0) {
                    business.status = 'syncing'; // Parcialmente concluído
                } else {
                    business.status = 'error'; // Falha total
                }
                
                showMessage(`Sincronização para '${business.name}' concluída. ${successCount}/${state.directories.length} publicados.`);
                updateUI();
            }, 2500); 
        }

        // Retorna as classes de cor e texto com base no status
        function getStatusClasses(status) {
            switch(status) {
                case 'live':
                case 'success':
                    return { color: 'bg-green-100 text-green-800 border-green-500 status-success', text: 'Publicado', icon: '✓' };
                case 'error':
                    return { color: 'bg-red-100 text-red-800 border-red-500 status-error', text: 'Erro', icon: '✗' };
                case 'pending':
                    return { color: 'bg-yellow-100 text-yellow-800 border-yellow-500 status-pending', text: 'Pendente', icon: '…' };
                case 'syncing':
                case 'processing':
                    return { color: 'bg-blue-100 text-blue-800 border-blue-500 status-processing', text: 'Sincronizando', icon: '↻' };
                case 'draft':
                default:
                    return { color: 'bg-gray-100 text-gray-800 border-gray-500', text: 'Rascunho', icon: '—' };
            }
        }


        // --- RENDERIZAÇÃO DA INTERFACE ---

        function updateUI() {
            const appDiv = document.getElementById('app');
            if (!appDiv) return;

            // Loading state
            if (state.loading) {
                appDiv.innerHTML = `
                    <div class="loading-overlay">
                        <div class="spinner"></div>
                        <p class="mt-4 text-lg text-blue-600">Inicializando sistema...</p>
                    </div>
                `;
                return;
            }

            // Exibir mensagem de erro ou sucesso
            let messageHtml = '';
            if (state.message) {
                messageHtml = `<div class="p-3 mb-4 rounded-lg text-white font-medium ${state.message.includes('Erro') ? 'bg-red-500' : 'bg-green-500'}">
                    ${state.message}
                </div>`;
                // Remove a mensagem após 5 segundos
                setTimeout(() => { state.message = ''; updateUI(); }, 5000); 
            }

            let contentHtml = '';
            if (state.view === 'login') {
                contentHtml = AuthView(messageHtml);
            } else if (state.view === 'client') {
                contentHtml = ClientDashboard(messageHtml);
            } else if (state.view === 'admin') {
                contentHtml = AdminDashboard(messageHtml);
            }

            appDiv.innerHTML = `
                <div class="min-h-screen bg-gray-50 p-4 sm:p-8">
                    <header class="flex flex-col sm:flex-row justify-between items-center py-4 px-6 bg-white shadow-lg rounded-xl mb-6">
                        <h1 class="text-2xl font-bold text-blue-600">Projeto Cliente Leonardo - Sincronização de Diretórios</h1>
                        ${state.view !== 'login' ? `
                            <div class="flex items-center space-x-3 mt-3 sm:mt-0">
                                <span class="text-sm font-medium text-gray-700 hidden sm:block">Olá, ${state.userRole === 'admin' ? 'Admin' : state.userEmail || 'Cliente'}</span>
                                <button onclick="handleLogout()" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 text-sm transition duration-150">Sair</button>
                            </div>
                        ` : ''}
                    </header>
                    <main class="max-w-7xl mx-auto">
                        ${contentHtml}
                    </main>
                    <footer class="mt-8 text-center text-sm text-gray-500">
                        <p>${isFirebaseAvailable ? 'Modo Produção (Firebase Ativo)' : 'Modo Simulação (Dados em Memória)'}</p>
                        <p>Protótipo de Sincronizador de Diretórios. ID do Usuário: ${state.userId || 'N/A'}</p>
                    </footer>
                </div>
            `;
            // Não precisa de attachEventListeners complexo, pois os eventos são inline
        }

        // View de Login/Cadastro (Requirement 2 & 3)
        function AuthView(messageHtml) {
            return `
                <div class="max-w-md mx-auto mt-10 p-8 bg-white rounded-xl card">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">${state.isSigningUp ? 'Criar Conta de Cliente' : 'Acessar o Sistema'}</h2>
                    ${messageHtml}
                    <form onsubmit="handleAuth(event)">
                        <input type="email" id="auth-email" placeholder="E-mail" required class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" autocomplete="email">
                        <input type="password" id="auth-password" placeholder="Senha" required class="w-full px-4 py-3 mb-6 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" autocomplete="current-password">
                        <button type="submit" class="btn-primary w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700">
                            ${state.isSigningUp ? 'Cadastrar & Entrar' : 'Entrar'}
                        </button>
                    </form>
                    <div class="mt-6 text-center">
                        <button onclick="toggleAuthMode()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            ${state.isSigningUp ? 'Já tem conta? Faça Login.' : 'Não tem conta? Crie uma agora.'}
                        </button>
                        <p class="mt-4 text-xs text-gray-500">
                            (Admin: **${state.simulatedAdminEmail}** / **admin123**)
                        </p>
                    </div>
                </div>
            `;
        }
        
        // --- CLIENTE VIEW --- (Requirement 1 & 2)

        // Formulário para cadastro de empresas
        function BusinessForm() {
            return `
                <form id="business-form" onsubmit="handleSaveBusiness(event)" class="space-y-4">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Dados Básicos da Empresa</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" id="business-name" placeholder="Nome da Empresa (Ex: Loja do João)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" id="business-phone" placeholder="Telefone (Ex: (11) 99999-9999)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <input type="text" id="business-address" placeholder="Endereço Completo (Rua, Número, Cidade, Estado)" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <input type="url" id="business-website" placeholder="Site (Ex: https://minhaloja.com)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <textarea id="business-description" placeholder="Descrição Curta (máx. 250 caracteres)" maxlength="250" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 h-24"></textarea>

                    <h3 class="text-xl font-semibold mb-3 text-blue-600 mt-6">Mídias Sociais (Opcional)</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="url" id="social-instagram" placeholder="Link do Instagram" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="url" id="social-facebook" placeholder="Link do Facebook" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <button type="submit" class="btn-primary w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-700 mt-6">
                        Salvar Empresa & Preparar para Sincronização
                    </button>
                </form>
            `;
        }

        function ClientDashboard(messageHtml) {
            const myBusinesses = state.businesses.filter(b => b.ownerId === state.userId);

            return `
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Cadastro de Empresa -->
                    <div class="lg:col-span-1 p-6 bg-white rounded-xl card h-fit">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Cadastrar Nova Empresa</h2>
                        ${messageHtml}
                        ${BusinessForm()}
                    </div>

                    <!-- Minhas Empresas e Status de Sincronização -->
                    <div class="lg:col-span-2 p-6 bg-blue-50 rounded-xl card">
                        <h2 class="text-2xl font-bold text-blue-700 mb-4">Minhas Empresas (${myBusinesses.length})</h2>
                        <div class="space-y-4">
                            ${myBusinesses.length > 0 ? myBusinesses.map(b => {
                                const statusInfo = getStatusClasses(b.status);
                                return `
                                    <div class="bg-white p-4 rounded-lg border-l-4 ${statusInfo.color} shadow-md flex justify-between items-start flex-wrap gap-3">
                                        <div class="flex-1 min-w-[200px]">
                                            <p class="font-bold text-xl">${b.name}</p>
                                            <p class="text-sm text-gray-600 truncate">Endereço: ${b.address}</p>
                                            <p class="text-xs text-gray-500 mt-1">Status Geral: <span class="font-semibold text-sm">${statusInfo.text}</span> ${statusInfo.icon}</p>
                                        </div>
                                        <div class="text-right">
                                            <button onclick="viewSyncDetails('${b.id}')" class="text-xs text-blue-600 hover:text-blue-800 font-medium mr-3">Ver Detalhes</button>
                                            <button 
                                                onclick="simulateSyncProcess('${b.id}')" 
                                                class="text-xs text-white px-3 py-1 rounded-full font-medium transition duration-150 ${b.status === 'syncing' ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700'}"
                                                ${b.status === 'syncing' ? 'disabled' : ''}
                                            >
                                                ${b.status === 'syncing' ? 'Sincronizando...' : 'Sincronizar Agora'}
                                            </button>
                                        </div>
                                    </div>
                                `;
                            }).join('') : `
                                <p class="text-gray-600 p-4">Nenhuma empresa cadastrada. Use o formulário ao lado para começar.</p>
                            `}
                        </div>
                        
                        <!-- Modal de Detalhes de Sincronização -->
                        ${SyncDetailsModal()}
                    </div>
                </div>
            `;
        }
        
        // --- ADMIN VIEW --- (Requirement 3 & 4 & 6)
        
        // Modal de Detalhes de Sincronização
        function SyncDetailsModal() {
            const business = state.currentBusinessId 
                ? state.businesses.find(b => b.id === state.currentBusinessId) 
                : null;
            
            if (!business) {
                return '<div id="sync-modal" class="hidden"></div>';
            }

            const totalPublished = state.directories.filter(d => business.syncStatus[d.id]?.status === 'success').length;
            const totalDirectories = state.directories.length;
            
            return `
                <div id="sync-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-4 z-50">
                    <div class="bg-white w-full max-w-4xl rounded-xl card p-6 max-h-[90vh] overflow-y-auto">
                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Status de Sincronização: ${business.name}</h2>
                            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800 text-2xl font-semibold">&times;</button>
                        </div>
                        
                        <p class="mb-4 text-sm text-gray-600">Progresso: <span class="font-bold text-blue-600">${totalPublished}/${totalDirectories}</span> diretórios em ${getStatusClasses(business.status).text.toLowerCase()}.</p>
                        
                        <div class="space-y-3">
                            ${state.directories.map(dir => {
                                const syncEntry = business.syncStatus[dir.id] || { status: 'draft', log: 'Aguardando informações iniciais.' };
                                const statusInfo = getStatusClasses(syncEntry.status);
                                return `
                                    <div class="bg-gray-50 p-3 rounded-lg border-l-4 ${statusInfo.color} flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                        <div class="flex items-center space-x-3 flex-1">
                                            <span class="text-xl">${dir.icon || ''}</span>
                                            <div class="min-w-0">
                                                <p class="font-bold text-md text-gray-800">${dir.name} ${dir.status === 'beta' ? '<span class="text-xs text-yellow-600">(Beta)</span>' : ''}</p>
                                                <p class="text-xs text-gray-500 truncate">${business.address}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:mt-0 sm:text-right min-w-[250px]">
                                            <span class="font-semibold text-sm ${statusInfo.color.replace('bg-', 'text-').replace('border-', '')}">${statusInfo.text}</span>
                                            <p class="text-xs text-gray-500">${syncEntry.log}</p>
                                        </div>
                                    </div>
                                `;
                            }).join('')}
                        </div>

                        <div class="mt-6 pt-4 border-t">
                            <h3 class="font-semibold text-lg text-gray-700">Detalhes da Empresa</h3>
                            <p class="text-sm text-gray-600">Site: ${business.website || 'N/A'} | Telefone: ${business.phone}</p>
                            <p class="text-sm text-gray-600">Descrição: ${business.description.substring(0, 100)}...</p>
                        </div>
                    </div>
                </div>
            `;
        }
        
        function AdminDashboard(messageHtml) {
            // Dashboard mostrando status de sincronização em cada diretório (Requirement 4)
            const globalSyncSummary = state.businesses.reduce((acc, business) => {
                state.directories.forEach(dir => {
                    const status = business.syncStatus[dir.id]?.status || 'draft';
                    acc[dir.id] = acc[dir.id] || { total: 0, success: 0, error: 0, pending: 0, processing: 0, name: dir.name, icon: dir.icon };
                    acc[dir.id].total++;
                    if (status === 'success') acc[dir.id].success++;
                    else if (status === 'error') acc[dir.id].error++;
                    else if (status === 'processing') acc[dir.id].processing++;
                    else acc[dir.id].pending++;
                });
                return acc;
            }, {});

            const totalBusinesses = state.businesses.length;

            return `
                <div class="p-6 bg-white rounded-xl card">
                    <h2 class="text-2xl font-bold text-blue-700 mb-4">Painel de Administração Global</h2>
                    ${messageHtml}

                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-blue-800 mb-2">Resumo Global</h3>
                        <p class="text-lg font-medium text-gray-700">Total de Empresas Cadastradas: <span class="font-bold">${totalBusinesses}</span></p>
                        <p class="text-sm text-gray-600">Relatório/Logs com Status de Envio (Requirement 6).</p>
                    </div>

                    <!-- Dashboard de Sincronização por Diretório -->
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Status de Sincronização por Diretório (Requirement 4)</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        ${Object.values(globalSyncSummary).map(summary => `
                            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-2xl">${summary.icon}</span>
                                    <p class="font-bold text-lg">${summary.name}</p>
                                </div>
                                <p class="text-xs text-gray-600">Sucesso: <span class="text-green-600 font-semibold">${summary.success}</span> / ${summary.total}</p>
                                <p class="text-xs text-gray-600">Processando: <span class="text-blue-600 font-semibold">${summary.processing}</span></p>
                                <p class="text-xs text-gray-600">Pendente/Rascunho: <span class="text-yellow-600 font-semibold">${summary.pending}</span></p>
                                <p class="text-xs text-gray-600">Erro: <span class="text-red-600 font-semibold">${summary.error}</span></p>
                            </div>
                        `).join('')}
                    </div>

                    <!-- Lista Completa de Empresas -->
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Lista Completa de Empresas</h3>
                    <div class="space-y-3 max-h-[50vh] overflow-y-auto pr-2">
                        ${state.businesses.length > 0 ? state.businesses.map(b => {
                            const statusInfo = getStatusClasses(b.status);
                            return `
                                <div class="bg-gray-50 p-3 rounded-lg border-l-4 ${statusInfo.color} shadow-sm flex justify-between items-center">
                                    <div class="flex-1">
                                        <p class="font-bold text-md text-gray-800">${b.name}</p>
                                        <p class="text-xs text-gray-500">Proprietário: ${b.ownerId.substring(0, 8)}... | ${b.address.substring(0, 30)}...</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-semibold ${statusInfo.color.replace('bg-', 'text-').replace('border-', '')}">${statusInfo.text}</span>
                                        <button onclick="viewSyncDetails('${b.id}')" class="ml-4 text-xs text-blue-600 hover:text-blue-800 font-medium">Ver Detalhes</button>
                                    </div>
                                </div>
                            `;
                        }).join('') : `<p class="text-gray-500">Nenhuma empresa cadastrada.</p>`}
                    </div>
                </div>
                ${SyncDetailsModal()}
            `;
        }
        
        // --- FUNÇÕES DE MANIPULAÇÃO ---

        // Salva uma nova empresa
        window.handleSaveBusiness = (event) => {
            event.preventDefault();
            if (!state.userId) {
                showMessage('Erro: Usuário não autenticado.');
                return;
            }

            const name = document.getElementById('business-name').value;
            const phone = document.getElementById('business-phone').value;
            const address = document.getElementById('business-address').value;
            const website = document.getElementById('business-website').value;
            const description = document.getElementById('business-description').value;
            const instagram = document.getElementById('social-instagram').value;
            const facebook = document.getElementById('social-facebook').value;

            // Inicializa o status de sincronização para todos os diretórios como 'draft'
            const initialSyncStatus = {};
            state.directories.forEach(dir => {
                initialSyncStatus[dir.id] = { status: 'draft', log: 'Aguardando sincronização inicial.' };
            });

            const newBusiness = {
                id: crypto.randomUUID(),
                ownerId: state.userId,
                name,
                phone,
                address,
                website,
                description,
                social: { instagram, facebook },
                status: 'draft',
                syncStatus: initialSyncStatus,
                createdAt: new Date(),
            };

            state.businesses.push(newBusiness);
            showMessage(`Empresa '${name}' salva com sucesso. Inicie a sincronização!`);
            
            // Limpa o formulário
            event.target.reset();
            updateUI();
        };

        // Abre o modal de detalhes de sincronização
        window.viewSyncDetails = (businessId) => {
            state.currentBusinessId = businessId;
            updateUI();
            // Garante que o modal esteja visível
            const modal = document.getElementById('sync-modal');
            if(modal) modal.classList.remove('hidden');
        };

        // Fecha o modal de detalhes de sincronização
        window.closeModal = () => {
            state.currentBusinessId = null;
            // Garante que o modal esteja escondido
            const modal = document.getElementById('sync-modal');
            if(modal) modal.classList.add('hidden');
            updateUI();
        };

        // --- AUTENTICAÇÃO SIMULADA ---

        window.toggleAuthMode = () => {
            state.isSigningUp = !state.isSigningUp;
            updateUI();
        };

        window.handleAuth = (event) => {
            event.preventDefault();
            const email = document.getElementById('auth-email').value;
            const password = document.getElementById('auth-password').value;

            // Login de Admin (Requirement 3)
            if (email === state.simulatedAdminEmail && password === 'admin123') {
                state.userId = state.simulatedAdminId; 
                state.userEmail = email;
                state.userRole = 'admin';
                state.view = 'admin';
                showMessage('Login de Administrador bem-sucedido. (Simulado)');
            } 
            // Login/Cadastro de Cliente (Multiusuário - Requirement 1 & 2)
            else {
                state.userId = `client-${email.split('@')[0]}-${crypto.randomUUID().substring(0, 4)}`; // ID persistente simulado
                state.userEmail = email;
                state.userRole = 'client';
                state.view = 'client';
                showMessage(`${state.isSigningUp ? 'Cadastro e ' : ''}Login de Cliente bem-sucedido. (Simulado)`);
            }
            updateUI();
        };

        window.handleLogout = () => {
            state.userId = null;
            state.userEmail = null;
            state.userRole = null;
            state.view = 'login';
            state.message = 'Sessão encerrada com sucesso.';
            updateUI();
        };

        window.showMessage = (msg) => {
            state.message = msg;
            updateUI();
        };
        
        // Início da aplicação
        window.onload = function () {
            state.loading = false;
            state.isAuthReady = true;
            updateUI();
        }

    </script>
</head>
<body class="bg-gray-50">
    <!-- O conteúdo da aplicação será injetado aqui -->
    <div id="app">
        <!-- Conteúdo inicial de loading -->
        <div class="loading-overlay">
            <div class="spinner"></div>
            <p class="mt-4 text-lg text-blue-600">Inicializando sistema...</p>
        </div>
    </div>
</body>
</html>