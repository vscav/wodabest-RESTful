import axios from "axios";
import * as types from "../mutation-types";

const getDefaultUsersState = () => {
    return {
        users: []
    };
};

// state
export const state = getDefaultUsersState();

// getters
export const getters = {
    count(state) {
        return state.users.length;
    }
};

// mutations
export const mutations = {
    [types.DEFAULT_USERS_STATE](state) {
        Object.assign(state, getDefaultUsersState());
    },
    [types.RETRIEVE_USERS](state, users) {
        state.users = users;
    }
};

// actions
export const actions = {
    retrieveUsers(context) {
        axios
            .get("/api/users/names")
            .then(response => {
                context.commit(types.RETRIEVE_USERS, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    getAuthorName({ commit, state }, payload) {
        return state.users.find(user => user.id === payload).name;
    }
};
