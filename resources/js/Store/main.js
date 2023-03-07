import axios from "axios";
import { createStore, Store } from "vuex";

const state = {
    todos:[]
}

const mutations = {
    setTodos(state,todos){
        state.todos = todos;
    }
}

const actions = {
    async getTodos({commit}) {
        let response = await axios.get('api/todos')

        if (response.status !== 200) {
            return alert('error')
        }

        commit('setTodos', response.data.data)
    },

    async addTodo({commit}, todo) {
        let response = await axios.post('/api/todos', todo);

        if (response.status !== 201) {
            return alert('error');
        }

        store.dispatch('getTodos');
    },

    async updateTodo({commit}, todo) {
        let response = await axios.patch(`/api/todos/${todo.id}`, todo);

        if (response.status !== 200) {
            return alert('error');
        }

        store.dispatch('getTodos');
    },

    async deleteTodo({commit}, id) {
        let response = await axios.delete(`/api/todos/${id}`)

        if (response.status !== 204) {
            return alert('error')
        }

        store.dispatch('getTodos');
    }
}

const store = createStore({
    state,
    mutations,
    actions,
   })

export default store ;
