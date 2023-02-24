<template>
    <div class="container">
        <div>
            <h2>Artigos</h2>
            <form @submit.prevent="addArticle" class="mb-3">
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Titulo"
                        v-model="article.title"
                    />
                </div>
                <div class="form-group">
                    <textarea
                        class="form-control"
                        placeholder="Descrição"
                        v-model="article.body"
                    >
                    </textarea>
                </div>
                <button type="submit" class="btn btn-outline-success btn-block">
                    Salvar
                </button>
            </form>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li
                        v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                        class="page-item"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click="fetchArticles(pagination.prev_page_url)"
                            >Anterior</a
                        >
                    </li>

                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#"
                            >Página {{ pagination.current_page }} de
                            {{ pagination.last_page }}
                        </a>
                    </li>

                    <li
                        v-bind:class="[{ disabled: !pagination.next_page_url }]"
                        class="page-item"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click="fetchArticles(pagination.next_page_url)"
                            >Próxima</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
        <div
            class="card card-body"
            v-for="article in articles"
            v-bind:key="article.id"
        >
            <h3>{{ article.title }}</h3>
            <p>{{ article.body }}</p>
            <hr />
            <button
                class="btn btn-outline-primary mb-2"
                @click="editArticle(article)"
            >
                Editar
            </button>
            <button
                class="btn btn-outline-danger"
                @click="deleteArticle(article.id)"
            >
                Deletar
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Article",
    data() {
        return {
            articles: [],
            article: {
                id: "",
                title: "",
                body: "",
            },
            article_id: "",
            pagination: {},
            edit: false,
        };
    },
    created() {
        this.fetchArticles();
    },
    methods: {
        async fetchArticles(page_url) {
            let vm = this;
            page_url = page_url || "/api/articles";
            await fetch(page_url)
                .then((res) => res.json())
                .then((res) => {
                    this.articles = res.data;
                    vm.makPagination(res.meta, res.links);
                })
                .catch((err) => console.error(err));
        },
        makPagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            };

            this.pagination = pagination;
        },
        async deleteArticle(id) {
            if (confirm("Deletar artido?")) {
                await fetch(`api/article/${id}`, {
                    method: "delete",
                })
                    .then((res) => res.json())
                    .then((data) => {
                        this.fetchArticles();
                    })
                    .catch((err) => console.error(err));
            }
        },
        addArticle() {
            if (this.edit === false) {
                // Add
                if (this.article.title == "" || this.article.body == "") {
                    alert("Preencha todos os campos!");
                    return;
                }
                fetch("api/article", {
                    method: "post",
                    body: JSON.stringify(this.article),
                    headers: {
                        "Content-type": "application/json",
                    },
                })
                    .then((res) => res.json())
                    .then((data) => {
                        this.article.title = "";
                        this.article.body = "";
                        this.fetchArticles();
                        alert("Artigo adicionado");
                    });
            } else {
                // Edit
                fetch("api/article", {
                    method: "put",
                    body: JSON.stringify(this.article),
                    headers: {
                        "Content-type": "application/json",
                    },
                })
                    .then((res) => res.json())
                    .then((data) => {
                        this.article.title = "";
                        this.article.body = "";
                        this.fetchArticles();
                        alert("Artigo atualizado");
                    });
            }
        },
        editArticle(article) {
            this.edit = true;
            this.article.id = article.id;
            this.article.article_id = article.id;
            this.article.title = article.title;
            this.article.body = article.body;
        },
    },
};
</script>
