import dayjs from 'dayjs'

export function useDateFormatter() {
    const formatDate = (date, format = 'DD/MM/YYYY') => {
        return dayjs(date).format(format)
    }

    return { formatDate }
}
