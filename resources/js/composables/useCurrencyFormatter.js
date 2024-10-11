const CurrencyFormatter = function currencyFormatter(params) {
    const valor = params.value;
    if ((!valor) || isNaN(valor)) {
        return '';
    }

    let val = (valor.toString().replace(/\D/g, '') / 100).toFixed(2);
    return `R$ ${val.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.').substring(0, 10)}`;
};

export default CurrencyFormatter;
