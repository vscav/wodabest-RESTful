import axios from "axios";
import * as types from "../mutation-types";

const getDefaultGameState = () => {
    return {
        filter: "all",
        games: [],
        activePlayers: []
    };
};

// state
export const state = getDefaultGameState();

// getters
export const getters = {
    count(state) {
        return state.games.length;
    },
    getActivePlayers(state) {
        return state.activePlayers;
    },
    filter(state) {
        return state.filter;
    }
};

// mutations
export const mutations = {
    [types.DEFAULT_GAMES_STATE](state) {
        Object.assign(state, getDefaultGameState());
    },
    [types.RETRIEVE_GAMES](state, games) {
        state.games = games;
    },
    [types.RETRIEVE_PLAYERS](state, players) {
        state.activePlayers = players;
    },
    [types.UPDATE_GAMES_FILTER](state, filter) {
        state.filter = filter;
        this.dispatch("games/retrievePlayers");
    },
    [types.DEFAULT_PLAYERS](state) {
        state.activePlayers = null;
    }
};

// actions
export const actions = {
    retrieveGames(context) {
        axios
            .get("/api/games")
            .then(response => {
                context.commit(types.RETRIEVE_GAMES, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    retrievePlayers({ commit, state }) {
        axios
            .post("/api/games/init/" + state.filter)
            .then(response => {
                commit(types.RETRIEVE_PLAYERS, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    updateScores(context, game) {
        axios
            .patch("/api/games/update", {
                winner: game.winner,
                loser: game.loser
            })
            .then(response => {
                response.data.forEach(project => {
                    context.commit(
                        "projects/" + types.UPDATE_PROJECT,
                        project,
                        {
                            root: true
                        }
                    );
                    context.commit(
                        "ranking/" + types.UPDATE_TOP_PROJECT,
                        project,
                        {
                            root: true
                        }
                    );
                });
            })
            .catch(error => {
                console.log(error);
            });
    },
    updateFilter(context, filter) {
        context.commit(types.UPDATE_GAMES_FILTER, filter);
    },
    feedPlayers(context, players) {
        context.commit(types.RETRIEVE_PLAYERS, players);
    },
    defaultPlayers(context) {
        context.commit(types.DEFAULT_PLAYERS);
    }
};
