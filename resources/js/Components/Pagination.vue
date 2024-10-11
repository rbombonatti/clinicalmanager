<script>
export default {
    name: "Pagination",
    props: {
        pagination: Object,
    },
    data() {
        return {
            page: this.pagination.current_page,
        };
    },
    watch: {
        "pagination.current_page": function (page) {
            this.page = page;
        },
    },
    methods: {
        loadPage(page) {
            this.$inertia.get(
                this.$page.url,
                {page: page},
                {
                    preserveState: true,
                }
            );
        },
    },
    computed: {
        noPreviousPage() {
            return this.pagination.current_page - 1 <= 0;
        },
        noNextPage() {
            return this.pagination.current_page + 1 > this.pagination.last_page;
        },
    },
};
</script>

<template>
    <div class="max-w-full flex justify-end">
        <div class="mt-6 flex items-center gap-x-6">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <p class="mb-0 text-sm text-gray-500 text-right">
                    Exibindo
                    <span class="font-medium">{{ pagination.from }}</span>
                    até
                    <span class="font-medium">{{ pagination.to }}</span>
                    de
                    <span class="font-medium">{{ pagination.total }}</span>
                    resultados
                </p>
            </div>
            <div>
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item" :class="{disabled: noPreviousPage}">
                            <a class="page-link" @click="loadPage(1)" style="cursor: pointer">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chevron-double-left"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li class="page-item" :class="{disabled: noPreviousPage}">
                            <a
                                class="page-link"
                                @click="loadPage(pagination.current_page - 1)"
                                style="cursor: pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chevron-left"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li class="page-item disabled">
              <span class="page-link">
                {{ pagination.current_page }}
              </span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link"> de </span>
                        </li>
                        <li class="page-item disabled">
              <span class="page-link">
                {{ pagination.last_page }}
              </span>
                        </li>
                        <li class="page-item" :class="{disabled: noNextPage}">
                            <a
                                class="page-link"
                                @click="loadPage(pagination.current_page + 1)"
                                style="cursor: pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chevron-right"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li class="page-item" :class="{disabled: noNextPage}">
                            <a class="page-link" @click="loadPage(pagination.last_page)" style="cursor: pointer">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-chevron-double-right"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"
                                    />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
</template>

<style scoped></style>
