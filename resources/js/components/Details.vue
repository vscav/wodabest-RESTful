<template>
    <div class="col-lg-6 col-md-6 col-12 order-md-2 order-1">
        <div v-if="user.id == owner" class="d-flex flex-row align-items-center">
            <span class="badge badge-dot">
                <i class="bg-success"></i>
            </span>
            <p class="mt-3 ml-3 text-muted text-sm">{{ $t('belongs') }}</p>
        </div>
        <div class="work-details rounded shadow-large p-4">
            <h5 class="title border-bottom pb-3 mb-3">Project details :</h5>
            <dl class="row mb-0">
                <dt class="col-md-4 col-5">{{ $t("title") }} :</dt>
                <div v-if="user.id == owner" class="col-md-8 col-7">
                    <dd
                        v-if="!editingTitle"
                        @dblclick="editProjectTitle"
                        class="text-muted"
                    >
                        {{ title }}
                    </dd>
                    <input
                        v-else
                        class="form-control"
                        type="text"
                        v-model="title"
                        @blur="doneEditTitle"
                        @keyup.enter="doneEditTitle"
                        @keyup.esc="cancelEditTitle"
                        v-focus
                    />
                </div>

                <div v-else class="col-md-8 col-7">
                    <dd class="text-muted">
                        {{ title }}
                    </dd>
                </div>

                <dt class="col-md-4 col-5">{{ $t("author") }} :</dt>
                <dd class="col-md-8 col-7 text-muted">{{ author }}</dd>

                <dt class="col-md-4 col-5">{{ $t("category") }} :</dt>
                <dd class="col-md-8 col-7 text-muted">{{ categoryName }}</dd>

                <dt class="col-md-4 col-5">{{ $t("updated_on") }} :</dt>
                <dd class="col-md-8 col-7 text-muted">{{ formatDate }}</dd>

                <dt class="col-md-4 col-5">{{ $t("score") }} :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                    {{ score }}
                </dd>

                <dt class="col-md-4 col-5">
                    {{ $t("project_games_played") }} :
                </dt>
                <dd class="col-md-8 col-7 text-muted">{{ losses + wins }}</dd>

                <dt class="col-md-4 col-5">{{ $t("wins") }} :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                    {{ wins }}
                </dd>

                <dt class="col-md-4 col-5">{{ $t("losses") }} :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                    {{ losses }}
                </dd>
            </dl>
        </div>
        <div v-if="user.id == owner" class="mt-4 pt-2">
            <p
                v-if="!editingDescription"
                @dblclick="editProjectDescription"
                class="mb-0"
            >
                {{ description }}
            </p>
            <textarea
                v-else
                class="form-control"
                rows="5"
                type="text"
                v-model="description"
                @blur="doneEditDescription"
                @keyup.enter="doneEditDescription"
                @keyup.esc="cancelEditDescription"
                v-focus
            />
        </div>
        <div v-else class="mt-4 pt-2">
            <p class="mb-0">{{ description }}</p>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "details-view",

    props: ["project"],

    data: function() {
        return {
            id: this.project.id,
            author: "",
            owner: this.project.user_id,
            title: this.project.title,
            description: this.project.description,
            filename: this.project.filename,
            category: this.project.category_id,
            date: this.project.updated_at,
            editingTitle: false,
            editingDescription: false,
            score: this.project.score,
            wins: this.project.wins,
            losses: this.project.losses,
            rank: this.project.rank,
            beforeEditCache: ""
        };
    },

    created() {
        this.$store.dispatch("categories/retrieveCategories");
    },

    computed: {
        ...mapGetters({ user: "auth/user" }),
        categoryName() {
            const category = this.$store.getters[
                "categories/allCategories"
            ].find(category => category.id === this.category);
            if (category !== undefined) return category.name;
        },
        formatDate() {
            if (this.date != null) {
                const date = new Date(this.date);
                return (
                    date.getFullYear() +
                    "-" +
                    (date.getMonth() + 1) +
                    "-" +
                    date.getDate()
                );
            } else return "Not defined";
        }
    },

    watch: {
        project: function() {
            this.updateData();
            this.getAuthorName(this.owner);
        }
    },

    directives: {
        focus: {
            inserted: function(el) {
                el.focus();
            }
        }
    },

    methods: {
        editProjectTitle() {
            this.beforeEditCache = this.title;
            this.editingTitle = true;
        },
        doneEditTitle() {
            if (this.title.trim() == "") {
                this.title = this.beforeEditCache;
            }
            this.editingTitle = false;

            this.updateProject();
        },
        cancelEditTitle() {
            this.title = this.beforeEditCache;
            this.editingTitle = false;
        },
        editProjectDescription() {
            this.beforeEditCache = this.description;
            this.editingDescription = true;
        },
        doneEditDescription() {
            if (this.description.trim() == "") {
                this.description = this.beforeEditCache;
            }
            this.editingDescription = false;

            this.updateProject();
        },
        cancelEditDescription() {
            this.description = this.beforeEditCache;
            this.editingDescription = false;
        },
        updateData() {
            (this.id = this.project.id),
                (this.owner = this.project.user_id),
                (this.title = this.project.title),
                (this.description = this.project.description),
                (this.filename = this.project.filename),
                (this.category = this.project.category_id),
                (this.date = this.project.updated_at),
                (this.editingTitle = false),
                (this.editingDescription = false),
                (this.score = this.project.score),
                (this.wins = this.project.wins),
                (this.losses = this.project.losses),
                (this.rank = this.project.rank),
                (this.beforeEditCache = "");
        },
        updateProject() {
            this.$store.dispatch("projects/updateProject", {
                id: this.id,
                owner: this.owner,
                title: this.title,
                description: this.description,
                filename: this.filename,
                category: this.category,
                score: this.score,
                wins: this.wins,
                losses: this.losses,
                rank: this.rank
            });
        },
        async getAuthorName(id) {
            let response = await this.$store.dispatch(
                "users/getAuthorName",
                this.owner
            );
            this.author = response;
        }
    }
};
</script>
