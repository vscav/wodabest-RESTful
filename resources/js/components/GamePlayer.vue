<template>
    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <input
                    v-model="form.winner"
                    type="hidden"
                    class="form-control"
                    name="winner"
                />
                <input
                    v-model="form.loser"
                    type="hidden"
                    class="form-control"
                    name="loser"
                />
            </div>
            <div class="work-container work-classic">
                <button type="submit" class="game-button">
                    <img
                        :src="'/img/upload/' + filename"
                        class="img-fluid rounded work-image"
                        :alt="this.title"
                    />
                </button>
                <div class="content d-flex align-items-center pt-3">
                    <div>
                        <h5 class="mb-0 text-dark title">
                            {{ projectTitle }}
                        </h5>
                        <h6 class="text-muted tag mb-0">
                            {{ $t(categorySlug) }}
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Form from "vform";

export default {
    name: "game-player",

    props: {
        title: String,
        idWinner: Number,
        idLoser: Number,
        idCategory: Number,
        img: String
    },

    data: function() {
        return {
            form: new Form({
                winner: this.idWinner,
                loser: this.idLoser
            }),
            projectTitle: this.title,
            filename: this.img
        };
    },

    computed: {
        categorySlug() {
            const category = this.$store.getters[
                "categories/allCategories"
            ].find(category => category.id === this.idCategory);
            if (category !== undefined) return category.slug;
        }
    },

    watch: {
        title: function() {
            this.updateData();
        }
    },

    methods: {
        async update() {
            this.$emit('game-played');
            await this.$store.dispatch("games/updateScores", {
                winner: this.form.winner,
                loser: this.form.loser
            });
        },
        updateData() {
            this.form.winner = this.idWinner;
            this.form.loser = this.idLoser;
            this.projectTitle = this.title;
            this.filename = this.img;
        }
    }
};
</script>
