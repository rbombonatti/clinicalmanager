import { createI18n } from 'vue-i18n';

const messages = {
    en: {
        doctors: 'Doctors',
        welcome: 'Welcome to the dashboard',
    },
    pt: {
        doctors: 'Médicos',
        welcome: 'Bem-vindo ao painel',

        doctors_updated: 'Médico(a) atualizado(a) com sucesso!',
        doctors_deleted: 'Médico(a) excluído(a) com sucesso!',
        doctors_search: 'Pesquisar por um Médico(a)',
        doctors_created: 'Médico(a) criado(a) com sucesso!',

        roles_updated: 'Função atualizada com sucesso!',
        roles_deleted: 'Função excluída com sucesso!',
        roles_search: 'Pesquisar por uma Função',
        roles_created: 'Função criada com sucesso!',

        specialties_updated: 'Especialidade atualizada com sucesso!',
        specialties_deleted: 'Especialidade excluída com sucesso!',
        specialties_search: 'Pesquisar por uma Especialidade',
        specialties_created: 'Especialidade criada com sucesso!',

        procedures_updated: 'Procedimento atualizado com sucesso!',
        procedures_deleted: 'Procedimento excluído com sucesso!',
        procedures_search: 'Pesquisar por um Procedimento',
        procedures_created: 'Procedimento criado com sucesso!',

        healthinsuranceplans_updated: 'Convênio atualizado com sucesso!',
        healthinsuranceplans_deleted: 'Convênio excluído com sucesso!',
        healthinsuranceplans_search: 'Pesquisar por um Convênio',
        healthinsuranceplans_created: 'Convênio criado com sucesso!',
        generate_procedure_prices: 'Gerar Preços de Procedimentos por Convênio',
        generate_procedure_prices_success: 'Preços de Procedimentos por Convênio criados com sucesso!',

        pricelists_updated: 'Tabela atualizada com sucesso!',
        pricelists_deleted: 'Tabela excluída com sucesso!',
        pricelists_search: 'Pesquisar por uma Tabela',
        pricelists_created: 'Tabela criada com sucesso!',
        pricelists: 'Tabelas',
        pricelist: 'Tabela',

        procedureprices_updated: 'Preço por Procedimento atualizado com sucesso!',
        procedureprices_deleted: 'Preço por Procedimento excluído com sucesso!',
        procedureprices_search: 'Pesquisar por um Preço por Procedimento',
        procedureprices_created: 'Preço por Procedimento criado com sucesso!',

        name: 'Nome do Médico(a)',
        roles: 'Funções',
        search: 'Pesquisar',
        create_new: 'Criar Novo',
        details: 'Detalhes',
        edit: 'Editar',
        delete: 'Excluir',
        cancel: 'Cancelar',
        save: 'Salvar',
        procedures: 'Procedimentos',
        specialties: 'Especialidades',
        specialty: 'Especialidade',
        healthinsuranceplans: 'Convênios',
        no_results: 'Nenhum resultado encontrado',
        first_name: 'Nome',
        last_name: 'Sobrenome',
        role: 'Função',
        select_role: 'Selecione a Função',
        start_date: 'Data Inicial',
        end_date: 'Data Final',
        active: 'Ativo',
        plans_procedures_prices: 'Preços de Procedimentos',
        procedureprices: 'Preços de Procedimentos por Convênio',

        consultation: 'Atendimento',
        consultations: 'Atendimentos',
        home: 'Home',
        required: 'Deve ser preenchido',
        form_changed: 'Formulário foi alterado e ainda não foi salvo.',
        confirm_delete: 'Tem certeza que deseja excluir o registro?',
        undo_delete: 'Em alguns casos não é possível desfazer a exclusão.',
        deleted: 'Registro excluído!',
        deleted_text: '',
        delete_yes: 'Sim, pode excluir!',
        delete_no: 'Não, mudei de ideia',
        title: 'Título',
        healthinsuranceplan: 'Convênio',
        procedure: 'Procedimento',

        price: 'Preço',
        duplicate_entry: 'Já existe um registro ativo para esses valores',
        finance: 'Financeiro'
    },
};


const i18n = createI18n({
    locale: 'pt', // Define o idioma padrão
    fallbackLocale: 'en', // Define o idioma de fallback
    messages, // As mensagens de tradução
});

export default i18n;
