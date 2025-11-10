<!-- Modals Compartilhados -->
<div id="modalNotificacoes" class="modal-overlay" onclick="fecharModal(event, 'modalNotificacoes')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title"><i class="bi bi-bell"></i> Notificações</h3>
            <button class="modal-close" onclick="fecharModal(event, 'modalNotificacoes')">&times;</button>
        </div>
        <div id="notificacoesLista">
            <div class="notification-item unread">
                <div class="notification-title">Nova doação recebida</div>
                <div class="notification-text">João Silva doou R$ 250,00 para a campanha "Natal Solidário"</div>
                <div class="notification-time">Há 2 horas</div>
            </div>
            <div class="notification-item unread">
                <div class="notification-title">Meta atingida!</div>
                <div class="notification-text">A campanha "Agasalho do Bem" atingiu 100% da meta</div>
                <div class="notification-time">Há 4 horas</div>
            </div>
            <div class="notification-item unread">
                <div class="notification-title">Novo doador cadastrado</div>
                <div class="notification-text">Maria Santos se registrou no sistema</div>
                <div class="notification-time">Há 6 horas</div>
            </div>
        </div>
    </div>
</div>

<div id="modalSobre" class="modal-overlay" onclick="fecharModal(event, 'modalSobre')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title"><i class="bi bi-info-circle"></i> Sobre o SCDI</h3>
            <button class="modal-close" onclick="fecharModal(event, 'modalSobre')">&times;</button>
        </div>
        <div>
            <p><strong>Sistema de Controle de Doação Institucional (SCDI)</strong></p>
            <p>O SCDI é uma plataforma desenvolvida para facilitar e organizar doações para instituições beneficentes.</p>
            <h5 style="margin-top: 20px;">Funcionalidades:</h5>
            <ul>
                <li>Gerenciamento de campanhas de arrecadação</li>
                <li>Cadastro de doadores e instituições</li>
                <li>Relatórios detalhados de doações</li>
                <li>Dashboard com estatísticas em tempo real</li>
            </ul>
        </div>
    </div>
</div>

<div id="modalConfiguracoes" class="modal-overlay" onclick="fecharModal(event, 'modalConfiguracoes')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title"><i class="bi bi-gear"></i> Configurações</h3>
            <button class="modal-close" onclick="fecharModal(event, 'modalConfiguracoes')">&times;</button>
        </div>
        <div>
            <h5>Notificações</h5>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked id="notifDoacoes">
                    <label class="form-check-label" for="notifDoacoes">Receber notificações de novas doações</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked id="notifCampanhas">
                    <label class="form-check-label" for="notifCampanhas">Alertas de campanhas próximas do fim</label>
                </div>
            </div>
            <button class="btn btn-success" onclick="salvarConfiguracoes()">Salvar Alterações</button>
        </div>
    </div>
</div>

<div id="modalContato" class="modal-overlay" onclick="fecharModal(event, 'modalContato')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title"><i class="bi bi-envelope"></i> Contato</h3>
            <button class="modal-close" onclick="fecharModal(event, 'modalContato')">&times;</button>
        </div>
        <div>
            <p><strong>Entre em contato com nossa equipe:</strong></p>
            <div class="mt-3">
                <h6><i class="bi bi-envelope"></i> Email</h6>
                <p>suporte@scdi.com.br</p>
            </div>
            <div class="mt-3">
                <h6><i class="bi bi-telephone"></i> Telefone</h6>
                <p>(11) 1234-5678</p>
            </div>
            <div class="mt-3">
                <h6><i class="bi bi-whatsapp"></i> WhatsApp</h6>
                <p>(11) 98765-4321</p>
            </div>
        </div>
    </div>
</div>
