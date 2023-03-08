// Libraries
import Vue from 'vue'
// import Vuetify from 'vuetify'
import { mount, createLocalVue } from '@vue/test-utils';
import App from '../../resources/js/Pages/App.vue'
import store from '../../resources/js/Store/main'
import axios from 'axios'

jest.mock("axios")

const mockTodos = [
    {
        id: 1,
        title: 'first todo',
        completed: false
    },
    {
        id: 2,
        title: 'second todo',
        completed: false
    }
]

const localVue = createLocalVue()

describe('Todo.vue',()=>{
    let vuetify

    beforeEach(() => {
      vuetify = new Vuetify()
    })

    it('renders a todos', () => {
        const wrapper = mount(App, {
            localVue,
            vuetify,
            global: {
                plugins: [store]
            }
        })

        axios.get.mockResolvedValueOnce(mockTodos);
        expect(axios.get).toHaveBeenCalledWith(`/api/todos`);
    })

    // it('create a todo', () => {

    //     const wrapper = mount(App, {
    //         global: {
    //             plugins: [store]
    //         }
    //     })

    //     const todo = wrapper.get('[data-test="todo"]')

    //     expect(todo.text()).toBe('Learn Vue.js 3')
    // })

    // it('delete a todo', () => {

    //     const wrapper = mount(App, {
    //         global: {
    //             plugins: [store]
    //         }
    //     })

    //     const todo = wrapper.get('[data-test="todo"]')

    //     expect(todo.text()).toBe('Learn Vue.js 3')
    // })

})

