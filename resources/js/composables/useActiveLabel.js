export function useActiveLabel() {
    const activeLabel = (active) => {
        return active ? 'Ativo' : 'Inativo';
    }

    return { activeLabel }
}
