<template>
    <tr>
        <th scope="row" class="text-center">
            {{ index + 1 }}
        </th>
        <td>
            <div class="media align-items-center">
                <a href="#" class="avatar mr-3">
                    <img :src="'/img/upload/' + filename" :alt="description" />
                </a>
                <div v-if="user.id == owner">
                    <div
                        v-if="!editing"
                        @dblclick="editProject"
                        class="media-body"
                    >
                        <span class="mb-0 text-sm">{{ title }}</span>
                    </div>
                    <input
                        v-if="editing"
                        class="form-control"
                        type="text"
                        v-model="title"
                        @blur="doneEdit"
                        @keyup.enter="doneEdit"
                        @keyup.esc="cancelEdit"
                        v-focus
                    />
                </div>
                <div v-else class="media-body">
                    <span class="mb-0 text-sm">{{ title }}</span>
                </div>
            </div>
        </td>
        <td class="text-center">
            <span v-if="owner == user.id" class="badge badge-dot mr-4">
                <i class="bg-success"></i>
            </span>
            <span v-else class="badge badge-dot mr-4">
                <i class="bg-warning"></i>
            </span>
        </td>
        <td>
            {{ score }}
        </td>
        <td>
            {{ wins }}
        </td>
        <td>
            {{ losses }}
        </td>
        <td>
            <div class="d-flex align-items-center">
                <span class="mr-2">{{ ratio + " %" }}</span>
                <div>
                    <div class="progress">
                        <div
                            class="progress-bar"
                            role="progressbar"
                            :aria-valuenow="ratio"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            :style="'width: ' + ratio + '%'"
                        ></div>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-right">
            <div class="dropdown">
                <a
                    class="btn btn-sm btn-icon-only text-light"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <img src="img/icons/ellipsis.svg" alt="Ellipsis icon" />
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                >
                    <a @click="goTodetail(id)" class="dropdown-item">{{
                        $t("see_more")
                    }}</a>
                    <a
                        @click="removeProject(project.id)"
                        v-if="owner == user.id"
                        class="dropdown-item"
                        >{{ $t("delete") }}</a
                    >
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "ranked-project-item",

    props: {
        index: {
            type: Number,
            required: true
        },
        project: {
            type: Object,
            required: true
        }
    },

    data: function() {
        return {
            id: this.project.id,
            owner: this.project.user_id,
            title: this.project.title,
            description: this.project.description,
            filename: this.project.filename,
            category: this.project.category_id,
            editing: false,
            score: this.project.score,
            wins: this.project.wins,
            losses: this.project.losses,
            rank: this.project.rank,
            beforeEditCache: ""
        };
    },

    directives: {
        focus: {
            inserted: function(el) {
                el.focus();
            }
        }
    },

    computed: {
        ...mapGetters({ user: "auth/user" }),
        ratio() {
            if (this.wins + this.losses == 0) return 0;
            else
                return (
                    100 *
                    (this.wins / (this.wins + this.losses))
                ).toFixed();
        }
    },

    methods: {
        editProject() {
            this.beforeEditCache = this.title;
            this.editing = true;
        },
        doneEdit() {
            if (this.title.trim() == "") {
                this.title = this.beforeEditCache;
            }
            this.editing = false;

            this.$store.dispatch("projects/updateProject", {
                id: this.id,
                owner: this.owner,
                title: this.title,
                description: this.description,
                filename: this.filename,
                category: this.category,
                editing: this.editing,
                score: this.score,
                wins: this.wins,
                losses: this.losses,
                rank: this.rank
            });
        },
        cancelEdit() {
            this.title = this.beforeEditCache;
            this.editing = false;
        },
        removeProject(id) {
            this.$store.dispatch("projects/deleteProject", id);
        },
        goTodetail(id) {
            this.$router.push({ name: "details", params: { id: id } });
        }
    }
};
</script>
