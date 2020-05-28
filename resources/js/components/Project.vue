<template>
    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 branding">
        <div
            class="shadow-large work-container work-modern position-relative d-block overflow-hidden rounded"
        >
            <img
                :src="'/img/upload/' + project.filename"
                :alt="project.description"
                class="img-fluid"
            />
            <div class="overlay-work bg-dark"></div>
            <div class="icons text-center">
                <a @click="goTodetail(id)" class="btn btn-icon"
                    ><img src="img/icons/magnifying-glass.svg" alt="Magnifying glass icon"
                /></a>
            </div>
            <div class="content p-3">
                <div v-if="user.id == owner">
                    <h5
                        v-if="!editing"
                        @dblclick="editProject"
                        class="mb-0 text-white title"
                    >
                        {{ title }}
                    </h5>
                    <input
                        v-else
                        class="form-control"
                        type="text"
                        v-model="title"
                        @blur="doneEdit"
                        @keyup.enter="doneEdit"
                        @keyup.esc="cancelEdit"
                        v-focus
                    />
                </div>
                <div v-else>
                    <h5 class="mb-0 text-white">
                        {{ title }}
                    </h5>
                </div>
                <h6 class="text-light tag mb-0">
                    {{ $t("create_by") + " " + author }}
                </h6>
                <div
                    v-if="user.id == owner"
                    @click="removeProject(project.id)"
                    class="d-inline-flex mt-3 text-left"
                >
                    <a class="btn btn-icon"><img src="img/icons/trash.svg" alt="Trash icon" /></a>
                </div>
                <div class="d-inline-flex mt-3 text-left align-items-center">
                    <a
                        v-if="isLiked"
                        @click="unlikeProject"
                        class="btn btn-icon"
                        ><img src="img/icons/thumb-up-full.svg" alt="Full thumb up icon"
                    /></a>
                    <a v-else @click="likeProject" class="btn btn-icon"
                        ><img src="img/icons/thumb-up.svg" alt="Thumb up icon"
                    /></a>
                    <span class="text-white small ml-0">{{
                        countProjectLikes
                    }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "project-item",

    props: {
        project: {
            type: Object,
            required: true
        }
    },

    data: function() {
        return {
            id: this.project.id,
            author: "",
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

    created() {
        this.getAuthorName(this.owner);
    },

    computed: {
        ...mapGetters({ user: "auth/user" }),
        getAuthUserLikes() {
            return this.$store.getters["likes/getAuthUserLikes"];
        },
        isLiked() {
            if (
                this.getAuthUserLikes.filter(
                    authLike => authLike.project_id == this.project.id
                ).length == 1
            )
                return true;
            else return false;
        },
        countProjectLikes() {
            const likes = this.$store.getters["likes/allLikes"];
            return likes.filter(like => like.project_id == this.project.id)
                .length;
        }
    },

    methods: {
        likeProject() {
            this.$store.dispatch("likes/like", {
                project: this.id,
                user: this.user.id
            });
        },
        unlikeProject() {
            this.$store.dispatch("likes/unlike", {
                project: this.id,
                user: this.user.id
            });
        },
        removeProject(id) {
            this.$store.dispatch("projects/deleteProject", id);
        },
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
        goTodetail(id) {
            this.$router.push({ name: "details", params: { id: id } });
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
