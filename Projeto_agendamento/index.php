<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamento</title>
    <!-- Carregamento do Tailwind CSS para estilo e responsividade -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root { font-family: 'Inter', sans-serif; }
        /* Estilo customizado para um visual moderno */
        .card { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .btn-primary { transition: all 0.2s; }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .loading-overlay { display: flex; align-items: center; justify-content: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 50; }
        .spinner { border: 4px solid rgba(0, 0, 0, 0.1); border-top: 4px solid #3b82f6; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
    <!-- Importações dos módulos do Firebase -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, doc, addDoc, setDoc, deleteDoc, onSnapshot, collection, query, where, Timestamp, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Variáveis globais (fornecidas pelo ambiente Canvas)
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        // Inicialização do Firebase
        let app, db, auth, isFirebaseAvailable = false;
        try {
            // Verifica se a configuração é válida antes de tentar inicializar
            if (firebaseConfig && firebaseConfig.projectId) {
                app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                auth = getAuth(app);
                setLogLevel('Debug'); // Habilita logs para depuração do Firestore
                isFirebaseAvailable = true;
                console.log("Firebase inicializado com sucesso.");
            } else {
                console.warn("Aviso: Configuração do Firebase incompleta (falta projectId). O sistema está rodando em MODO DE SIMULAÇÃO (dados não persistem após recarregar).");
            }
        } catch (error) {
            console.error("Erro ao inicializar Firebase (mesmo com config):", error);
        }

        // Estado global da aplicação
        const state = {
            view: 'login', // 'login', 'client', 'admin'
            userId: null,
            userEmail: '',
            isAuthReady: false,
            userRole: null, // 'client' ou 'admin'
            appointments: [], // Lista de agendamentos
            loading: true,
            message: '',
            isSigningUp: false, // Controla a visão de Login/Cadastro
            selectedDate: new Date().toISOString().split('T')[0],
            adminView: 'agenda' // 'agenda' ou 'services' (no Admin)
        };

        // RENDERIZAÇÃO DA INTERFACE
        function updateUI() {
            const appDiv = document.getElementById('app');
            if (!appDiv) return;

            // Loading state
            if (state.loading) {
                appDiv.innerHTML = `
                    <div class="loading-overlay">
                        <div class="spinner"></div>
                        <p class="mt-4 text-lg text-blue-600">${isFirebaseAvailable ? 'Carregando autenticação...' : 'Carregando simulação...'}</p>
                    </div>
                `;
                return;
            }

            // Exibir mensagem de erro ou sucesso
            let messageHtml = '';
            if (state.message) {
                messageHtml = `<div class="p-3 mb-4 rounded-lg text-white ${state.message.includes('Erro') ? 'bg-red-500' : 'bg-green-500'}">
                    ${state.message}
                </div>`;
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
                    <header class="flex justify-between items-center py-4 px-6 bg-white shadow-lg rounded-xl mb-6">
                        <h1 class="text-2xl font-bold text-blue-600">Scheduler Pro</h1>
                        ${state.view !== 'login' ? `
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-medium text-gray-700 hidden sm:block">Olá, ${state.userRole === 'admin' ? 'Admin' : state.userEmail || 'Cliente'}</span>
                                <button onclick="handleLogout()" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 text-sm transition duration-150">Sair</button>
                            </div>
                        ` : ''}
                    </header>
                    <main class="max-w-6xl mx-auto">
                        ${contentHtml}
                    </main>
                    <footer class="mt-8 text-center text-sm text-gray-500">
                        <p>${isFirebaseAvailable ? 'Modo Produção (Firebase Ativo)' : 'Modo Simulação (Dados em Memória)'}</p>
                        <p>ID do Usuário: ${state.userId || 'N/A'}</p>
                        <p>Protótipo de Sistema de Agendamento.</p>
                    </footer>
                </div>
            `;
            attachEventListeners();
        }

        // --- VIEWS ---

        // View de Login/Cadastro
        function AuthView(messageHtml) {
            return `
                <div class="max-w-md mx-auto mt-10 p-8 bg-white rounded-xl card">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">${state.isSigningUp ? 'Criar Conta' : 'Acessar o Sistema'}</h2>
                    ${messageHtml}
                    <form onsubmit="handleAuth(event)">
                        <input type="email" id="auth-email" placeholder="E-mail" required class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" autocomplete="email">
                        <input type="password" id="auth-password" placeholder="Senha (mín. 6 caracteres)" required class="w-full px-4 py-3 mb-6 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" autocomplete="current-password">
                        <button type="submit" class="btn-primary w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700">
                            ${state.isSigningUp ? 'Cadastrar' : 'Entrar'}
                        </button>
                    </form>
                    <div class="mt-6 text-center">
                        <button onclick="toggleAuthMode()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            ${state.isSigningUp ? 'Já tem conta? Faça Login.' : 'Não tem conta? Crie uma agora.'}
                        </button>
                        <p class="mt-4 text-xs text-gray-500">
                            (Protótipo: Login de Admin: **admin@admin.com** / **admin123**)
                        </p>
                    </div>
                </div>
            `;
        }

        // Painel do Cliente
        function ClientDashboard(messageHtml) {
            const now = new Date();
            const availableSlots = getAvailableSlots();

            const myFutureAppointments = state.appointments.filter(a => a.clientId === state.userId && new Date(a.date) >= now).sort((a, b) => (a.date > b.date ? 1 : (a.date === b.date ? (a.time > b.time ? 1 : -1) : -1)));
            const myHistory = state.appointments.filter(a => a.clientId === state.userId && new Date(a.date) < now).sort((a, b) => (a.date < b.date ? 1 : (a.date === b.date ? (a.time < b.time ? 1 : -1) : -1)));

            return `
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Agendar Serviço -->
                    <div class="lg:col-span-2 p-6 bg-white rounded-xl card">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Agendamento de Serviços</h2>
                        ${messageHtml}
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-6">
                            <input type="date" id="schedule-date" value="${state.selectedDate}" onchange="changeSelectedDate(event.target.value)" class="flex-grow px-4 py-2 border border-blue-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <select id="schedule-service" class="flex-grow px-4 py-2 border border-blue-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="Corte Cabelo">Corte de Cabelo (30min)</option>
                                <option value="Manicure">Manicure (45min)</option>
                                <option value="Massagem Relaxante">Massagem Relaxante (60min)</option>
                                <option value="Consulta Nutricional">Consulta Nutricional (60min)</option>
                            </select>
                        </div>

                        <h3 class="text-xl font-semibold mb-3 text-blue-600">Horários Disponíveis em ${new Date(state.selectedDate).toLocaleDateString('pt-BR')}</h3>
                        <div id="available-slots" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            ${availableSlots.length > 0 ? availableSlots.map(slot => `
                                <button onclick="handleBookAppointment('${state.selectedDate}', '${slot}')" class="bg-green-100 text-green-700 py-2 rounded-lg text-sm font-medium hover:bg-green-200 transition duration-150 shadow-md">
                                    ${slot}
                                </button>
                            `).join('') : `
                                <p class="col-span-full text-gray-500">Não há horários disponíveis para a data selecionada. Tente outro dia.</p>
                            `}
                        </div>
                    </div>

                    <!-- Meus Próximos Agendamentos -->
                    <div class="lg:col-span-1 p-6 bg-blue-50 rounded-xl card">
                        <h2 class="text-2xl font-bold text-blue-700 mb-4">Meus Próximos Agendamentos</h2>
                        <div class="space-y-4">
                            ${myFutureAppointments.length > 0 ? myFutureAppointments.map(app => `
                                <div class="bg-white p-4 rounded-lg border-l-4 border-blue-500 shadow-md">
                                    <p class="font-bold text-lg">${app.service}</p>
                                    <p class="text-sm text-gray-600">${new Date(app.date).toLocaleDateString('pt-BR')} às ${app.time}</p>
                                    <p class="text-xs text-gray-500 mt-1">ID: ${String(app.id).substring(0, 8)}...</p>
                                    <div class="flex space-x-2 mt-3">
                                        <button onclick="handleCancelAppointment('${app.id}')" class="text-xs text-red-600 hover:text-red-800 font-medium">Cancelar</button>
                                        <!-- Simular Reagendamento -->
                                        <button onclick="showMessage('Funcionalidade de Reagendamento Simulada. Escolha novo horário na seção acima.')" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">Reagendar</button>
                                    </div>
                                </div>
                            `).join('') : `
                                <p class="text-gray-600">Você não possui agendamentos futuros.</p>
                            `}
                        </div>
                    </div>

                    <!-- Histórico -->
                    <div class="lg:col-span-3 p-6 bg-white rounded-xl card mt-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Histórico de Atendimentos</h2>
                        <div class="space-y-4 max-h-80 overflow-y-auto">
                            ${myHistory.length > 0 ? myHistory.map(app => `
                                <div class="bg-gray-100 p-4 rounded-lg border-l-4 border-gray-400">
                                    <p class="font-bold">${app.service}</p>
                                    <p class="text-sm text-gray-600">${new Date(app.date).toLocaleDateString('pt-BR')} às ${app.time}</p>
                                    <p class="text-xs text-green-700 mt-1">Concluído</p>
                                </div>
                            `).join('') : `
                                <p class="text-gray-500">Seu histórico de agendamentos está vazio.</p>
                            `}
                        </div>
                    </div>
                </div>
            `;
        }

        // Painel do Administrador
        function AdminDashboard(messageHtml) {
            let adminContent = '';

            if (state.adminView === 'agenda') {
                const groupedAppointments = state.appointments.reduce((acc, app) => {
                    const dateKey = app.date;
                    if (!acc[dateKey]) acc[dateKey] = [];
                    acc[dateKey].push(app);
                    return acc;
                }, {});

                const sortedDates = Object.keys(groupedAppointments).sort();

                adminContent = `
                    <h3 class="text-xl font-semibold mb-4 text-blue-600">Agenda Completa</h3>
                    <div class="space-y-6 max-h-[70vh] overflow-y-auto pr-2">
                        ${sortedDates.length > 0 ? sortedDates.map(date => `
                            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                <h4 class="text-lg font-bold mb-3 text-gray-700 border-b pb-1">${new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</h4>
                                <ul class="space-y-3">
                                    ${groupedAppointments[date].sort((a, b) => (a.time > b.time ? 1 : -1)).map(app => `
                                        <li class="bg-white p-3 rounded-lg flex justify-between items-center shadow-md">
                                            <div>
                                                <p class="font-bold text-lg text-green-700">${app.time} - ${app.service}</p>
                                                <p class="text-sm text-gray-600">Cliente ID: ${String(app.clientId).substring(0, 15)}...</p>
                                                <p class="text-xs text-gray-400">Agendado: ${app.timestamp instanceof Date ? app.timestamp.toLocaleString('pt-BR') : (app.timestamp ? new Date(app.timestamp.toDate()).toLocaleString('pt-BR') : 'N/A')}</p>
                                            </div>
                                            <button onclick="handleCancelAppointment('${app.id}', true)" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                                Cancelar Agendamento
                                            </button>
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        `).join('') : `
                            <p class="text-gray-500">Nenhum agendamento encontrado.</p>
                        `}
                    </div>
                `;
            } else if (state.adminView === 'services') {
                adminContent = `
                    <h3 class="text-xl font-semibold mb-4 text-blue-600">Gerenciamento de Serviços e Profissionais</h3>
                    <div class="bg-gray-100 p-6 rounded-xl space-y-4">
                        <p class="text-gray-700 font-medium">Funcionalidade Simulada:</p>
                        <ul class="list-disc list-inside space-y-1 ml-4 text-gray-600">
                            <li>Cadastro de Serviço: Nome, Duração (min), Preço.</li>
                            <li>Cadastro de Profissional: Nome, Serviços Associados, Horários Padrão.</li>
                            <li>Sistema enviaria Notificações/Lembretes automáticos por e-mail (integração SMTP).</li>
                        </ul>
                        <button onclick="showMessage('Alerta de simulação: Abriria modal para cadastrar novo serviço/profissional.')" class="btn-primary bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                            Adicionar Novo Serviço/Profissional
                        </button>
                    </div>
                `;
            }

            return `
                <div class="p-6 bg-white rounded-xl card">
                    <h2 class="text-2xl font-bold text-blue-700 mb-4">Painel do Administrador</h2>
                    ${messageHtml}
                    <!-- Navegação do Admin -->
                    <div class="flex border-b mb-6">
                        <button onclick="changeAdminView('agenda')" class="px-4 py-2 text-lg font-medium ${state.adminView === 'agenda' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500 hover:text-blue-500'}">Agenda</button>
                        <button onclick="changeAdminView('services')" class="px-4 py-2 text-lg font-medium ${state.adminView === 'services' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500 hover:text-blue-500'}">Serviços & Profissionais</button>
                    </div>

                    ${adminContent}

                    <div class="mt-8 pt-4 border-t">
                        <h3 class="text-xl font-semibold text-gray-700 mb-3">Relatórios (Simulado)</h3>
                        <p class="text-sm text-gray-600">Relatório de Agendamentos por Período: ${state.appointments.length} agendamentos totais (em tempo real ou memória).</p>
                    </div>
                </div>
            `;
        }


        // --- FIREBASE/FIRESTORE LOGIC ---

        // 1. Inicializa Autenticação
        function initAuth() {
            if (isFirebaseAvailable && auth) {
                // Modo Real (Firebase Auth)
                onAuthStateChanged(auth, async (user) => {
                    if (user) {
                        state.userId = user.uid;
                        state.userEmail = user.email || 'Usuário Anônimo';
                        // Simulação de Papel (Role): Usuário específico é Admin.
                        const adminUserId = 'admin-teste-12345'; // ID de teste do admin
                        if (user.uid === adminUserId) {
                            state.userRole = 'admin';
                            state.view = 'admin';
                        } else {
                            state.userRole = 'client';
                            state.view = 'client';
                        }
                    } else {
                        // Se não houver usuário logado, tenta login inicial (anonimo)
                        try {
                            if (initialAuthToken) {
                                await signInWithCustomToken(auth, initialAuthToken);
                            } else {
                                state.view = 'login';
                            }
                        } catch (e) {
                            console.error("Erro na autenticação inicial:", e);
                            state.message = `Erro: Falha na autenticação inicial.`;
                            state.view = 'login';
                        }
                    }
                    state.loading = false;
                    state.isAuthReady = true;
                    updateUI();
                });
            } else {
                // FALLBACK: Modo Simulação (Sem Firebase)
                state.loading = false;
                state.isAuthReady = true;
                state.view = 'login';
                console.warn("Autenticação real do Firebase desabilitada. Usando simulação.");
                updateUI();
            }
        }

        // 2. Listener do Firestore para Agendamentos Públicos
        function setupFirestoreListener() {
            if (!isFirebaseAvailable || !db || !state.isAuthReady) {
                 console.warn("Firestore desabilitado. Agendamentos serão temporários na memória.");
                 return; // Não inicia o listener se o Firebase não estiver disponível
            }

            const appointmentsCollectionRef = collection(db, `artifacts/${appId}/public/data/appointments`);
            const q = query(appointmentsCollectionRef);

            // onSnapshot escuta em tempo real
            onSnapshot(q, (snapshot) => {
                const appointmentsList = [];
                snapshot.forEach((doc) => {
                    appointmentsList.push({ id: doc.id, ...doc.data() });
                });
                state.appointments = appointmentsList;
                // Garante que a UI seja atualizada com novos dados
                if (!state.loading) {
                    updateUI();
                }
            }, (error) => {
                console.error("Erro ao escutar agendamentos:", error);
                state.message = `Erro: Falha ao carregar agendamentos do banco de dados.`;
                updateUI();
            });
        }

        // 3. Funções de Manipulação de Dados

        // Simula a lista de slots disponíveis (09:00 a 17:00, 60 em 60 minutos)
        function getAvailableSlots() {
            const bookedTimes = state.appointments
                .filter(a => a.date === state.selectedDate && a.status === 'agendado')
                .map(a => a.time);

            const availableSlots = [];
            let currentTime = new Date();
            currentTime.setHours(9, 0, 0, 0); // Começa às 9h

            const endDate = new Date();
            endDate.setHours(17, 0, 0, 0); // Termina às 17h

            // Se a data selecionada for hoje, ajusta para horários futuros
            const todayISO = new Date().toISOString().split('T')[0];
            const isToday = state.selectedDate === todayISO;
            const now = new Date();

            while (currentTime.getHours() < endDate.getHours() || (currentTime.getHours() === endDate.getHours() && currentTime.getMinutes() === endDate.getMinutes())) {
                const timeString = `${String(currentTime.getHours()).padStart(2, '0')}:${String(currentTime.getMinutes()).padStart(2, '0')}`;
                
                // Cria um objeto Date para o slot no dia selecionado
                const slotDateTime = new Date(state.selectedDate);
                slotDateTime.setHours(currentTime.getHours(), currentTime.getMinutes(), 0, 0);

                // Verifica se o slot já passou (se for hoje)
                const isPast = isToday && slotDateTime < now;

                if (!bookedTimes.includes(timeString) && !isPast) {
                    availableSlots.push(timeString);
                }

                // Incrementa em 60 minutos
                currentTime.setMinutes(currentTime.getMinutes() + 60);
            }

            return availableSlots;
        }

        // Agendar Serviço (Cliente)
        window.handleBookAppointment = async (date, time) => {
            if (!state.userId) {
                showMessage('Erro: Usuário não autenticado. Faça login ou cadastre-se.');
                return;
            }

            const serviceSelect = document.getElementById('schedule-service');
            const service = serviceSelect ? serviceSelect.value : 'Serviço Padrão';

            const isBooked = state.appointments.some(a => a.date === date && a.time === time);
            if (isBooked) {
                showMessage('Erro: Este horário foi agendado por outro cliente. Escolha outro.');
                return;
            }
            
            const newAppointment = {
                id: crypto.randomUUID(), // ID local para simulação
                clientId: state.userId,
                clientEmail: state.userEmail || 'email-simulado@exemplo.com',
                date: date,
                time: time,
                service: service,
                status: 'agendado', // Agendado | Cancelado | Concluido
                timestamp: isFirebaseAvailable ? Timestamp.now() : new Date() // Usa Timestamp ou Date nativo
            };

            try {
                if (isFirebaseAvailable) {
                    // Modo Real (Firestore)
                    const appointmentsCollectionRef = collection(db, `artifacts/${appId}/public/data/appointments`);
                    await addDoc(appointmentsCollectionRef, newAppointment);
                } else {
                    // Modo Simulação (Memória)
                    state.appointments.push(newAppointment);
                    updateUI(); // Força a atualização da UI no modo de simulação
                }

                showMessage('Sucesso: Agendamento realizado com sucesso! (Confirmação por email simulada)');

            } catch (error) {
                console.error("Erro ao agendar:", error);
                showMessage(`Erro: Falha ao tentar agendar. ${error.message}`);
            }
        };

        // Cancelar Agendamento (Cliente ou Admin)
        window.handleCancelAppointment = async (docId, isAdmin = false) => {
            if (!state.userId) {
                showMessage('Erro: Usuário não autenticado.');
                return;
            }

            const confirmationMessage = isAdmin 
                ? 'Tem certeza que deseja cancelar este agendamento do Admin?' 
                : 'Tem certeza que deseja cancelar seu agendamento?';

            if (!window.confirm(confirmationMessage)) {
                return;
            }

            try {
                if (isFirebaseAvailable) {
                    // Modo Real (Firestore)
                    const docRef = doc(db, `artifacts/${appId}/public/data/appointments`, docId);
                    await deleteDoc(docRef);
                } else {
                    // Modo Simulação (Memória)
                    state.appointments = state.appointments.filter(a => a.id !== docId);
                    updateUI(); // Força a atualização da UI no modo de simulação
                }

                showMessage('Sucesso: Agendamento cancelado.');

            } catch (error) {
                console.error("Erro ao cancelar:", error);
                showMessage(`Erro: Falha ao cancelar agendamento. ${error.message}`);
            }
        };


        // --- AUXILIARY FUNCTIONS ---

        window.toggleAuthMode = () => {
            state.isSigningUp = !state.isSigningUp;
            updateUI();
        };

        window.changeSelectedDate = (newDate) => {
            state.selectedDate = newDate;
            updateUI();
        };

        window.changeAdminView = (newView) => {
            state.adminView = newView;
            updateUI();
        };

        window.handleAuth = (event) => {
            event.preventDefault();
            const email = document.getElementById('auth-email').value;
            const password = document.getElementById('auth-password').value;

            // Simulação de login/cadastro
            if (email === 'admin@admin.com' && password === 'admin123') {
                state.userId = 'admin-teste-12345'; // Hardcoded Admin ID
                state.userEmail = email;
                state.userRole = 'admin';
                state.view = 'admin';
                showMessage('Login de Administrador bem-sucedido. (Simulado)');
            } else if (state.isSigningUp) {
                // Simulação de Cadastro
                state.userId = crypto.randomUUID(); // Novo ID único
                state.userEmail = email;
                state.userRole = 'client';
                state.view = 'client';
                showMessage('Cadastro e Login de Cliente bem-sucedidos. (Simulado)');
            } else {
                // Simulação de Login Cliente Padrão
                state.userId = `client-${email.split('@')[0]}-${crypto.randomUUID().substring(0, 4)}`; // ID persistente simulado para cliente
                state.userEmail = email;
                state.userRole = 'client';
                state.view = 'client';
                showMessage('Login de Cliente bem-sucedido. (Simulado)');
            }
            updateUI();
        };

        window.handleLogout = () => {
            try {
                // Limpa o estado da simulação
                state.userId = null;
                state.userEmail = null;
                state.userRole = null;
                state.view = 'login';
                state.message = 'Sessão encerrada com sucesso.';
                
                // Se o Firebase estiver ativo, tenta o logout real
                if (isFirebaseAvailable && auth) {
                    signOut(auth);
                }

                updateUI();
            } catch (error) {
                console.error("Erro ao fazer logout:", error);
                showMessage('Erro ao sair. Tente novamente.');
            }
        };

        window.showMessage = (msg) => {
            state.message = msg;
            updateUI();
        };
        
        // Função para garantir que todos os listeners sejam anexados após a renderização
        function attachEventListeners() {
            // Nenhum listener complexo necessário
        }

        // Início da aplicação
        window.onload = function () {
            initAuth();
            // Inicia o listener de dados após a autenticação estar pronta
            const checkAuth = setInterval(() => {
                if (state.isAuthReady) {
                    clearInterval(checkAuth);
                    setupFirestoreListener();
                }
            }, 100);
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
