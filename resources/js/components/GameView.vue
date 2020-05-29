<template>
    <div class="container">
        <v-filter type="games"></v-filter>

        <div class="row justify-content-md-center">
            <game-player
                v-if="players[0]"
                :idWinner="players[0].id"
                :idLoser="players[1].id"
                :idCategory="players[0].category_id"
                :title="players[0].title"
                :img="players[0].filename"
            ></game-player>

            <game-player
                v-if="players[1]"
                :idWinner="players[1].id"
                :idLoser="players[0].id"
                :idCategory="players[1].category_id"
                :title="players[1].title"
                :img="players[1].filename"
            ></game-player>
        </div>
    </div>
</template>

<script>
export default {
    name: "game-view",

    created() {
        this.$store.dispatch("games/retrievePlayers");
    },

    computed: {
        players() {
            return this.$store.getters["games/getActivePlayers"];
        }
    }
};
</script>
