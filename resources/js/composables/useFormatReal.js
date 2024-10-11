export function useFormatReal(valor) {
    const formatReal = (valor) => {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valor);
    }
    return { formatReal };
}
