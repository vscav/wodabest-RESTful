import axios from "axios";
import * as types from "../mutation-types";

const getDefaultRankingState = () => {
    return {
        filter: "all",
        topProjects: []
    };
};

// state
export const state = getDefaultRankingState();

// getters
export const getters = {
    count(state) {
        return state.topProjects.length;
    },
    topProjects(state) {
        return state.topProjects;
    }
};

// mutations
export const mutations = {
  [types.DEFAULT_TOP_PROJECTS_STATE](state) {
    Object.assign(state, getDefaultRankingState());
  },
    [types.RETRIEVE_TOP_PROJECTS](state, projects) {
        state.topProjects = projects;
    },
    [types.UPDATE_RANKING_FILTER](state, filter) {
        state.filter = filter;
        this.dispatch("ranking/retrieveTopProjects");
    },
    [types.UPDATE_TOP_PROJECT](state, project) {
        if (state.topProjects) {
            const index = state.topProjects.findIndex(
                item => item.id == project.id
            );
            state.topProjects.splice(index, 1, project);
        }
    }
};

// actions
export const actions = {
    retrieveTopProjects({ commit, state }) {
        axios
            .post("/api/projects/ranking/" + state.filter)
            .then(response => {
                commit(types.RETRIEVE_TOP_PROJECTS, response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    updateFilter(context, filter) {
        context.commit(types.UPDATE_RANKING_FILTER, filter);
    }
};
