import axios from "axios";
import * as types from "../mutation-types";

const getDefaultCategoriesState = () => {
    return {
        categories: []
    };
};

// state
export const state = getDefaultCategoriesState();

// getters
export const getters = {
    count(state) {
        return state.categories.length;
    },
    allCategories(state) {
        return state.categories;
    }
};

// mutations
export const mutations = {
    [types.DEFAULT_CATEGORIES_STATE](state) {
        Object.assign(state, getDefaultCategoriesState());
    },
    [types.RETRIEVE_CATEGORIES](state, categories) {
        state.categories = categories;
    }
};

// actions
export const actions = {
    retrieveCategories(context) {
        axios
            .get("/api/categories")
            .then(response => {
                context.commit(types.RETRIEVE_CATEGORIES, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
