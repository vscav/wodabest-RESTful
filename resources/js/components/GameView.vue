<template>
    <div class="container">
        <v-filter type="games"></v-filter>

        <div v-if="loading">
            <div class="container text-center mt-5 mb-5">
                <loader />
            </div>
        </div>

        <div v-else class="row justify-content-md-center">
            <game-player
                v-if="activePlayers[0]"
                :idWinner="activePlayers[0].id"
                :idLoser="activePlayers[1].id"
                :idCategory="activePlayers[0].category_id"
                :title="activePlayers[0].title"
                :img="activePlayers[0].filename"
                @game-played="retrievePlayers"
            ></game-player>

            <game-player
                v-if="activePlayers[1]"
                :idWinner="activePlayers[1].id"
                :idLoser="activePlayers[0].id"
                :idCategory="activePlayers[1].category_id"
                :title="activePlayers[1].title"
                :img="activePlayers[1].filename"
                @game-played="retrievePlayers"
            ></game-player>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "game-view",

    data: function() {
        return {
            loading: true
        };
    },

    created() {
        this.retrievePlayers();
    },

    computed: {
        activePlayers() {
            return this.$store.getters["games/getActivePlayers"];
        }
    },

    methods: {
        async retrievePlayers() {
            try {
                const { data } = await axios.post(
                    "/api/games/init/" + this.$store.getters["games/filter"]
                );
                this.$store.dispatch("games/feedPlayers", data);
                this.loading = false;
            } catch (e) {
                console.log(e);
                this.loading = true;
            }
        }
    }
};
</script>
