import axios from "axios";
import * as types from "../mutation-types";

const getDefaultProjectsState = () => {
  return {
    filter: "all",
    show: 8,
    keywords: false,
    userFilter: false,
    dateFilter: false,
    projects: [],
    project: []
  };
};

export const state = getDefaultProjectsState();

// getters
export const getters = {
  count(state) {
    return state.projects.length;
  },
  countFilteredProjects(state, getters, rootState, rootGetters) {
    return rootGetters["projects/projectsFiltered"].length;
  },
  countFilteredProjectsToShow(state, getters, rootState, rootGetters) {
    return rootGetters["projects/projectsFilteredToShow"].length;
  },
  project(state) {
    return state.project;
  },
  projectsFiltered(state, getters, rootState, rootGetters) {
    let projectsFiltered = switchFilter(
      state.filter,
      rootGetters["categories/allCategories"]
    );
    if (state.userFilter == true)
      projectsFiltered = projectsFiltered.filter(
        project => project.user_id == rootGetters["auth/user"].id
      );
    if (state.keywords) {
      projectsFiltered = projectsFiltered.filter(project =>
        project.title.toLowerCase().includes(state.keywords.toLowerCase())
      );
    }
    return projectsFiltered;
  },
  projectsFilteredToShow(state, getters, rootState, rootGetters) {
    let projectsFilteredToShow = rootGetters["projects/projectsFiltered"];
    return projectsFilteredToShow.slice(0, state.show);
  }
};

// mutations
export const mutations = {
  [types.DEFAULT_PROJECTS_STATE](state) {
    Object.assign(state, getDefaultProjectsState());
  },
  [types.RETRIEVE_PROJECTS](state, projects) {
    state.projects = projects;
  },
  [types.RETRIEVE_PROJECT](state, project) {
    state.project = project;
  },
  [types.ADD_PROJECT](state, project) {
    state.projects.push({
      id: project.id,
      owner: project.user_id,
      title: project.title,
      description: project.description,
      filename: project.image,
      category: project.category_id,
      editing: false,
      score: project.score,
      wins: project.wins,
      losses: project.losses,
      rank: project.rank
    });
  },
  [types.UPDATE_PROJECTS_FILTER](state, filter) {
    state.filter = filter;
  },
  [types.UPDATE_USER_FILTER](state, userFilter) {
    state.userFilter = userFilter;
  },
  [types.UPDATE_KEYWORDS](state, keywords) {
    state.keywords = keywords;
  },
  [types.UPDATE_SHOW](state) {
    state.show += 8;
  },
  [types.DEFAULT_SHOW](state) {
    state.show = 8;
  },
  [types.UPDATE_DATE_FILTER](state, dateFilter) {
    state.dateFilter = dateFilter;
  },
  [types.UPDATE_PROJECT](state, project) {
    const index = state.projects.findIndex(item => item.id == project.id);
    state.projects.splice(index, 1, project);
    if (state.project.id == project.id) {
      state.project = project;
    }
  },
  [types.DELETE_PROJECT](state, id) {
    const index = state.projects.findIndex(item => item.id == id);
    state.projects.splice(index, 1);
  }
};

// actions
export const actions = {
  retrieveProjects(context) {
    axios
      .get("/api/projects")
      .then(response => {
        context.commit(types.RETRIEVE_PROJECTS, response.data);
        context.dispatch("defaultShow");
      })
      .catch(error => {
        console.log(error);
      });
  },
  retrieveProject(context, id) {
    axios
      .get("/api/projects/" + id)
      .then(response => {
        context.commit(types.RETRIEVE_PROJECT, response.data);
      })
      .catch(error => {
        console.log(error);
      });
  },
  addProject(context, project) {
    axios
      .post("/api/projects", {
        user_id: project.user_id,
        title: project.title,
        description: project.description,
        category: project.category,
        image: project.image
      })
      .then(response => {
        context.commit(types.ADD_PROJECT, response.data);
        context.dispatch("updateFilter", "all");
      })
      .catch(error => {
        console.log(error);
      });
  },
  updateFilter(context, filter) {
    context.commit(types.UPDATE_PROJECTS_FILTER, filter);
  },
  updateUserFilter(context, userFilter) {
    context.commit(types.UPDATE_USER_FILTER, userFilter);
  },
  updateKeywords(context, keywords) {
    context.commit(types.UPDATE_KEYWORDS, keywords);
  },
  updateShow(context) {
    context.commit(types.UPDATE_SHOW);
  },
  defaultShow(context) {
    context.commit(types.DEFAULT_SHOW);
  },
  updateDateFilter(context, dateFilter) {
    context.commit(types.UPDATE_DATE_FILTER, dateFilter);
  },
  updateProject(context, project) {
    axios
      .patch("/api/projects/" + project.id, {
        title: project.title,
        description: project.description
      })
      .then(response => {
        console.log(response)
        context.commit(types.UPDATE_PROJECT, response.data);
        context.commit("ranking/" + types.UPDATE_TOP_PROJECT, project, {
          root: true
        });
      })
      .catch(error => {
        console.log(error);
      });
  },
  deleteProject(context, id) {
    axios
      .delete("/api/projects/" + id)
      .then(response => {
        console.log(response)
        context.commit(types.DELETE_PROJECT, id);
        // Update top projects state on delete :
        context.dispatch("ranking/retrieveTopProjects", null, { root: true });
      })
      .catch(error => {
        console.log(error);
      });
  }
};

// Filter Object literal
const switchFilter = (filter, categories) => {
  let Categories = {};

  Object.defineProperty(Categories, "all", {
    value: state.projects,
    writable: true,
    enumerable: true,
    configurable: true
  });

  categories.forEach(category => {
    Object.defineProperty(Categories, category.slug, {
      value: state.projects.filter(
        project => project.category_id == category.id
      ),
      writable: true,
      enumerable: true,
      configurable: true
    });
  });

  return Categories[filter] || Categories.default;
};
