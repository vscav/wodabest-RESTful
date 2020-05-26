import axios from "axios";
import * as types from "../mutation-types";

const getDefaultLikesState = () => {
    return {
        likes: []
    };
};

// state
export const state = getDefaultLikesState();

// getters
export const getters = {
    allLikes(state) {
        return state.likes;
    },
    getAuthUserLikes(state, getters, rootState, rootGetters) {
        return state.likes.filter(
            like => like.user_id == rootGetters["auth/user"].id
        );
    }
};

// mutations
export const mutations = {
    [types.DEFAULT_LIKES_STATE](state) {
        Object.assign(state, getDefaultLikesState());
    },
    [types.RETRIEVE_LIKES](state, likes) {
        state.likes = likes;
    },
    [types.CREATE_LIKE](state, like) {
        state.likes.push(like);
    },
    [types.DELETE_LIKE](state, id) {
        const index = state.likes.findIndex(like => like.id == id);
        state.likes.splice(index, 1);
    }
};

// actions
export const actions = {
    retrieveLikes(context) {
        axios
            .get("/api/likes")
            .then(response => {
                context.commit(types.RETRIEVE_LIKES, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    like(context, ids) {
        console.log(ids)
        axios
            .post("/api/likes", { ids })
            .then(response => {
                context.commit(types.CREATE_LIKE, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    unlike(context, ids) {
        const id = context.state.likes.filter(
            like => like.user_id == ids.user && like.project_id == ids.project
        )[0].id;
        axios
            .delete("/api/likes/" + id)
            .then(response => {
                context.commit(types.DELETE_LIKE, id);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
